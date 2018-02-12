<?php

namespace EthicalJobs\Tests\Integration\SDK\HttpClient;

use Mockery;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use EthicalJobs\Tests\Integration\SDK\TestCase;
use EthicalJobs\SDK\HttpClient;

class HttpVerbTest extends TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_has_all_http_verb_functions()
    {
        $verbs = ['get','post','put','patch','delete'];

        $http = new HttpClient(new Client);

        foreach ($verbs as $verb) {
        	$this->assertTrue(method_exists($http, $verb));
        }
    }

    /**
     * @test
     * @group Unit
     */
    public function its_verb_functions_generate_valid_requests()
    {
        $verbs = ['get','post','put','patch','delete'];

        foreach ($verbs as $verb) {

            $expected = new Request(
                strtoupper($verb), 
                'https://api.ethicaljobs.com.au/jobs', 
                ['Content-Type' => 'application/json','X-Custom' => 'foo'],
                json_encode(['foo' => 'bar'])
            );

            $client = Mockery::mock(Client::class)
                ->shouldReceive('send')
                ->once()
                ->andReturn(new Response)
                ->getMock();       

            $http = new HttpClient($client); 

            $http->$verb('/jobs', ['foo' => 'bar'], ['X-Custom' => 'foo']);

            $actual = $http->getRequest();

            $this->assertEquals($expected->getMethod(), $actual->getMethod());
            $this->assertEquals($expected->getUri(), $actual->getUri());
            $this->assertEquals($expected->getHeaders(), $actual->getHeaders());
            $this->assertEquals((string) $expected->getBody(), (string) $actual->getBody());
        }
    }    
}
