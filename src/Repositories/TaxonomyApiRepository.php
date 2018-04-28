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
        return $this->taxonomies->get($id);
    }     

    /**
     * {@inheritdoc}
     */
    public function findByField(string $field, $value)
    {
        return $this->taxonomies->where($field, $value)->first();
    }        

    /**
     * {@inheritdoc}
     */
    public function where(string $field, $operator, $value = null): Repository
    {
        $this->taxonomies = $this->taxonomies->filter(function($item) use($field, $operator, $value) {
            switch ($operator) {
                case '>':   return $item[$field] > $value;
                case '<':   return $item[$field] < $value;
                case '>=':  return $item[$field] >= $value;
                case '<=':  return $item[$field] <= $value;
                case '!=':  return $item[$field] != $value;
                default:
                case '=':   return $item[$field] == $value;
            }
        });        

        return $this;
    }    

    /**
     * {@inheritdoc}
     */
    public function whereIn(string $field, array $values): Repository
    {
        $this->taxonomies = $this->taxonomies->whereIn($field, $values);

        return $this;        
    }    

    /**
     * {@inheritdoc}
     */
    public function orderBy(string $field, string $direction): Repository
    {
        $this->taxonomies = strtolower($direction) === 'desc' ?
            $this->taxonomies->sortByDesc($field) :
            $this->taxonomies->sortBy($field);

        return $this;           
    }            

    /**
     * {@inheritdoc}
     */
    public function limit(int $limit): Repository
    {
        $this->taxonomies = $this->taxonomies->take($limit);

        return $this;             
    }    

    /**
     * {@inheritdoc}
     */
    public function find(): Traversable
    {
        return $this->taxonomies;
    }  

    /**
     * Set the working taxonomy
     *
     * @param string $taxonomy
     * @return $this
     */
    public function taxonomy(string $taxonomy): Repository
    {
        $taxonomyArr = $this->taxonomies->get($taxonomy);

        $this->taxonomies = new Collection($taxonomyArr);

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