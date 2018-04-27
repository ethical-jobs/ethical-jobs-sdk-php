<?php

namespace EthicalJobs\SDK\Resources;

use EthicalJobs\SDK\ResponseSelector;

/**
 * Taxonomy api resource
 *
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */

class TaxonomyResource extends ApiResource
{
	/**
   	 * {@inheritdoc}
	 */		
	public static function getName()
	{
		return 'taxonomies';
	}

	/**
	 * Fetch {taxonomy} term by {id}
	 * 
	 * @param string $taxonomy
	 * @param int $id
	 */
	public function getTermById(string $taxonomy, int $id): array
	{
		$response = $this->api->appData();

		return ResponseSelector::select($response)->taxonomyTermById($taxonomy, $id);
	}		
}