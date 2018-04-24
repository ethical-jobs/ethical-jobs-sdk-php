<?php

namespace EthicalJobs\Tests\SDK;

use EthicalJobs\SDK\ResponseSelector;

class ResponseSelectorEntitiesTest extends TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_can_select_an_entities_array()
    {
        $response = collect([
            'data' => [
                'entities'  => [
                    'jobs'  => [
                        827 => ['id' => 827, 'title' => 'Developer'],
                        276 => ['id' => 276, 'title' => 'Engineer'],
                        98  => ['id' => 98, 'title' => 'Web Designer'],
                    ],
                    'users' => [
                        111 => ['id' => 111, 'name' => 'John'],
                        276 => ['id' => 276, 'name' => 'Andrew'],
                        182 => ['id' => 182, 'name' => 'Jan'],
                    ],
                ],
                'result' => 276,
            ],
        ]);

        $this->assertEquals(ResponseSelector::select($response)->entities('jobs'), [
            827 => ['id' => 827, 'title' => 'Developer'],
            276 => ['id' => 276, 'title' => 'Engineer'],
            98  => ['id' => 98, 'title' => 'Web Designer'],
        ]);
    }        

    /**
     * @test
     * @group Unit
     */
    public function it_returns_empty_array_when_params_are_invalid()
    {
        $response = collect([
            'data' => [
                'entities'  => [
                    'jobs'  => [
                        827 => ['id' => 827, 'title' => 'Developer'],
                        276 => ['id' => 276, 'title' => 'Engineer'],
                        98 => ['id' => 98, 'title' => 'Web Designer'],
                    ],
                    'users' => [
                        111 => ['id' => 111, 'name' => 'John'],
                        276 => ['id' => 276, 'name' => 'Andrew'],
                        182 => ['id' => 182, 'name' => 'Jan'],
                    ],
                ],
                'result' => 7363,
            ],
        ]);

        $this->assertEquals(ResponseSelector::select($response)->entities('foobar'), []);
    }           
}