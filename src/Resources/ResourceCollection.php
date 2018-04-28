<?php

namespace EthicalJobs\SDK\Resources;

use Illuminate\Support\Facades\App;
use EthicalJobs\SDK\ApiClient;

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
            JobsResource::getName()     => static::makeResource(JobsResource::class),
            TaxonomyResource::getName() => static::makeResource(TaxonomyResource::class),
        ];
    }

    /**
     * Make a resource instance
     *
     * @param String $resouceClass
     * @return EthicalJobs\SDK\ApiResource
     */
    protected static function makeResource(string $resouceClass): ApiResource
    {
        $api = App::make(ApiClient::class);

        return new $resouceClass($api);
    }    
}