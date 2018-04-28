<?php

namespace Tests\Integration\Storage\QueryAdapters\Database;

use Mockery;
use EthicalJobs\SDK\Collection;
use EthicalJobs\SDK\Repositories\TaxonomyApiRepository;
use EthicalJobs\SDK\ApiClient;

class OrderByTest extends \EthicalJobs\Tests\SDK\TestCase
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
            ->orderBy('approved_at', 'DESC');

        $this->assertInstanceOf(TaxonomyApiRepository::class, $isFluent);
    }   

    /**
     * @test
     * @group Unit
     */
    public function it_can_add_a_orderBy_query()
    {
        $expected = new Collection(['entities' => 'jobs']);
        
        $api = Mockery::mock(ApiClient::class)
            ->shouldReceive('get')
            ->once()
            ->with('/search/jobs', [
                'orderBy'   => 'approved_at',
                'order'     => 'DESC',
            ])
            ->andReturn($expected)
            ->getMock();

        (new TaxonomyApiRepository($api))
            ->orderBy('approved_at', 'DESC')
            ->find();
    }    
}
