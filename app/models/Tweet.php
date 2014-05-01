<?php

class Tweet
{

    /**
     * Grab interested data from Twitter API Search response
     * @param object $response
     * @return array $tweets
     */
    public static function processResponse($response)
    {
        $tweets = array();
        if (!is_null($response)) {

            foreach ($response->statuses as $tweet) {
                $t['created_at'] = $tweet->created_at;
                $t['lang'] = $tweet->lang;
                $t['name'] = $tweet->user->name;
                $t['screen_name'] = $tweet->user->screen_name;
                $t['text'] = $tweet->text;
                $tweets[] = $t;
            }
        }
        return $tweets;
    }

}
