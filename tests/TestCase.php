<?php

namespace EthicalJobs\Tests\SDK;

use EthicalJobs\SDK\Laravel\ServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
	/**
	 * Inject package service provider
	 * 
	 * @param  Application $app
	 * @return Array
	 */
	protected function getPackageProviders($app)
	{
	    return [
	    	ServiceProvider::class,
	   	];
	}
}