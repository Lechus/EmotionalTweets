<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/', function()
{
    //Returns a collection of the most recent Tweets by search terms or hash tags
    $search = '';
    $tweets = null;
    return View::make('searchtweets', array('tweets' => $tweets, 'q' => $search));
});

Route::post('/', function()
{
    $search = Input::get('q');
    
    $twitterGateway = App::make('Lpp\TwitterGateway\TwitterGatewayInterface');
    
    //Returns a array collection of the most recent Tweets by search terms or hash tags
    $receivedTweets = $twitterGateway->getSearch(array('q' => $search, 'count' => 2, 'result_type'=>'recent'));
      
    //add sentimental status to tweets using Anylsis provider
    $analyser = App::make('Lpp\Analysis\AnalyseInterface');
    
    $tweetModel = new \Lpp\Tweet();
    $tweets = $tweetModel->analyse($receivedTweets, $analyser);
    
    return View::make('searchtweets', array('tweets' => $tweets, 'q' => $search));
});
