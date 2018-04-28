<?php

namespace EthicalJobs\Tests\SDK\Repositories\TaxonomyApiRepository;

use Mockery;
use EthicalJobs\SDK\Repositories\TaxonomyApiRepository;
use EthicalJobs\SDK\ApiClient;
use EthicalJobs\Tests\SDK\Fixtures;

class FindByFieldTest extends \EthicalJobs\Tests\SDK\TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_can_find_by_a_field()
    {
        $api = Mockery::mock(ApiClient::class)
            ->shouldReceive('appData')
            ->withNoArgs()
            ->andReturn(Fixtures\Taxonomies::queryResponse())
            ->getMock();

        $repository = new TaxonomyApiRepository($api);

        $term = $repository
            ->taxonomy('categories')
            ->findByField('title', 'Alcohol and Other Drugs');

        $this->assertEquals($term, [
            'id'        => 4,
            'slug'      => 'alcoholandotherdrugs',
            'title'     => 'Alcohol and Other Drugs',
            'job_count' => 59,
        ]);
    }      
}
