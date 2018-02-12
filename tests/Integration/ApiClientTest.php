<?php

namespace EthicalJobs\Tests\SDK;

use Mockery;
use Illuminate\Support\Facades\App;
use EthicalJobs\SDK\HttpClient;
use EthicalJobs\SDK\Resources;
use EthicalJobs\SDK\ApiClient;

class ApiClientTest extends TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_can_has_correct_resource_properties()
    {
        $client = App::make(ApiClient::class);

        $this->assertInstanceOf(Resources\JobsResource::class, $client->jobs);
        $this->assertInstanceOf(Resources\InvoicesResource::class, $client->invoices);
        $this->assertInstanceOf(Resources\MediaResource::class, $client->media);
        $this->assertInstanceOf(Resources\OrganisationsResource::class, $client->organisations);
        $this->assertInstanceOf(Resources\SearchResource::class, $client->search);
        $this->assertInstanceOf(Resources\UsersResource::class, $client->users);
    }

    /**
     * @test
     * @group Unit
     */
    public function it_has_http_verb_methods()
    {
        foreach (['get','post','put','patch','delete'] as $verb) {

            $http = Mockery::mock(HttpClient::class)
                ->shouldReceive($verb)
                ->once()
                ->withAnyArgs(['/jobs', ['status' => 'APPROVED']])
                ->andReturn('success')
                ->getMock();

            $client = new ApiClient($http);

            $result = $client->$verb('/jobs', ['status' => 'APPROVED']);

            $this->assertEquals('success', $result);
        }
    }      

    /**
     * @test
     * @group Unit
     */
    public function it_has_request_method()
    {
        $http = Mockery::mock(HttpClient::class)
            ->shouldReceive('request')
            ->once()
            ->withAnyArgs(['GET', '/jobs', ['status' => 'APPROVED']])
            ->andReturn('success')
            ->getMock();

        $client = new ApiClient($http);

        $result = $client->request('GET', '/jobs', ['status' => 'APPROVED']);

        $this->assertEquals('success', $result);
    }          
}
