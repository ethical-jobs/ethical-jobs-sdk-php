<?php

namespace EthicalJobs\SDK\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use EthicalJobs\SDK\HttpClient;
use EthicalJobs\SDK\Resources;

/**
 * Api resource repository
 *
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */

class ResourceRepository
{
    /**
     * Collection of api resources
     *
     * @var Illuminate\Support\Collection
     */
    protected $collection;

    /**
     * Returns collection of resources
     *
     * @return Void
     */
    public static function collection()
    {
        return new Collection([
            Resources\JobsResource::getName()           => Resources\JobsResource::class,
            Resources\InvoicesResource::getName()       => Resources\InvoicesResource::class,
            Resources\MediaResource::getName()          => Resources\MediaResource::class,
            Resources\OrganisationsResource::getName()  => Resources\OrganisationsResource::class,
            Resources\SearchResource::getName()         => Resources\SearchResource::class,
            Resources\UsersResource::getName()          => Resources\UsersResource::class,
        ]);
    }

    /**
     * Return a resource instance by name
     *
     * @param  String $name
     * @return EthicalJobs\SDK\ApiResource|null
     */
    public static function find($name)
    {
        $resouceClass = static::collection()->get($name);

        return $resouceClass ? static::make($resouceClass) : null;
    }

    /**
     * Return collection of resource instances
     *
     * @return Illuminate\Support\Collection
     */
    public static function all()
    {
        return static::collection()->map(function($resouceClass, $resourceName) {
            return static::make($resouceClass);
        });
    }

    /**
     * Make a resource instance
     *
     * @param String $resouceClass
     * @return EthicalJobs\SDK\ApiResource
     */
    protected static function make($resouceClass)
    {
        $http = App::make(HttpClient::class);

        return new $resouceClass($http);
    }    
}