<?php

use Lpp\Analysis\UnirestAnalysis;

class UnirestAnalysisTest extends TestCase
{

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        Mockery::close();
    }

    /**
     * @covers Lpp\Analysis\UnirestAnalysis::analyse
     */
    public function testAnalyse()
    {
        //Arrange
        $unirestMock = $this->getUnirestMock();
        $unirestAnalyser = new UnirestAnalysis($unirestMock);
        
        //Act
        $emotion = $unirestAnalyser->analyse('text', 'en');

        //Assert
        $this->assertEquals('Happy', $emotion, 'It should be Happy'); 
    }
    
   /**
    * Return custom Unirest response object
    * @return object
    */
    protected function getMashapeUnirestResponse()
    {        
        $response = new stdClass();
        $body = new stdClass();
        $body->language = "en";
        $body->value = 0.50055610583463;
        $body->sent  = 1;
        
        $response->body = $body;
    
        return $response;   
    }

    /**
     * Mocking Mashape/Unirest from package
     * @return Mockery Mock
     */
    protected function getUnirestMock()
    {
       $unirestMock = Mockery::mock('Unirest');
       $unirestMock
                ->shouldReceive('post')
                ->once()
                ->andReturn($this->getMashapeUnirestResponse());
       return $unirestMock;
    }

}
