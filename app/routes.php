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
    
    //Returns a collection of the most recent Tweets by search terms or hash tags
    $response = Twitter::getSearch(array('q' => $search, 'count' => 2, 'result_type'=>'recent'));

    //Get array with custom tweet attributes
    $receivedTweets = Tweet::processResponse($response);
       
    //add sentimental status to tweets
    $tweets = Helpers::addUnirestSentimentalStatus($receivedTweets);
    
    return View::make('searchtweets', array('tweets' => $tweets, 'q' => $search));
});
