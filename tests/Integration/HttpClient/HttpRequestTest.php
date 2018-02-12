<?php

namespace EthicalJobs\Tests\Integration\SDK\HttpClient;

use Mockery;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use EthicalJobs\Tests\Integration\SDK\TestCase;
use EthicalJobs\SDK\HttpClient;

class HttpRequestTest extends TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_can_get_and_set_its_request()
    {
        $http = new HttpClient(new Client);

        $expected = new Request('GET', 'http://github.com');

        $http->setRequest($expected);

        $actual = $http->getRequest();

        $this->assertEquals($expected, $actual);
    }                   
}
