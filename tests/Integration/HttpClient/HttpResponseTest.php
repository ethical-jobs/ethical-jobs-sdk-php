<?php

namespace EthicalJobs\Tests\Integration\SDK\HttpClient;

use Mockery;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use EthicalJobs\Tests\Integration\SDK\TestCase;
use EthicalJobs\SDK\HttpClient;

class HttpResponseTest extends TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_can_get_the_last_response()
    {
        $expected = new Response(201);

        $client = Mockery::mock(Client::class)
            ->shouldReceive('send')
            ->once()
            ->andReturn($expected)
            ->getMock();     

        $http = new HttpClient($client);

        $http->request('GET', '/jobs');

        $actual = $http->getResponse();

        $this->assertEquals($expected, $actual);
    }    

    /**
     * @test
     * @group Unit
     */
    public function it_always_returns_a_collection_on_success()
    {
        $response = new Response(
            201, 
            ['Content-Type' => 'application/json'],
            json_encode(['foo' => 'bar'])
        );

        $client = Mockery::mock(Client::class)
            ->shouldReceive('send')
            ->once()
            ->andReturn($response)
            ->getMock();     

        $http = new HttpClient($client);

        $result = $http->request('GET', '/jobs');

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals($result->toArray(), ['foo' => 'bar']);
    }  

    /**
     * @test
     * @group Unit
     */
    public function it_throws_exceptions_on_failure()
    {
        $this->expectException(\GuzzleHttp\Exception\ClientException::class);

        $http = (new HttpClient(new Client))
            ->request('GET', '/_abc_123_404');
    }                  
}
