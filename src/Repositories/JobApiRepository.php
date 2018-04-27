<?php

namespace EthicalJobs\SDK\Repositories;

use EthicalJobs\SDK\ApiClient;
use EthicalJobs\SDK\Collection;
use EthicalJobs\Foundation\Storage\Repository;

/**
 * Api resource repository
 *
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */

class JobApiRepository implements Repository
{
    /**
     * Api client instance
     *
     * @var EthicalJobs\SDK\ApiClient
     */
    protected $api;

    /**
     * Cache lifespan in minutes
     *
     * @var int
     */
    protected $cacheTTL = 5; 

    /**
     * Cache key namespace
     *
     * @var string
     */
    protected $cacheKey = 'ej:api:cache:jobs:';     

    /**
     * Http query vars
     *
     * @var array
     */
    protected $query = [];     

    /**
     * Object constructor
     *
     * @param EthicalJobs\SDK\ApiClient $api
     */
    public function __construct(ApiClient $api)
    {
        $this->response = new Collection;

        $this->setQuery($api); 
    }

    /**
     * {@inheritdoc}
     */
    public function getQuery()
    {
        return $this->api;
    }

    /**
     * {@inheritdoc}
     */
    public function setQuery($query)
    {
        $this->api = $query;

        return $this;
    }    

    /**
     * {@inheritdoc}
     */
    public function findById($id)
    {
        return $this->api->get("/jobs/$id");
    }     

    /**
     * {@inheritdoc}
     */
    public function findByField(string $field, $value)
    {
        $response = $this->api->get("/jobs?$field=$value&limit=1");

        $jobs = $response->select()->entities('jobs');

        return $jobs->first();
    }        

    /**
     * {@inheritdoc}
     */
    public function where(string $field, $operator, $value = null): Repository
    {
        $this->query[$field] = $value;

        return $this;
    }    

    /**
     * {@inheritdoc}
     */
    public function whereIn(string $field, array $values): Repository
    {
        $this->query[$field] = $values;

        return $this;        
    }    

    /**
     * {@inheritdoc}
     */
    public function orderBy(string $field, string $direction): Repository
    {
        $this->query['orderBy'] = $field;

        $this->query['order'] = $direction;

        return $this;           
    }            

    /**
     * {@inheritdoc}
     */
    public function limit(int $limit): Repository
    {
        $this->query['limit'] = $limit;

        return $this;             
    }    

    /**
     * {@inheritdoc}
     */
    public function asModels(): Repository
    {
        // N/A for API repositories
    }    

    /**
     * {@inheritdoc}
     */
    public function asObjects(): Repository  
    {
        // To do...
    }    
    
    /**
     * {@inheritdoc}
     */
    public function asArrays(): Repository    
    {
        // default behaviour
    }                    

    /**
     * {@inheritdoc}
     */
    public function find(): Traversable
    {
        $this->response = $this->fetchFromCache();
    }   

    /**
     * Fetch jobs from api
     *
     * @return 
     */
    protected function fetch(): Collection
    {
        $response = $this->api->get('/search/jobs', $this->query)

        return $response;
    }      

    /**
     * Fetch jobs from cache
     *
     * @return 
     */
    protected function fetchFromCache(): Collection
    {
        $queryKey = $this->getQueryKey();

        if ($this->checkQueryKey($queryKey)) {
            return Cache::get($queryKey);
        }

        $jobs = $this->fetch();

        Cache::put($queryCacheKey, $jobs, $this->cacheTTL);

        return $jobs;
    } 

    /**
     * Generates a cache key for the query
     *
     * @return $this
     */
    protected function getQueryKey(): string
    {          
        $paramsAsJson = json_encode($this->query);

        return $this->cacheKey.Hash::make($paramsAsJson);
    }

    /**
     * Validates a cache key for the query
     *
     * @param string $queryKey
     * @return bool
     */
    protected function checkQueryKey(string $queryKey): bool
    {          
        if (Cache::has($queryKey)) {

            $paramsAsJson = json_encode($this->query);

            $hash = str_after($queryKey, $this->cacheKey);

            return Hash::check($paramsAsJson, $hash);
        }

        return false;
    }    
}