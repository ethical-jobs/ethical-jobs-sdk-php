<?php

namespace EthicalJobs\SDK;

use Illuminate\Support\Collection;

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
	 * @var Illuminate\Support\Collection
	 */
	protected $response = [];

	/**
	 * Object constructor
	 *
	 * @param Illuminate\Support\Collection $response
	 * @return void
	 */
	private function __construct(Collection $response)
	{
		$this->setResponse($response);
	}	

	/**
	 * Static class instantiation
	 *
	 * @param Illuminate\Support\Collection $response
	 * @return $this
	 */
	public static function select(Collection $response): ResponseSelector
	{
		return new static($response);
	}	

	/**
	 * Sets the current response array
	 *
	 * @param Illuminate\Support\Collection $response
	 * @return $this
	 */
	public function setResponse(Collection $response): ResponseSelector
	{
		$this->response = $response;

		return $this;
	}

	/**
	 * Gets the current response
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function getResponse(): Collection
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

	/**
	 * Returns an entity by id
	 *
	 * @param string $entity
	 * @param int $id
	 * @return array
	 */
	public function byId(string $entity, int $id): array
	{
		return array_get($this->response, "data.entities.$entity.$id", []);
	}	
}