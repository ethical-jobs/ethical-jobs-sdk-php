<?php

namespace EthicalJobs\Tests\SDK\Repositories\TaxonomyApiRepository;

use Mockery;
use EthicalJobs\SDK\Repositories\TaxonomyApiRepository;
use EthicalJobs\SDK\ApiClient;
use EthicalJobs\Tests\SDK\Fixtures;

class FindTest extends \EthicalJobs\Tests\SDK\TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_can_execute_the_query()
    {
        $api = Mockery::mock(ApiClient::class)
            ->shouldReceive('appData')
            ->withNoArgs()
            ->andReturn(Fixtures\Taxonomies::queryResponse())
            ->getMock();

        $repository = new TaxonomyApiRepository($api);

        $terms = $repository
            ->taxonomy('categories')
            ->find();

        $expected = array_get(Fixtures\Taxonomies::queryResponse(), 'data.taxonomies.categories');

        $this->assertEquals($terms->toArray(), $expected);
    }     
}
