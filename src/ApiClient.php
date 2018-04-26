<?php

namespace EthicalJobs\SDK;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Cache;
use EthicalJobs\SDK\Repositories\ResourceRepository;
use EthicalJobs\SDK\Router;

/**
 * EthicalJobs api client
 *
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */

class ApiClient 
{
	/**
	 * Http client
	 *
	 * @var \EthicalJobs\SDK\HttpClient
	 */
	protected $http;

	/**
	 * Object constructor
	 *
	 * @return  Void
	 */
	public function __construct(HttpClient $http)
	{
		$this->http = $http;
	}

	/**
	 * Resource accessor
	 * 
	 * @param  String $resourceName
	 * @return EthicalJobs\SDK\Resources\ApiResource
	 */
   	public function resource($resourceName)
   	{	
   		if ($resource = ResourceRepository::find($resourceName)) {
   			return $resource;
   		}

   		throw new \Exception("Invalid api resource '{$resourceName}'");
   	}

	/**
	 * Retrieves app-data from `api.ethicaljobs.com.au/` base route
	 * 
	 * @return EthicalJobs\SDK\Collection
	 */
   	public function appData()
   	{
        return Cache::remember('ej:sdk:app-data', 120, function(){
            return $this->http->get('/');
        });		
   	}	   	

	/**
	 * Dynamic api resource properties
	 * 
	 * @param  String $resourceName
	 * @return EthicalJobs\SDK\Resources\ApiResource
	 */
   	public function __get($resourceName)
   	{
   		return $this->resource($resourceName);
   	}	

   	/**
   	 * Dynamic http verb methods
   	 * 
   	 * @param  String $name
   	 * @param  Array $arguments
   	 * @return Mixed
   	 */
    public function __call($name, $arguments)
    {
    	if (method_exists($this->http, $name)) {
    		return $this->http->$name(...$arguments);
    	}
        
        throw new \Exception("Invalid http call '{$name}'");
    }   	
}