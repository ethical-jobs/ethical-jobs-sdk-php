<?php

namespace EthicalJobs\SDK\Authentication;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Cache\Repository;
use EthicalJobs\SDK\HttpClient;

/**
 * Token Authenticator
 *
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */

class TokenAuthenticator implements Authenticator
{
	/**
	 * Auth token cache key
	 *
	 * @var string
	 */
	protected $tokenKey = 'ej:pkg:sdk:token';

	/**
	 * Auth token cache lifespan (minutes)
	 *
	 * @var string
	 */
	protected $tokenTTL = 60; // refresh the token every hour

	/**
	 * Http client
	 *
	 * @var \EthicalJobs\SDK\HttpClient
	 */
	protected $http;

	/**
	 * Cache instance
	 *
	 * @var \Illuminate\Contracts\Cache\Repository
	 */
	protected $cache;	

	/**
	 * Http credentials
	 *
	 * @var Arary
	 */
	protected $credentials = [
    	'client_id' 	=> '',
    	'client_secret' => '',		
	];	

	/**
	 * Object constructor
	 *
	 * @param 
	 */
	public function __construct(HttpClient $http, Repository $cache, Array $credentials = [])
	{
		$this->http = $http;

		$this->cache = $cache;

		$this->setCredentials($credentials);
	}

    /**
     * {@inheritdoc}
     */	
	public function authenticate(Request $request)
	{
		return $request->withAddedHeader('Authorization', "Bearer {$this->getToken()}");
	}	

	/**
	 * Gets the token 
	 *
	 * @return string
	 */
	public function getToken()
	{
		return $this->cache->remember($this->tokenKey, $this->tokenTTL, function () {
		    return $this->fetchToken();
		});
	}	

	/**
	 * Sets credentials
	 *
	 * @param Array $credentials
	 * @return $this
	 */
	public function setCredentials(Array $credentials)
	{
		if (isset($credentials['client_id'])) {
			$this->credentials['client_id'] = $credentials['client_id'];
		}

		if (isset($credentials['client_secret'])) {
			$this->credentials['client_secret'] = $credentials['client_secret'];
		}

		return $this;
	}


	/**
	 * Fetches an Auth token
	 * 
	 * @return [type] [description]
	 */
	protected function fetchToken()
	{	
		$response = $this->http->post('/oauth/token', array_merge([
        	'grant_type' 	=> 'client_credentials',
        	'scope' 		=> '*',			
		], $this->credentials));

		return isset($response['access_token']) ? $response['access_token'] : '';
	}	
}