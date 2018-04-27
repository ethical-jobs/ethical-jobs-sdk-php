<?php

namespace EthicalJobs\Tests\SDK\Repositories\JobApiRepository;

use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use Illuminate\Support\Facades\App;
use EthicalJobs\SDK\ApiClient;
use EthicalJobs\SDK\Repositories\JobApiRepository;
use EthicalJobs\Tests\SDK\Fixtures;

class FindByFieldTest extends \EthicalJobs\Tests\SDK\TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_can_find_by_a_field()
    {
        $responseStack = new MockHandler([
            Fixtures\Responses::jobs(),
        ]);

        $guzzle = new Client(['handler' => HandlerStack::create($responseStack)]);            

        App::instance(Client::class, $guzzle);

        $api = App::make(ApiClient::class);

        $repository = new JobApiRepository($api);

        $response = $repository->findByField('status', 'APPROVED');

        dd($response);
    }    

    // /**
    //  * @test
    //  * @group Unit
    //  */
    // public function it_throws_http_404_exception_when_no_model_found()
    // {
    //     $this->expectException(\Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class);

    //     $expected = new Person;

    //     $query = Mockery::mock(Builder::class)
    //          ->shouldReceive('where')
    //          ->once()
    //          ->with('first_name', 'Andrew')
    //          ->andReturn(Mockery::self())
    //          ->shouldReceive('get')
    //          ->once()
    //          ->withNoArgs()
    //          ->andReturn(null)
    //          ->getMock();

    //     (RepositoryFactory::build(new Person))
    //         ->setQuery($query)
    //         ->findByField('first_name', 'Andrew');
    // }         
}
