<?php

namespace EthicalJobs\SDK;

/**
 * Response selector
 *
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */

class ResponseSelector 
{
	/**
	 * Response array
	 *
	 * @var array
	 */
	protected $response = [];

	/**
	 * Object constructor
	 *
	 * @param array $response
	 * @return void
	 */
	public function __construct(array $response)
	{
		$this->setResponse($response);
	}	

	/**
	 * Sets the current response array
	 *
	 * @param array $response
	 * @return $this
	 */
	public function setResponse(array $response): ResponseSelector
	{
		$this->response = $response;

		return $this;
	}

	/**
	 * Gets the current response array
	 *
	 * @return array
	 */
	public function getResponse(): array
	{
		return $this->response;
	}	

	/**
	 * Returns an entity by current response result
	 *
	 * @param string $entity
	 * @return array
	 */
	public function byResult(string $entity): array
	{
		$result = array_get($this->response, "data.result", '');

		return array_get($this->response, "data.entities.$entity.$result", []);
	}
}