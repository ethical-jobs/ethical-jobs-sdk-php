<?php

namespace EthicalJobs\Tests\SDK\Fixtures;

use Illuminate\Support\Collection;

class Requests
{
	/**
	 * Authentication response
	 *
	 * @param Integer $numberOfJobs
	 * @return Illuminate\Support\Collection
	 */
	public static function jobsCollection($numberOfJobs)
	{
		$job = [
			'id' 				=> 97953,
			'organisation_id' 	=> 3061,
			'organisation_uid' 	=> 'EACHBigSplash',
			'status' 			=> 'PENDING',
			'title' 			=> 'Mental Health Clinician - Psychological Strategies Team',
		];

		$response = new Collection;

		for ($i = 0; $i < $numberOfJobs; $i++) {
			$response->push($job);
		}

		return $response;
	}
}