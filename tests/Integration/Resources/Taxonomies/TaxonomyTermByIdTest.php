<?php

namespace EthicalJobs\Tests\SDK\Resources\Jobs;

use Mockery;
use EthicalJobs\SDK\Resources\TaxonomyResource;
use EthicalJobs\Tests\SDK\TestCase;
use EthicalJobs\Tests\SDK\Fixtures;
use EthicalJobs\SDK\ApiClient;

class TermByIdTest extends TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_can_retrieve_a_category_taxonomy_term()
    {
        $api = Mockery::mock(ApiClient::class)
            ->shouldReceive('appData')
            ->once()
            ->withNoArgs()
            ->andReturn(Fixtures\Taxonomies::response())
            ->getMock();

        $taxonomies = new TaxonomyResource($api);

        $term = $taxonomies->getTermById('categories', 21);

        $this->assertEquals($term, [
            'id'        => 21,
            'slug'      => 'financeandaccounting',
            'title'     => 'Finance and Accounting',
            'job_count' => 36,         
        ]);
    }    

    /**
     * @test
     * @group Unit
     */
    public function it_can_retrieve_a_location_taxonomy_term()
    {
        $api = Mockery::mock(ApiClient::class)
            ->shouldReceive('appData')
            ->once()
            ->withNoArgs()
            ->andReturn(Fixtures\Taxonomies::response())
            ->getMock();

        $taxonomies = new TaxonomyResource($api);

        $term = $taxonomies->getTermById('locations', 9);

        $this->assertEquals($term, [
            'id'    => 9,
            'slug'  => 'SA',
            'title' => 'Adelaide',
        ]);
    }        

    /**
     * @test
     * @group Unit
     */
    public function it_can_retrieve_a_sector_taxonomy_term()
    {
        $api = Mockery::mock(ApiClient::class)
            ->shouldReceive('appData')
            ->once()
            ->withNoArgs()
            ->andReturn(Fixtures\Taxonomies::response())
            ->getMock();

        $taxonomies = new TaxonomyResource($api);

        $term = $taxonomies->getTermById('sectors', 4);

        $this->assertEquals($term, [
            'id'    => 4,
            'slug'  => 'Not For Profit (NFP)',
            'title' => 'Not For Profit (NFP)',
        ]);
    }    

    /**
     * @test
     * @group Unit
     */
    public function it_can_retrieve_a_workType_taxonomy_term()
    {
        $api = Mockery::mock(ApiClient::class)
            ->shouldReceive('appData')
            ->once()
            ->withNoArgs()
            ->andReturn(Fixtures\Taxonomies::response())
            ->getMock();

        $taxonomies = new TaxonomyResource($api);

        $term = $taxonomies->getTermById('workTypes', 6);

        $this->assertEquals($term, [
            'id'    => 6,
            'slug'  => 'VOLUNTEER',
            'title' => 'Volunteer',
        ]);
    }          

    /**
     * @test
     * @group Unit
     */
    public function it_returns_empty_array_when_not_found()
    {
        $api = Mockery::mock(ApiClient::class)
            ->shouldReceive('appData')
            ->once()
            ->withNoArgs()
            ->andReturn(Fixtures\Taxonomies::response())
            ->getMock();

        $taxonomies = new TaxonomyResource($api);

        $term = $taxonomies->getTermById('foo', 123);

        $this->assertEquals($term, []);
    }       
}
