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
    //Returns a collection of the most recent Tweets by search terms or hash tags
    $search = Input::get('q'); 
    $tweets =Twitter::getSearch(array('q' => $search, 'count' => 5, 'result_type'=>'recent'));
    return View::make('searchtweets', array('tweets' => $tweets, 'q' => $search));
});

Route::get('/screen_name', function()
{
    
    $search = ''; 
    $tweets = null;
    return View::make('tweets', array('tweets' => $tweets, 'screen_name' => $search));
});

Route::post('/screen_name', function()
{
    //Returns a collection of the most recent Tweets posted by the user indicated by the screen_name or user_id parameters.
    $search = Input::get('screen_name'); 
    $tweets = Twitter::getUserTimeline(array('screen_name' => $search, 'count' => 5));
    return View::make('tweets', array('tweets' => $tweets, 'screen_name' => $search));
});