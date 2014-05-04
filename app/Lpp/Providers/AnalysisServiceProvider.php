<?php namespace Lpp\Providers;


class AnalysisServiceProvider extends \Illuminate\Support\ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Lpp\Analysis\AnalyseInterface', 'Lpp\Analysis\UnirestAnalysis');
    }

}
