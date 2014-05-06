<?php namespace Lpp\Tweet;

use Lpp\Analysis\AnalysisInterface;

class TweetRepository implements TweetRepositoryInterface
{
    
    /**
     * {@inheritdoc}
     */
    public function addAnalysis(array $tweets, AnalysisInterface $analyser)
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
