<?php

namespace EthicalJobs\Tests\Integration\SDK\Authentication;

use Mockery;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Cache\Repository;
use EthicalJobs\SDK\Authentication\TokenAuthenticator;
use EthicalJobs\Tests\Integration\SDK\TestCase;
use EthicalJobs\SDK\HttpClient;

class TokenAuthenticatorTest extends TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_can_get_its_token_from_cache()
    {
        $http = Mockery::mock(HttpClient::class)
            ->shouldReceive('post')
            ->once()
            ->withArgs([
                '/oauth/token',
                [
                    'grant_type'    => 'client_credentials',
                    'client_id'     => '',
                    'client_secret' => '',
                    'scope'         => '*',         
                ]
            ])
            ->andReturn(['access_token' => 'mock-jwt-token'])
            ->getMock();               

        $cache = Mockery::mock(Repository::class)
            ->shouldReceive('remember')
            ->once()
            ->withArgs([
                'ej:pkg:sdk:token',
                60,
                Mockery::on(function($callback) {
                    $this->assertEquals('mock-jwt-token', $callback());
                    return true;
                }),
            ])
            ->getMock();  

        (new TokenAuthenticator($http, $cache))
            ->getToken();
    }    

    /**
     * @test
     * @group Unit
     */
    public function it_sets_an_authorization_bearer_header()
    {
        $http = Mockery::mock(HttpClient::class);

        $cache = Mockery::mock(Repository::class)
            ->shouldReceive('remember')
            ->once()
            ->withAnyArgs()
            ->andReturn('mock-jwt-token')
            ->getMock(); 

        $original = new Request('GET', 'https://github.com/stars');

        $authenticated = (new TokenAuthenticator($http, $cache))
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
        $credentials = [
            'client_id'     => 'ci-123',
            'client_secret' => 'cs-123',                  
        ];

        $http = Mockery::mock(HttpClient::class)
            ->shouldReceive('post')
            ->once()
            ->withArgs([
                '/oauth/token',
                [
                    'grant_type'    => 'client_credentials',
                    'client_id'     => 'ci-123',
                    'client_secret' => 'cs-123',    
                    'scope'         => '*',         
                ]
            ])
            ->andReturn(['access_token' => 'mock-jwt-token'])
            ->getMock();               

        $cache = Mockery::mock(Repository::class)
            ->shouldReceive('remember')
            ->once()
            ->withArgs([
                'ej:pkg:sdk:token',
                60,
                Mockery::on(function($callback) {
                    $this->assertEquals('mock-jwt-token', $callback());
                    return true;
                }),
            ])
            ->getMock();  

        $request = new Request('GET', 'https://github.com/stars');

        $authenticated = (new TokenAuthenticator($http, $cache))
            ->setCredentials($credentials)
            ->authenticate($request);
    }       
}
