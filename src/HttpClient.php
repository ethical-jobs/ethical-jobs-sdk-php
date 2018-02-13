<?php

namespace EthicalJobs\SDK;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use EthicalJobs\SDK\Authentication\Authenticator;

/**
 * Http client
 *
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */

class HttpClient 
{
	/**
	 * Guzzle client
	 *
	 * @var \GuzzleHttp\Client 
	 */
	protected $client;

	/**
	 * Guzzle client
	 *
	 * @var \EthicalJobs\SDK\Authenticator 
	 */
	protected $authenticator;	

	/**
	 * Api environment
	 *
	 * @var String
	 */
	protected $environment;	

	/**
	 * PSR7 request
	 *
	 * @var GuzzleHttp\Psr7\Request
	 */
	protected $request;	

	/**
	 * PSR7 response
	 *
	 * @var GuzzleHttp\Psr7\Response
	 */
	protected $response;		

	/**
	 * Object constructor
	 *
	 * @param \GuzzleHttp\Client $client
	 * @param \EthicalJobs\SDK\Authenticator $auth
	 * @param String $environment
	 * @return Void
	 */
	public function __construct(Client $client, Authenticator $auth = null, $environment = 'production')
	{
		$this->client = $client;

		$this->environment = $environment;

		$this->authenticator = $auth;
	}

	/**
	 * Http get request
	 * 
	 * @param  string $route   
	 * @param  array  $body    
	 * @param  array  $headers 
	 * @return Illuminate\Support\Collection     
	 */
	public function get(string $route, $body = [], $headers = [])
	{
		return $this->request('GET', $route, $body, $headers);
	}	

	/**
	 * Http post request
	 * 
	 * @param  string $route   
	 * @param  array  $body    
	 * @param  array  $headers 
	 * @return Illuminate\Support\Collection      
	 */
	public function post(string $route, $body = [], $headers = [])
	{
		return $this->request('POST', $route, $body, $headers);
	}

	/**
	 * Http put request
	 * 
	 * @param  string $route   
	 * @param  array  $body    
	 * @param  array  $headers 
	 * @return Illuminate\Support\Collection     
	 */
	public function put(string $route, $body = [], $headers = [])
	{
		return $this->request('PUT', $route, $body, $headers);
	}

	/**
	 * Http patch request
	 * 
	 * @param  string $route   
	 * @param  array  $body    
	 * @param  array  $headers 
	 * @return Illuminate\Support\Collection            
	 */
	public function patch(string $route, $body = [], $headers = [])
	{
		return $this->request('PATCH', $route, $body, $headers);
	}

	/**
	 * Http delete request
	 * 
	 * @param  string $route   
	 * @param  array  $body    
	 * @param  array  $headers 
	 * @return Illuminate\Support\Collection  
	 */
	public function delete(string $route, $body = [], $headers = [])
	{
		return $this->request('DELETE', $route, $body, $headers);
	}		

	/**
	 * Makes a http request
	 * 
	 * @param  string $verb    
	 * @param  string $route   
	 * @param  array  $body    
	 * @param  array  $headers 
	 * @return Illuminate\Support\Collection         
	 */
	public function request(string $verb, string $route, $body = [], $headers = [])
	{
		$request = $this->createRequest($verb, $route, $body, $headers);

		$request = $this->authenticateRequest($request);

		$response = $this->dispatchRequest($request);

		$this->response = $response;

		return $this->parseResponse($response);
	}

	/**
	 * Sets the current request instance
	 * 
	 * @param GuzzleHttp\Psr7\Request $request
	 * @return $this
	 */
	public function setRequest(Request $request)
	{
		$this->request = $request;

		return $this;
	}

	/**
	 * Gets the current request instance
	 * 
	 * @return GuzzleHttp\Psr7\Request
	 */
	public function getRequest()
	{
		return $this->request;
	}	

	/**
	 * Gets the current response instance
	 * 
	 * @return GuzzleHttp\Psr7\Response
	 */
	public function getResponse()
	{
		return $this->response;
	}		

	/**
	 * Gets the request authenticator
	 *
	 * @param GuzzleHttp\Psr7\Request $request
	 * @return GuzzleHttp\Psr7\Request
	 */
	protected function authenticateRequest(Request $request)
	{
		if ($this->authenticator) {
			return $this->authenticator->authenticate($request);
		}

		return $request;
	}			

	/**
	 * Creates and sets the request instance
	 *
	 * @param  string $verb
	 * @param  string $route
	 * @param  array $body
	 * @param  array $headers
	 * @return GuzzleHttp\Psr7\Request
	 */
	protected function createRequest(string $verb, string $route, $body = [], $headers = [])
	{
		$request = new Request(
			$verb, 
			$this->getRouteUrl($route), 
			$this->mergeDefaultHeaders($headers), 
			json_encode($body)
		);

		$this->setRequest($request);

		return $request;
	}

	/**
	 * Dispatches a request and returns a response instance
	 *
	 * @param GuzzleHttp\Psr7\Request $request
	 * @return GuzzleHttp\Psr7\Response
	 */
	protected function dispatchRequest(Request $request)
	{
		return $this->client->send($request);
	}

	/**
	 * Prases a response and returns a collection or item
	 * 
	 * @return Illuminate\Support\Collection
	 */
	protected function parseResponse(Response $response)
	{
		if ($response->getStatusCode() > 199 && $response->getStatusCode() < 299) {
            if ($body = json_decode($response->getBody()->getContents(), 1)) {
            	return new Collection($body);
            }			

            return new Collection([]);
		}
	}	

	/**
	 * Returns full URL for a requet route
	 * 
	 * @param string $route
	 * @return string
	 */
	protected function getRouteUrl(string $route)
	{
		switch ($this->environment) {
			case 'staging':
				$host = 'api.ethicalstaging.com.au';
				break;						
			case 'development':	
			case 'testing':
				$host = 'api-app';
				break;			
			case 'production':
			default:
				$host = 'api.ethicaljobs.com.au';
				break;
		}

		return "https://{$host}{$route}";
	}	

	/**
	 * Merges degfault headers with user defined headers
	 * 
	 * @param Array $headers
	 * @return Array
	 */
	protected function mergeDefaultHeaders(Array $headers = [])
	{
		return array_merge([
			'Content-Type' => 'application/json',
		], $headers);
	}					
}