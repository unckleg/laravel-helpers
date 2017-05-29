<?php

/**
 * This file is part of the Laravel Helpers package.
 *
 * @author  Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 * @license MIT License https://mit-license.org
 *
 */
namespace Unckleg\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Unckleg\Helpers\Factory\Factory;

class HelpersServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Config/helpers.php' => config_path('helpers.php'),
        ], 'config');

        // If config is not published load it manually
        if (config('helpers') === null) {
            Config::set('helpers', include (__DIR__ . '/Config/helpers.php'));
        }

        // Resolve factory view/action helpers if they are enabled through config
        Factory::resolve();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([]);
    }
}