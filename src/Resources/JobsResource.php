<?php

namespace EthicalJobs\SDK\Resources;

use EthicalJobs\SDK\Enumerables;

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
		return $this->http->get('/jobs', array_merge([
			'status'	=> Enumerables\JobStatus::APPROVED(),
			'expired'	=> 0,
		], $params));
	}	
}