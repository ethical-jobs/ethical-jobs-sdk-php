<?php

namespace EthicalJobs\Tests\SDK;

use EthicalJobs\SDK\ResponseSelector;

class TaxonomyByIdTest extends TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_can_select_a_term_by_id()
    {
        $response = collect([
            'data' => [
                'taxonomies'  => [
                    'categories'  => [
                        827 => ['id' => 827, 'title' => 'Developer'],
                        276 => ['id' => 276, 'title' => 'Engineer'],
                        98  => ['id' => 98, 'title' => 'Web Designer'],
                    ],
                    'locations' => [
                        111 => ['id' => 111, 'title' => 'Bellingen'],
                        276 => ['id' => 276, 'title' => 'South Australia'],
                        182 => ['id' => 182, 'title' => 'Northcote'],
                    ],
                ],
            ],
        ]);

        $this->assertEquals(ResponseSelector::select($response)->taxonomyTermById('categories', 276), [
            'id' => 276, 'title' => 'Engineer'
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
                'taxonomies'  => [
                    'categories'  => [
                        827 => ['id' => 827, 'title' => 'Developer'],
                        276 => ['id' => 276, 'title' => 'Engineer'],
                        98  => ['id' => 98, 'title' => 'Web Designer'],
                    ],
                    'locations' => [
                        111 => ['id' => 111, 'title' => 'Bellingen'],
                        276 => ['id' => 276, 'title' => 'South Australia'],
                        182 => ['id' => 182, 'title' => 'Northcote'],
                    ],
                ],
            ],
        ]);

        $this->assertEquals(ResponseSelector::select($response)->taxonomyTermById('categories', 8726347823), []);
        $this->assertEquals(ResponseSelector::select($response)->taxonomyTermById('locality', 111), []);
    }           
}
