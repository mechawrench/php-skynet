<?php

namespace Mechawrench\PhpSkynet;

use Illuminate\Support\ServiceProvider;

class PhpSkynetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/php-skynet.php' => config_path('php-skynet.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/php-skynet'),
            ], 'views');
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'php-skynet');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/php-skynet.php', 'php-skynet');
    }
}
