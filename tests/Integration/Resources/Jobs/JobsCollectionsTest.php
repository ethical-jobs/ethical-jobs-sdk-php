<?php

namespace EthicalJobs\Tests\SDK\Resources\Jobs;

use Mockery;
use EthicalJobs\Tests\SDK\Fixtures;
use EthicalJobs\SDK\Resources\JobsResource;
use EthicalJobs\Tests\SDK\TestCase;
use EthicalJobs\SDK\HttpClient;
use EthicalJobs\SDK\Collection;


class JobsCollectionsTest extends TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_can_patch_a_collection_of_jobs()
    {
        $jobs = Fixtures\Requests::jobsCollection(200);

        $responses = [
            collect(['data' => ['entities' => ['jobs' => ['1111','1111']]]]),
            collect(['data' => ['entities' => ['jobs' => ['2222','2222']]]]),
            collect(['data' => ['entities' => ['jobs' => ['1111','1111']]]]),
            collect(['data' => ['entities' => ['jobs' => ['4444','4444']]]]),                                   
        ];

        $http = Mockery::mock(HttpClient::class)
            ->shouldReceive('patch')
            ->times(4)
            ->withArgs([
                '/jobs/collection',
                Mockery::on(function ($args) {
                    return $args['jobs']->count() === 50;
                }),
            ])
            ->andReturn($responses[0],$responses[1],$responses[2],$responses[3])
            ->getMock();

        $results = (new JobsResource($http))
            ->patchCollection($jobs);

        $this->assertInstanceOf(Collection::class, $results);
        $this->assertEquals($results->toArray(), [
            'data' => [
                'entities' => [
                    'jobs' => ['1111','1111','2222','2222','1111','1111','4444','4444'],
                ],
            ],
        ]);
    }    

    /**
     * @test
     * @group Unit
     */
    public function it_can_put_a_collection_of_jobs()
    {
        $jobs = Fixtures\Requests::jobsCollection(200);

        $responses = [
            collect(['data' => ['entities' => ['jobs' => ['1111','1111']]]]),
            collect(['data' => ['entities' => ['jobs' => ['2222','2222']]]]),
            collect(['data' => ['entities' => ['jobs' => ['1111','1111']]]]),
            collect(['data' => ['entities' => ['jobs' => ['4444','4444']]]]),                                   
        ];

        $http = Mockery::mock(HttpClient::class)
            ->shouldReceive('put')
            ->times(4)
            ->withArgs([
                '/jobs/collection',
                Mockery::on(function ($args) {
                    return $args['jobs']->count() === 50;
                }),
            ])
            ->andReturn($responses[0],$responses[1],$responses[2],$responses[3])
            ->getMock();

        $results = (new JobsResource($http))
            ->putCollection($jobs);

        $this->assertInstanceOf(Collection::class, $results);
        $this->assertEquals($results->toArray(), [
            'data' => [
                'entities' => [
                    'jobs' => ['1111','1111','2222','2222','1111','1111','4444','4444'],
                ],
            ],
        ]);
    }     
}
