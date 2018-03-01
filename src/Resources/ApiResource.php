<?php

namespace EthicalJobs\SDK\Resources;

use EthicalJobs\SDK\HttpClient;
use EthicalJobs\SDK\Router;

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
}