<?php

namespace EthicalJobs\SDK\Resources;

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
}