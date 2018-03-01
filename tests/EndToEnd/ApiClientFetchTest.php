<?php

namespace EthicalJobs\Tests\SDK;

use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Contracts\Cache\Repository;
use EthicalJobs\SDK\Authentication\TokenAuthenticator;
use EthicalJobs\Tests\SDK\Fixtures;
use EthicalJobs\SDK\HttpClient;
use EthicalJobs\SDK\ApiClient;

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

        $results = $apiClient->get('/jobs', [
            'status'    => 'APPROVED',
            'limit'     => 10,
        ]);

        $this->assertInstanceOf(Collection::class, $results);
        $this->assertTrue(array_has($results, 'data.entities.jobs'));
    }
}
