<?php

namespace EthicalJobs\Tests\SDK\Repositories;

use Illuminate\Support\Collection;
use EthicalJobs\SDK\Repositories\ResourceRepository;
use EthicalJobs\Tests\SDK\TestCase;
use EthicalJobs\SDK\Resources;

class ResourceRepositoryTest extends TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_can_return_a_resource_by_name()
    {
        $resource = ResourceRepository::find('jobs');

        $this->assertInstanceOf(Resources\JobsResource::class, $resource);
    }

    /**
     * @test
     * @group Unit
     */
    public function it_can_return_a_collection_of_resource_instances()
    {
        $resources = ResourceRepository::all();

        $this->assertInstanceOf(Collection::class, $resources);

        $resources->each(function ($resource) {
        	$this->assertInstanceOf(Resources\ApiResource::class, $resource);
        });
    }    
}
