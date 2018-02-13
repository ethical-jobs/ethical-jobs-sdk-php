<?php

namespace EthicalJobs\Tests\Integration\SDK\Authentication;

use Mockery;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Contracts\Cache\Repository;
use EthicalJobs\SDK\Authentication\TokenAuthenticator;
use EthicalJobs\Tests\SDK\Fixtures\Responses;
use EthicalJobs\Tests\SDK\TestCase;

class TokenAuthenticatorTest extends TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_can_get_its_token_from_cache()
    {
        $response = Responses::authentication(200);

        $client = Mockery::mock(Client::class)
            ->shouldReceive('request')
            ->once()
            ->withArgs([
                'POST',
                'http://api-app/oauth/token',
                [
                    'json' => [
                        'grant_type'    => 'client_credentials',
                        'scope'         => '*',       
                        'client_id'     => '',
                        'client_secret' => '',
                    ],
                ]
            ])
            ->andReturn($response)
            ->getMock();               

        $cache = Mockery::mock(Repository::class)
            ->shouldReceive('remember')
            ->once()
            ->withArgs([
                'ej:pkg:sdk:token',
                60,
                Mockery::on(function($callback) {
                    $this->assertEquals(Responses::token(), $callback());
                    return true;
                }),
            ])
            ->getMock();  

        (new TokenAuthenticator($client, $cache))
            ->getToken();
    }    

    /**
     * @test
     * @group Unit
     */
    public function it_sets_an_authorization_bearer_header()
    {
        $client = Mockery::mock(Client::class);

        $cache = Mockery::mock(Repository::class)
            ->shouldReceive('remember')
            ->once()
            ->withAnyArgs()
            ->andReturn('mock-jwt-token')
            ->getMock(); 

        $original = new Request('GET', 'https://github.com/stars');

        $authenticated = (new TokenAuthenticator($client, $cache))
            ->authenticate($original);

        $expected = [
            'Host'              => ['github.com'],
            'Authorization'     => ['Bearer mock-jwt-token'],
        ];

        $this->assertEquals($expected, $authenticated->getHeaders());
    }    

    /**
     * @test
     * @group Unit
     */
    public function it_sets_its_credentials()
    {
        $response = Responses::authentication(200);

        $credentials = [
            'client_id'     => 'ci-123',
            'client_secret' => 'cs-123',                  
        ];

        $client = Mockery::mock(Client::class)
            ->shouldReceive('request')
            ->once()
            ->withArgs([
                'POST',
                'http://api-app/oauth/token',
                [
                    'json' => [
                        'grant_type'    => 'client_credentials',
                        'scope'         => '*',       
                        'client_id'     => 'ci-123',
                        'client_secret' => 'cs-123',
                    ],
                ]
            ])
            ->andReturn($response)
            ->getMock();               

        $cache = Mockery::mock(Repository::class)
            ->shouldReceive('remember')
            ->once()
            ->withArgs([
                'ej:pkg:sdk:token',
                60,
                Mockery::on(function($callback) {
                    $callback();
                    return true;
                }),
            ])
            ->getMock();  

        $request = new Request('GET', 'https://github.com/stars');

        $authenticated = (new TokenAuthenticator($client, $cache, $credentials))
            ->authenticate($request);
    }       
}
