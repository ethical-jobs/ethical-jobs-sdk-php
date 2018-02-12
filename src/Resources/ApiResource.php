<?php

namespace EthicalJobs\SDK\Resources;

use EthicalJobs\SDK\HttpClient;

/**
 * Base api resource 
 *
 * @author  Andrew McLagan <andrew@ethicaljobs.com.au>
 */

abstract class ApiResource
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
	 * @param \EthicalJobs\SDK\HttpClient
	 * @return Void
	 */
	public function __construct(HttpClient $http)
	{
		$this->http = $http;
	}	

   	/**
   	 * Get resource name
   	 * 
   	 * @return String
   	 */
   	abstract public static function getName();

   	/**
   	 * Return route to the resource
   	 * 
   	 * @param  String $subRoute
   	 * @return String
   	 */
    protected function getResourceRoute($subRoute = '')
    {   	
    	return '/'.static::getName().'/'.ltrim($subRoute, '/');
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

    		$subRoute = is_string($arguments[0]) ? $arguments[0] : '';

    		$route = $this->getResourceRoute($subRoute);

    		if (isset($arguments[0]) && is_array($arguments[0])) {
    			$parameters = $arguments[0];
    		} else if (isset($arguments[1]) && is_array($arguments[1])) {
    			$parameters = $arguments[1];
    		} else {
    			$parameters = [];
    		}

    		return $this->http->$name($route, $parameters);
    	}
        
        throw new \Exception("Invalid resource http call '".class_name($this)."'");
    }  
}