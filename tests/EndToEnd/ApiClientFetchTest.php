<?php

namespace EthicalJobs\Tests\SDK;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use EthicalJobs\SDK\Authentication\TokenAuthenticator;
use EthicalJobs\SDK\HttpClient;
use EthicalJobs\SDK\ApiClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use EthicalJobs\Tests\SDK\Fixtures;

class ApiClientFetchTest extends TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_can_fetch_unprotected_routes()
    {
        $responseStack = new MockHandler([
            Fixtures\Responses::authentication(),
            Fixtures\Responses::jobs(),
        ]);

        $guzzle = new Client(['handler' => HandlerStack::create($responseStack)]);            

        App::instance(Client::class, $guzzle);

        $apiClient = App::make(ApiClient::class);

        $results = $apiClient->jobs->get([
            'status'    => 'APPROVED',
            'limit'     => 10,
        ]);

        $this->assertInstanceOf(Collection::class, $results);
        $this->assertTrue(array_has($results, 'data.entities.jobs'));
    }
}
