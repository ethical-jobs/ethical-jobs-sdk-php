<?php

namespace EthicalJobs\Tests\SDK\Fixtures;

use EthicalJobs\SDK\Collection;

class Requests
{
	/**
	 * Authentication response
	 *
	 * @param Integer $numberOfJobs
	 * @return EthicalJobs\SDK\Collection
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