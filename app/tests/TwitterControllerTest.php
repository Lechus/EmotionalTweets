<?php

class TwitterControllerTest extends TestCase
{

    public function testConstructor()
    {
        $validatorMock       = $this->getValidatorMockPartial();
        $twitterGatewayMock  = $this->getTwitterGatewayMockPartial();
        $tweetRepositoryMock = $this->getRepositoryMockPartial();

        $twitterController = new TwitterController(
                $validatorMock, $twitterGatewayMock, $tweetRepositoryMock
        );
    }

    
    /**
     * @covers TwitterController::showSearchForm
     */
    public function testShowSearchForm()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertTrue($this->client->getResponse()->isOk());

        $this->assertCount(1, $crawler->filter('h1:contains("Search for tweets:")'));
    }

    /**
     * Validation input required
     * @covers TwitterController::searchTweets
     */
 
    public function testSearchTweetsWithoutInput()
    {
        //Arrange
        $crawler = $this->client->request('POST', '/search');

        //Act
        $this->assertTrue($this->client->getResponse()->isOk());

        // Assert that there is at least one div tag
        // with the class "alert-danger"
        $this->assertGreaterThan(0, $crawler->filter('div.alert-danger')->count());
    }

    /**
     * Validation input max 1000 chars length
     * @covers TwitterController::searchTweets
     */
    
    public function testSearchTweetsWithBadInput()
    {
        //Arrange
        $tooLongInput = $this->getTooLongInput();

        //Act
        $crawler = $this->client->request('POST', '/search', array('q' => $tooLongInput));

        //Assert
        $this->assertTrue($this->client->getResponse()->isOk());

        // Assert that there is at least one div tag
        // with the class "alert-danger"
        $this->assertGreaterThan(0, $crawler->filter('div.alert-danger')->count());
    }

    /**
     * @covers TwitterController::searchTweets
     */
    public function testSearchTweetsWithInput()
    {
        //Arrange
        $search = '#laravel';
        $validatorMock = $this->getValidatorMock();
        $this->app->instance("Lpp\Services\Validation\SearchTweetFormValidation", $validatorMock);
        $validatorMock
                ->shouldReceive("with")
                ->once()
                ->with(array('q'=>$search))
                ->andReturn(Mockery::self());
        
        $validatorMock
                ->shouldReceive("passes")
                ->once()
                ->andReturn(false);
        
        $twitterMock = $this->getTwitterGatewayMockPartial();
        $twitterMock
                ->shouldReceive("getSearch")
                ->once()
                ->with(array('q' => $search, 'count' => 5, 'result_type' => 'recent'))
                ->andReturn('Happy');

        $tweetRepository = $this->getRepositoryMock();
        $tweetRepository
                ->shouldReceive("addAnalysis")
                ->once()
                ->with(array('lang' => 'en', 'text'=>'Looked into #laravel as a starting point for a web app...'
                        . '  28 Meg seems a bit much to start off with..'))
                ->andReturn(array('lang' => 'en', 'text'=>'Looked into #laravel as a starting point for a web app...'
                        . '  28 Meg seems a bit much to start off with..', 'emotion'=>'Happy'));

        //Act
        
        $crawler = $this->client->request('POST', '/search', array('q' => '@re_systems'));


        //Assert
        $this->assertTrue($this->client->getResponse()->isOk());

        // Assert that there is no one div tag
        // with the class "alert-danger"
        $this->assertEquals(0, $crawler->filter('div.alert-danger')->count());
    }

    
    /**
     * Too long string for search query (longer than 1000 characters)
     * @return string
     */
    protected function getTooLongInput()
    {
        return "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do"
                . " eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim"
                . " ad minim veniam, quis nostrud exercitation ullamco laboris"
                . " nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor"
                . " in reprehenderit in voluptate velit esse cillum dolore eu fugiat"
                . " nulla pariatur. Excepteur sint occaecat cupidatat non proident,"
                . " sunt in culpa qui officia deserunt mollit anim id est laborum."
                . "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do"
                . " eiusmod tempor incididunt ut labore et dolore magna aliqua. "
                . "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris"
                . " nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor"
                . " in reprehenderit in voluptate velit esse cillum dolore eu fugiat"
                . " nulla pariatur. Excepteur sint occaecat cupidatat non proident,"
                . " sunt in culpa qui officia deserunt mollit anim id est laborum."
                . "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do"
                . " eiusmod tempor incididunt ut labore et dolore magna aliqua.";
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
