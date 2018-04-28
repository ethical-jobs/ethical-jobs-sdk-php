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

class TaxonomyApiRepository implements Repository
{
    /**
     * Api client
     *
     * @var EthicalJobs\SDK\ApiClient
     */
    protected $api;   

    /**
     * Taxonomies collection
     *
     * @var EthicalJobs\SDK\Collection
     */
    protected $taxonomies;

    /**
     * Current working taxonomy
     *
     * @var string
     */
    protected $taxonomy = '';    

    /**
     * Object constructor
     *
     * @param EthicalJobs\SDK\ApiClient $api
     */
    public function __construct(ApiClient $api)
    {
        $this->setStorageEngine($api); 

        $this->fetchTaxonomies();
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
        $response = $this->api->appData();

        return ResponseSelector::select($response)->taxonomyTermById($taxonomy, $id);
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
     * Set the working taxonomy
     *
     * @param string $taxonomy
     * @return $this
     */
    public function taxonomy(string $taxonomy): Repository
    {
        $this->taxonomy = $taxonomy;

        return $this;
    }      

    /**
     * Patch a collection of jobs
     *
     * @param EthicalJobs\SDK\Collection $jobs
     * @return EthicalJobs\SDK\Collection
     */     
    protected function fetchTaxonomies()
    {
        $response = $this->api->appData();

        $taxonomies = array_get($response, 'data.taxonomies', []);

        $this->taxonomies = new Collection($taxonomies);
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