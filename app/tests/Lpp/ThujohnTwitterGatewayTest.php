<?php

use Lpp\TwitterGateway\ThujohnTwitterGateway;

class ThujohnTwitterGatewayTest extends TestCase
{

    /**
     * @covers Lpp\TwitterGateway\ThujohnTwitterGateway::getSearch
     */
    public function testGetSearchReturnArrayOfTweets()
    {
        //Arrange
        $search = '@re_systems';
        $parameters = array('q' => $search, 'count' => 1, 'result_type' => 'recent');
        $twitter = $this->getTwitterExpecting('search/tweets', $parameters);

        $twitterGateway = new ThujohnTwitterGateway($twitter);

        //Act
        $emotion = $twitterGateway->getSearch($parameters);

        //Assert
        $this->assertEquals($this->getProcessedTweetToCompare(), $emotion, 'They should be the same'); 
    }

   /**
    * Return custom Thujohn/Twitter response object
    * @return object
    */
    protected function getTweetsReceivedFromTwitter()
    {
        $response = new stdClass();
        $statuses = array();
        $tweet = new stdClass();
        $user = new stdClass();
        $tweet->created_at = "Thu May 08 01:01:19 +0000 2014";
        $tweet->lang = "en";
        $tweet->text = 'Looked into #laravel as a starting point for a web app... 28 Meg seems a bit much to start off with..';
        $user->name = 'laravel';
        $user->profile_image_url = "http://pbs.twimg.com/profile_images/936856979/GetAttachment.aspx_normal.jpg";
        $user->screen_name = 'Laravel';

        $tweet->user = $user;
        $statuses[] = $tweet;

        $response->statuses = $statuses;

        return $response;
    }

   /**
    * Return processed Tweets
    * @return array
    */    
    protected function getProcessedTweetToCompare()
    {
        return array(0 => array(
                'created_at' => 'Thu May 08 01:01:19 +0000 2014',
                'name' => 'laravel',
                'screen_name' => 'Laravel',
                'profile_image_url' => 'http://pbs.twimg.com/profile_images/936856979/GetAttachment.aspx_normal.jpg',
                'text' => 'Looked into #laravel as a starting point for a web app... 28 Meg seems a bit much to start off with..',
                'lang' => 'en'
            )
        );
    }
    
    
    /**
     * Mocking ThujohnTwitter from package
     * @return Mock
     */
    protected function getTwitter()
    {
        return $this->getMockBuilder('Thujohn\Twitter\Twitter')
                        ->setMethods(array('getSearch'))
                        ->disableOriginalConstructor()
                        ->getMock();
    }

    protected function getTwitterExpecting($endpoint, array $queryParams)
    {
        $twitter = $this->getTwitter();
        $twitter->expects($this->once())
                ->method('getSearch')
                ->with(
                        $queryParams
                )->will($this->returnValue($this->getTweetsReceivedFromTwitter()))
        ;
        return $twitter;
    }

}
