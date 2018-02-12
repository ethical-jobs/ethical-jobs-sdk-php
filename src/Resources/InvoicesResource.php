<?php

namespace EthicalJobs\SDK\Resources;

/**
 * Invoices api resource
 *
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */

class InvoicesResource extends ApiResource
{
	/**
   	 * {@inheritdoc}
	 */		
	public static function getName()
	{
		return 'invoices';
	}
}