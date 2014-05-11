<?php namespace Lpp\TwitterGateway;

use \Thujohn\Twitter\Twitter;

class ThujohnTwitterGateway implements TwitterGatewayInterface
{

    private $thujohnTwitter;
    
    public function __construct(Twitter $thujohnTwitter)
    {
        $this->thujohnTwitter = $thujohnTwitter;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getSearch($parameters = array())
    {
        $tweets  = null;
        
        if ($this->isSearchKeyAndNotEmpty($parameters)) {
            $response = $this->thujohnTwitter->getSearch($parameters);
           // dd($response);
            if (!is_null($response)) {
                $tweets = $this->processResponse($response);
            }
        }

        return $tweets;
    }

    /**
     * Grab interested data from Twitter API Search response
     * @param object $response
     * @return array $tweets
     */
    protected function processResponse($response)
    {
        $tweets = array();
        if (!is_null($response)) {

            foreach ($response->statuses as $tweet) {
                $t['created_at'] = $tweet->created_at;
                $t['lang'] = $tweet->lang;
                $t['name'] = $tweet->user->name;
                $t['profile_image_url'] = $tweet->user->profile_image_url;
                $t['screen_name'] = $tweet->user->screen_name;
                $t['text'] = $tweet->text;

                $tweets[] = $t;
            }
        }
        return $tweets;
    }

    protected function isSearchKeyAndNotEmpty($parameters = array())
    {
        return (!empty($parameters) && isset($parameters['q']) && mb_strlen($parameters['q'])>0);
    }

}
