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
        $responseOne = collect([ 'data' => [ 'foo' => 'bar'] ]);

        $responseTwo = collect([ 'datum' => [ 'foo' => 'bar-bar-bar'] ]);

        $selector = ResponseSelector::select($responseOne);

        $this->assertEquals($selector->getResponse(), $responseOne);

        $this->assertInstanceOf(ResponseSelector::class, $selector->setResponse($responseTwo));

        $this->assertEquals($selector->getResponse(), $responseTwo);
    }    
}
