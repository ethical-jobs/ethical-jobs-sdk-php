<?php

namespace EthicalJobs\SDK\Resources;

/**
 * Users api resource
 *
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */

class UsersResource extends ApiResource
{
	/**
   	 * {@inheritdoc}
	 */		
	public static function getName()
	{
		return 'users';
	}
}