<?php

namespace EthicalJobs\Tests\SDK;

use EthicalJobs\Tests\SDK\Fixtures;
use Illuminate\Support\Facades\Cache;
use EthicalJobs\SDK\QueryCache;

class QueryCacheTest extends TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_returns_the_data_its_passed()
    {
        $data = Fixtures\Taxonomies::queryResponse();

        $route = '/search/jobs';

        $query = ['foo' => 'bar', 'hello' => 'world'];

        $result = QueryCache::remember($route, $query, function () use ($data) {
            return $data;
        });

        $this->assertEquals($data, $result);
    }

    /**
     * @test
     * @group Unit
     */
    public function it_can_cache_data()
    {
        $data = Fixtures\Taxonomies::queryResponse();

        $route = '/search/jobs';

        $query = ['foo' => 'bar', 'hello' => 'world'];

        $result = QueryCache::remember($route, $query, function () use ($data) {
            return $data;
        });

        $this->assertEquals($data, $result);

        $result = QueryCache::get($route, $query);

        $this->assertEquals($data, $result);
    }    

    /**
     * @test
     * @group Unit
     */
    public function it_can_cache_data_unique_to_a_query()
    {
        $data = Fixtures\Taxonomies::queryResponse();

        $route = '/search/jobs';

        $query = ['foo' => 'bar', 'hello' => 'world'];

        $result = QueryCache::remember($route, $query, function () use ($data) {
            return $data;
        });

        $this->assertEquals($data, $result);

        $result = QueryCache::get($route, ['foo' => 'bam', 'hello' => 'bam']);

        $this->assertNotEquals($data, $result);
    }       
}
