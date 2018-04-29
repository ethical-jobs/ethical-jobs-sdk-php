<?php

namespace EthicalJobs\SDK;

use Illuminate\Support\Facades\Cache;

/**
 * Caches unique queries
 *
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */

class QueryCache 
{
	/**
	 * Cache key
	 *
	 * @var string
	 */
	protected static $cacheKey = 'ej:api:cache:';

	/**
	 * Remeber cachable
	 *
	 * @param string $route
	 * @param array $query
	 * @param callable $callback
	 * @return mixed
	 */
	public static function remember(string $route, array $query, callable $callback, $ttl = 5)
	{
		$queryKey = static::makeQueryKey($route, $query);

		return static::store($queryKey, $callback, $ttl);
	}	

	/**
	 * Get cachable
	 *
	 * @param string $route
	 * @param array $query
	 * @return mixed
	 */
	public static function get(string $route, array $query)
	{
		$queryKey = static::makeQueryKey($route, $query);

		return Cache::get($queryKey);
	}			

	/**
	 * Creates a unique cache key for the query params
	 *
	 * @param string $route
	 * @param array $query
	 * @return string
	 */
	protected static function makeQueryKey(string $route, array $query): string
	{
		$serialized = serialize($query);

		$route = str_replace('/', ':', $route);

		return static::$cacheKey.md5($route.':'.$serialized);
	}

	/**
	 * Store the data in cache driver
	 *
	 * @param string $queryKey
	 * @param callable $callback
	 * @return mixed
	 */
	protected static function store(string $queryKey, callable $callback, $ttl)
	{
		return Cache::remember($queryKey, $ttl, $callback);
	}	
}