<?php namespace Lpp\Providers;

class TwitterGatewayServiceProvider extends \Illuminate\Support\ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Lpp\TwitterGateway\TwitterGatewayInterface', 'Lpp\TwitterGateway\ThujohnTwitterGateway');
    }

}
