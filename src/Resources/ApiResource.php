<?php

namespace EthicalJobs\SDK\Resources;

use EthicalJobs\SDK\ApiClient;
use EthicalJobs\SDK\Router;

/**
 * Base api resource 
 *
 * @author  Andrew McLagan <andrew@ethicaljobs.com.au>
 */

abstract class ApiResource
{
	/**
	 * Api client
	 *
	 * @var \EthicalJobs\SDK\ApiClient
	 */
	protected $api;

	/**
	 * Object constructor
	 *
	 * @param \EthicalJobs\SDK\ApiClient
	 * @return Void
	 */
	public function __construct(ApiClient $api)
	{
		$this->api = $api;
	}	

   	/**
   	 * Get resource name
   	 * 
   	 * @return String
   	 */
   	abstract public static function getName();
}