<?php

namespace EthicalJobs\Tests\SDK\Repositories\JobApiRepository;

use EthicalJobs\SDK\Repositories\JobApiRepository;
use EthicalJobs\Tests\SDK\Fixtures\Responses;

class JobApiRepositoryTest extends \EthicalJobs\Tests\SDK\TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_can_find_by_a_field()
    {
        $apiClient = Responses::mock([
            Responses::authentication(),
            Responses::jobs(),
        ]);

        $repository = new JobApiRepository($apiClient);

        $response = $repository->findByField('status', 'APPROVED');

        dd($response);
    }    
}
