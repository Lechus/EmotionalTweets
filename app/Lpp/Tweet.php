<?php namespace Lpp;

class Tweet
{
    
    /**
     * Process array of Tweets and add emotion status to Tweet using AnalyseInterface
     * @param array $tweets
     * @return array Tweets with emotions
     */
    public function analyse($tweets, \Lpp\Analysis\AnalysisInterface $analyser)
    {
        $emotionalTweets = array();

        if (!is_null($tweets)) {
            foreach ($tweets as $tweet) {

                $tweet['emotion'] = $analyser->analyse($tweet['text'], $tweet['lang']);

                $emotionalTweets[] = $tweet;
            }
        }

        return $emotionalTweets;
    }
    
}
