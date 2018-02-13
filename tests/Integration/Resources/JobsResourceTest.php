<?php

namespace EthicalJobs\Tests\SDK\Resources;

use Mockery;
use Illuminate\Support\Collection;
use EthicalJobs\SDK\Resources\JobsResource;
use EthicalJobs\Tests\SDK\TestCase;
use EthicalJobs\SDK\Enumerables;
use EthicalJobs\SDK\HttpClient;

class JobsResourceTest extends TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_can_return_approved_jobs()
    {
        $http = Mockery::mock(HttpClient::class)
            ->shouldReceive('get')
            ->once()
            ->withArgs([
                '/jobs',
                [
                    'status'    => Enumerables\JobStatus::APPROVED(),
                    'expired'   => 0,
                    'extra'     => 'var',
                ],
            ])
            ->andReturn(new Collection(['jobs' => []]))
            ->getMock();

        $jobs = new JobsResource($http);

        $results = $jobs->approved(['extra' => 'var']);

        $this->assertInstanceOf(Collection::class, $results);
        $this->assertEquals($results->toArray(), ['jobs' => []]);
    }    
}
