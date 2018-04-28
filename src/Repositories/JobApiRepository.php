<?php

namespace EthicalJobs\SDK\Repositories;

use Traversable;
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
        $this->setStorageEngine($api); 
    }

    /**
     * {@inheritdoc}
     */
    public function getStorageEngine()
    {
        return $this->api;
    }

    /**
     * {@inheritdoc}
     */
    public function setStorageEngine($storage)
    {
        $this->api = $storage;

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
        return $this->api->get("/jobs?$field=$value&limit=1");
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
    public function find(): Traversable
    {
        return $this->api->get('/search/jobs', $this->query);
    }  

    /**
     * Patch a collection of jobs
     *
     * @param EthicalJobs\SDK\Collection $jobs
     * @return EthicalJobs\SDK\Collection
     */     
    public function patchCollection(Collection $jobs)
    {
        return $this->updateCollection('PATCH', $jobs);
    }       

    /**
     * Put a collection of jobs
     *
     * @param EthicalJobs\SDK\Collection $jobs
     * @return EthicalJobs\SDK\Collection
     */     
    public function putCollection(Collection $jobs)
    {
        return $this->updateCollection('PUT', $jobs);
    }   

    /**
     * Chunk and make requests on a collection resource
     *
     * @param EthicalJobs\SDK\Collection $jobs
     * @return EthicalJobs\SDK\Collection
     */     
    protected function updateCollection($verb, Collection $jobs)
    {
        $responses = [];

        foreach ($jobs->chunk(50) as $chunk) {

            $verb = strtolower($verb);

            $response = $this->api->$verb('/jobs/collection', ['jobs' => $chunk]);

            $responses = array_merge_recursive($responses, $response->toArray());
        }

        return new Collection($responses);
    }       

    /**
     * {@inheritdoc}
     */
    public function asModels(): Repository { }    

    /**
     * {@inheritdoc}
     */
    public function asObjects(): Repository { }    
    
    /**
     * {@inheritdoc}
     */
    public function asArrays(): Repository { }            
}