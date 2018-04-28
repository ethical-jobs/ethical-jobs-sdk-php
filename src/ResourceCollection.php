<?php

namespace EthicalJobs\SDK;

use EthicalJobs\SDK\Repositories;
use EthicalJobs\Foundation\Storage\Repository;

/**
 * Api resource collection
 *
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */

class ResourceCollection extends \Illuminate\Support\Collection
{
    /**
     * Create a new collection.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(static::resources());
    }    

    /**
     * Returns api resources
     *
     * @return array
     */
    protected static function resources(): array
    {
        return [
            'jobs'          => Repositories\JobsApiRepository::class,
            'taxonomies'    => Repositories\TaxonomyApiRepository::class,
        ];
    }

    /**
     * Make a resource repository instance
     *
     * @param string $resouceClass
     * @return EthicalJobs\SDK\ApiResource
     */
    public static function makeResourceRepository(string $resouceClass): Repository
    {
        $api = App::make(ApiClient::class);

        return new $resouceClass($api);
    }    
}