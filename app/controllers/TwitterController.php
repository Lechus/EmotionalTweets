<?php

use Lpp\Tweet\TweetRepositoryInterface;
use Lpp\TwitterGateway\TwitterGatewayInterface;
use Lpp\Services\Validation\SearchTweetFormValidation;

class TwitterController extends BaseController
{

    /**
     * @var \Lpp\Services\Validation
     */
    protected $validator;

    /**
     * @var \Lpp\TwitterGateway\
     */
    protected $twitterGateway;

    /**
     * @var \Lpp\Tweet
     */
    protected $tweetRepository;

    public function __construct(
            SearchTweetFormValidation $validator, 
            TwitterGatewayInterface $twitterGateway, 
            TweetRepositoryInterface $tweetRepository
    )
    {
        $this->validator = $validator;
        $this->twitterGateway = $twitterGateway;
        $this->tweetRepository = $tweetRepository;
    }

    /**
     * Display a search form and listing of founded and anlysed tweets.
     *
     * @return Response
     */
    public function searchTweets()
    {
        $tweets = null;
        $search = Input::get('q');

        if ($this->validator->with(Input::all())->passes()) {

            //Returns a array collection of the most recent Tweets by search terms or hash tags
            $receivedTweets = $this->twitterGateway->getSearch(array('q' => $search, 'count' => 3, 'result_type' => 'recent'));

            if (!empty($receivedTweets)) {                
                //add sentimental status to tweets using Anylsis provider
                $tweets = $this->tweetRepository->addAnalysis($receivedTweets);
            }
        }

        return View::make('searchtweets', array('tweets' => $tweets, 'q' => $search))->withErrors($this->validator->errors());
    }

    /**
     * Display a search form.
     *
     * @return Response
     */
    public function showSearchForm()
    {
        //Returns a collection of the most recent Tweets by search terms or hash tags
        $search = '';
        $tweets = null;
        return View::make('searchtweets', array('tweets' => $tweets, 'q' => $search));
    }

}
