<?php namespace Lpp\Tweet;

interface TweetRepositoryInterface
{
    /**
     * Process array of Tweets and add emotion status to Tweet using AnalyseInterface
     * @param array $tweets
     * @return array Tweets with emotions
     */
    public function addAnalysis(array $tweets);
    
}
