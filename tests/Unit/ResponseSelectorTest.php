<?php

namespace EthicalJobs\Tests\SDK;

use EthicalJobs\SDK\ResponseSelector;

class ResponseSelectorTest extends TestCase
{
    /**
     * @test
     * @group Unit
     */
    public function it_can_set_and_get_ites_response()
    {
        $responseOne = [ 'data' => [ 'foo' => 'bar'] ];

        $responseTwo = [ 'datum' => [ 'foo' => 'bar-bar-bar'] ];

        $selector = new ResponseSelector($responseOne);

        $this->assertEquals($selector->getResponse(), $responseOne);

        $this->assertInstanceOf(ResponseSelector::class, $selector->setResponse($responseTwo));

        $this->assertEquals($selector->getResponse(), $responseTwo);
    }    

    /**
     * @test
     * @group Unit
     */
    public function it_can_select_an_entity_by_result()
    {
        $response = [
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
                'result' => 276,
            ],
        ];

        $selector = new ResponseSelector($response);

        $this->assertEquals($selector->byResult('users'), ['id' => 276, 'name' => 'Andrew']);
    }        

    /**
     * @test
     * @group Unit
     */
    public function it_returns_empty_array_when_params_are_invalid()
    {
        $response = [
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
        ];

        $selector = new ResponseSelector($response);

        $this->assertEquals($selector->byResult('foobar'), []);

        $response['data']['result'] = 82722;

        $this->assertEquals($selector->byResult('users'), []);
    }           
}
