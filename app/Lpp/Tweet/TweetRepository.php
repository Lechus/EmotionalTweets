<?php namespace Lpp\Tweet;

use Lpp\Analysis\AnalysisInterface;

class TweetRepository implements TweetRepositoryInterface
{
    /**
     * Analysis interface
     *
     * @var \Lpp\Analysis\AnalysisInterface
     */
    private $analyser;

    public function __construct(AnalysisInterface $analyser)
    {
        $this->analyser = $analyser;
    }

    /**
     * {@inheritdoc}
     */
    public function addAnalysis(array $tweets)
    {
        $emotionalTweets = array();

        if (!is_null($tweets)) {
            foreach ($tweets as $tweet) {
                $tweet['emotion'] = $this->analyser->analyse($tweet['text'], $tweet['lang']);
                $emotionalTweets[] = $tweet;
            }
        }

        return $emotionalTweets;
    }

}
