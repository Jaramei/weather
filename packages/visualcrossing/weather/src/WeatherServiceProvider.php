<?php

namespace Visualcrossing\Weather;

use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider
{

    /** Register Bootstrap
     *
     * @return void
     *
     */

    public function boot()
    {
        if (function_exists('config_path')) {
            $this->publishes([__DIR__ . '/config/weather.php' => config_path('WeatherCommand.php')]);
        }
    }

    /** Register Services
     *
     * @return void
     *
     */

    public function register() : void
    {
        $this->app->bind(RequestInterface::class, Client::class);
    }


}
