<?php

namespace EthicalJobs\SDK\Resources;

use EthicalJobs\SDK\Enumerables;
use Illuminate\Support\Collection;

/**
 * Jobs api resource
 *
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */

class JobsResource extends ApiResource
{
	/**
   	 * {@inheritdoc}
	 */		
	public static function getName()
	{
		return 'jobs';
	}

	/**
   	 * Returns approved jobs
   	 *
   	 * @param Array $params
   	 * @return Illuminate\Support\Collection
	 */		
	public function approved($params = [])
	{
		return $this->api->get('/jobs', array_merge([
			'status'	=> Enumerables\JobStatus::APPROVED(),
			'expired'	=> 0,
		], $params));
	}	

	/**
   	 * Patch a collection of jobs
   	 *
   	 * @param Illuminate\Support\Collection $jobs
   	 * @return Illuminate\Support\Collection
	 */		
	public function patchCollection(Collection $jobs)
	{
		return $this->collection('PATCH', $jobs);
	}		

	/**
   	 * Put a collection of jobs
   	 *
   	 * @param Illuminate\Support\Collection $jobs
   	 * @return Illuminate\Support\Collection
	 */		
	public function putCollection(Collection $jobs)
	{
		return $this->collection('PUT', $jobs);
	}	

	/**
   	 * Chunk and make requests on a collection resource
   	 *
   	 * @param Illuminate\Support\Collection $jobs
   	 * @return Illuminate\Support\Collection
	 */		
	protected function collection($verb, Collection $jobs)
	{
		$responses = [];

		foreach ($jobs->chunk(50) as $chunk) {

			$response = $this->api->$verb('/jobs/collection', ['jobs' => $chunk]);

			$responses = array_merge_recursive($responses, $response->toArray());
		}

		return new Collection($responses);
	}		
}