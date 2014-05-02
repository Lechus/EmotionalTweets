<?php

class Helpers
{

    /**
     * Get human readable emotional status of tweet
     * @param float $sent
     * @return string Status
     */
    public static function emotions($sent)
    {
        $emotion = 'unknown';
        switch ($sent):
            case -1: $emotion = 'Sad';
                break;
            case 0: $emotion = 'Indifferent';
                break;
            case 1: $emotion = 'Happy';
                break;
        endswitch;

        return $emotion;
    }

    /**
     * Get Sentiment Analysis for Tweet
     * @param string $lang
     * @param string $text
     * @return object(Unirest\HttpResponse)
     */
    public static function unirestSentimental($lang = 'en', $text = null)
    {

        if (!is_null($text)) {
            $response = Unirest::post(
                            "https://sentimentalsentimentanalysis.p.mashape.com/sentiment/current/classify_text/", array(
                        "X-Mashape-Authorization" => Config::get('packages/mashape/unirest-php/config.PRODUCTION_KEY')
                            ), array(
                        "lang" => $lang,
                        "text" => urlencode($text),
                        "exclude" => "",
                        "detectlang" => "0"
                            )
            );
            return $response;
        }
    }

    /**
     * Add value and emotion to array using unrestSentimental
     * @param array $tweets
     * @return array Tweets with emotions
     */
    public static function addUnirestSentimentalStatus($tweets)
    {
        $emotionalTweets = array();

        if (!is_null($tweets)) {
            foreach ($tweets as $tweet) {
                
                $sentimental = self::unirestSentimental($tweet['lang'], $tweet['text']);

                if ( !(isset($sentimental->body->error) && is_object($sentimental->body->error)) ) {
                    $tweet['value'] = $sentimental->body->value;
                    $tweet['emotion'] = self::emotions($sentimental->body->sent);
                }
                $emotionalTweets[] = $tweet;
            }
        }

        return $emotionalTweets;
    }

}
