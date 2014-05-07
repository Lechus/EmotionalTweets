<?php namespace Lpp;

use Mockery;
use TestCase;

class TweetRepositoryTest extends TestCase
{

    public function tearDown()
    {
        Mockery::close();
    }
   
    /**
     * @covers Lpp\Tweet\TweetRepository::addAnalysis
     */
    public function testAddAnalysisForTweet()
    {
        //Arrange
        $tweetToAnalyze = $this->getTweet();
        $analyserMock   = $this->getAnalysisMock();
        $analyserMock
                ->shouldReceive("analyse")
                ->once()
                ->with("Looked into #laravel as a starting point for a web app..."
                        . "  28 Meg seems a bit much to start off with...", "en")
                ->andReturn('Happy');
        $tweeterRepository = new Tweet\TweetRepository($analyserMock);
        
        //Act
        $emotion = $tweeterRepository->addAnalysis($tweetToAnalyze);

        //Assert
        $this->assertArrayHasKey('emotion', $emotion[0], 'There should be emotion');
        $this->assertEquals('Happy', $emotion[0]['emotion'], 'It should be Happy');
    }

    
    /**
     * @covers Lpp\Tweet\TweetRepository::addAnalysis
     */
    public function testAddAnalysisForEmptyTweet()
    {
        //Arrange
        $tweetToAnalyze = array();
        $analyserMock   = $this->getAnalysisMock();
        $analyserMock
                ->shouldReceive("analyse")
                ->never()
                ->with("Looked into #laravel as a starting point for a web app..."
                        . "  28 Meg seems a bit much to start off with...", "en")
                ->andReturn('Happy');
        $tweeterRepository = new Tweet\TweetRepository($analyserMock);
        
        //Act
        $emotion = $tweeterRepository->addAnalysis($tweetToAnalyze);

        //Assert
       
        $this->assertEmpty($emotion, 'It should be empty array');
    }  
    
    
   /**
    * Mocked AnalysisInterface 
    * @return Mockery AnalysisInterface
    */
    protected function getAnalysisMock()
    {
        //Proxied Partial Mock
        return Mockery::mock("Lpp\Analysis\AnalysisInterface");
    }
    
    /**
     * Single Tweet
     * @return array
     */
    protected function getTweet()
    {
        return array(
            0 => array(
                'lang' => 'en',
                'text' => 'Looked into #laravel as a starting point for a web app...'
                        . '  28 Meg seems a bit much to start off with...'
            )
        );
    }

}
