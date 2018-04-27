<?php

namespace EthicalJobs\Tests\SDK\Repositories;

use EthicalJobs\SDK\ApiClient;
use EthicalJobs\SDK\Mappers\TaxonomyMapper;
use EthicalJobs\Tests\SDK\TestCase;
use EthicalJobs\Tests\SDK\Fixtures;
use Mockery;

class TaxonomyMapperTest extends TestCase
{
    /**
     * @test
     * @group Integration
     */
    public function it_can_map_a_category_taxonomy_to_a_title()
    {
        $client = Mockery::mock(ApiClient::class)
            ->shouldReceive('appData')
            ->once()
            ->withNoArgs()
            ->andReturn(Fixtures\Taxonomies::response())
            ->getMock();

        $mapper = new TaxonomyMapper($client);
        $actualResult = $mapper->map(1, 'categories');
        $this->assertEquals("Administration", $actualResult);
    }

    /**
     * @test
     * @group Integration
     */
    public function it_can_map_a_worktype_taxonomy_to_a_title()
    {
        $client = Mockery::mock(ApiClient::class)
            ->shouldReceive('appData')
            ->once()
            ->withNoArgs()
            ->andReturn(Fixtures\Taxonomies::response())
            ->getMock();

        $mapper = new TaxonomyMapper($client);
        $actualResult = $mapper->map(3, 'workTypes');
        $this->assertEquals("Full Time", $actualResult);
    }
    /**
     * @test
     * @group Integration
     */
    public function it_can_map_a_location_taxonomy_to_a_title()
    {
        $client = Mockery::mock(ApiClient::class)
            ->shouldReceive('appData')
            ->once()
            ->withNoArgs()
            ->andReturn(Fixtures\Taxonomies::response())
            ->getMock();

        $mapper = new TaxonomyMapper($client);
        $actualResult = $mapper->map(11, 'locations');
        $this->assertEquals("Hobart", $actualResult);
    }

    /**
     * @test
     * @group Integration
     */
    public function it_can_map_a_sector_taxonomy_to_a_title()
    {
        $client = Mockery::mock(ApiClient::class)
            ->shouldReceive('appData')
            ->once()
            ->withNoArgs()
            ->andReturn(Fixtures\Taxonomies::response())
            ->getMock();

        $mapper = new TaxonomyMapper($client);
        $actualResult = $mapper->map(4, 'sectors');
        $this->assertEquals("Not For Profit (NFP)", $actualResult);
    }

    /**
     * @test
     * @group Integration
     */
    public function it_returns_empty_string_if_taxonomy_does_not_exist()
    {
        $client = Mockery::mock(ApiClient::class)
            ->shouldReceive('appData')
            ->once()
            ->withNoArgs()
            ->andReturn(Fixtures\Taxonomies::response())
            ->getMock();

        $mapper = new TaxonomyMapper($client);
        $actualResult = $mapper->map(4, 'cats');
        $this->assertEquals("", $actualResult);
    }
}
