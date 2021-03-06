<?php

namespace EthicalJobs\Tests\SDK\Repositories\TaxonomyApiRepository;

use Mockery;
use EthicalJobs\SDK\Repositories\TaxonomyApiRepository;
use EthicalJobs\SDK\ApiClient;
use EthicalJobs\SDK\Collection;
use EthicalJobs\Tests\SDK\Fixtures;

class LimitTest extends \EthicalJobs\Tests\SDK\TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_has_fluent_interface()
    {
        $api = Mockery::mock(ApiClient::class)
            ->shouldIgnoreMissing();

        $repository = new TaxonomyApiRepository($api);

        $isFluent = $repository
            ->limit(15);

        $this->assertInstanceOf(TaxonomyApiRepository::class, $isFluent);
    }   

    /**
     * @test
     * @group Unit
     */
    public function it_can_add_a_limit_query()
    {
        $api = Mockery::mock(ApiClient::class)
            ->shouldReceive('appData')
            ->withNoArgs()
            ->andReturn(Fixtures\Taxonomies::queryResponse())
            ->getMock();

        $terms = (new TaxonomyApiRepository($api))
            ->taxonomy('categories')
            ->limit(15)
            ->find();

        $this->assertEquals(15, $terms->count());
    }    
}
