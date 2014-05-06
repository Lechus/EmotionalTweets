<?php namespace Lpp\Providers;

class TweetRepositoryServiceProvider extends \Illuminate\Support\ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Lpp\Tweet\TweetRepositoryInterface', 'Lpp\Tweet\TweetRepository');
    }

}
