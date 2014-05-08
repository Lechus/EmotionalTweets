<?php

class TwitterControllerTest2 extends TestCase
{

    
    /**
     * @covers TwitterController::searchTweets
     */
    public function testSearchTweetsWithInput()
    {
        //Arrange
        $search = "@re_systems";
        $validatorMock = $this->getValidatorMock();
        $validatorMock
                ->shouldReceive("with")
                ->once()
                ->andReturn(Mockery::self());
        
        $validatorMock
                ->shouldReceive("passes")
                ->once()
                ->andReturn(true);
        
        $validatorMock
                ->shouldReceive("errors")
                ->once()
                ->andReturn([]);
        $this->app->instance("Lpp\Services\Validation\SearchTweetFormValidation", $validatorMock);

        $tweetsReceivedFromTwitter = $this->getTweetsReceivedFromTwitter();
        $twitterMock = $this->getTwitterGatewayMock();
        $twitterMock
                ->shouldReceive("getSearch")
                ->once()
                ->andReturn($tweetsReceivedFromTwitter);
        $this->app->instance("Lpp\TwitterGateway\TwitterGatewayInterface", $twitterMock);
        
        $tweetsWithEmotion = $this->getTweetsWithEmotion();
        $tweetRepository = $this->getRepositoryMock();
        $tweetRepository
                ->shouldReceive("addAnalysis")
                ->once()
                ->andReturn($tweetsWithEmotion);
        App::instance("Lpp\Tweet\TweetRepositoryInterface", $tweetRepository);

        //Act
        
        $crawler = $this->client->request('POST', '/search', array('q' => '@re_systems'));


        //Assert
        $this->assertTrue($this->client->getResponse()->isOk());

        // Assert that there is no one div tag
        // with the class "alert-danger"
        $this->assertEquals(0, $crawler->filter('div.alert-danger')->count());
    }


     protected function getTweetsReceivedFromTwitter()
    {
        return array(0=>array(
            'created_at' => 'Thu May 08 01:01:19 +0000 2014',
            'name' => 'laravel',
            'screen_name' => 'Laravel',
            'text'=>'Looked into #laravel as a starting point for a web app... 28 Meg seems a bit much to start off with..',
            'lang' => 'en'
            )
            );
    }
    
    protected function getTweetsWithEmotion()
    {
        return array(0=>array(
            'created_at' => 'Thu May 08 01:01:19 +0000 2014',
            'name' => 'laravel',
            'screen_name' => 'Laravel',
            'text'=>'Looked into #laravel as a starting point for a web app... 28 Meg seems a bit much to start off with..',
            'lang' => 'en',
            'emotion'=>'Happy'
            )
            );
    }


    protected function getRepositoryMock()
    {
        return Mockery::mock("Lpp\Tweet\TweetRepositoryInterface");
    }

    //A passive partial mock is more of a default state of being.
    protected function getRepositoryMockPartial()
    {
        return Mockery::mock("Lpp\Tweet\TweetRepositoryInterface")
                ->makePartial();
    }
    
    protected function getValidatorMock()
    {
        
        return Mockery::mock("Lpp\Services\Validation\SearchTweetFormValidation");
    }
 
    protected function getValidatorMockPartial()
    {
         return Mockery::mock("Lpp\Services\Validation\SearchTweetFormValidation")
                        ->makePartial();
    }

    protected function getTwitterGatewayMock()
    {
        return Mockery::mock("Lpp\TwitterGateway\TwitterGatewayInterface");
    }

    protected function getTwitterGatewayMockPartial()
    {
        return Mockery::mock("Lpp\TwitterGateway\TwitterGatewayInterface")
                        ->makePartial();
    }


}
