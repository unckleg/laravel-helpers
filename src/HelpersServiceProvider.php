<?php

/**
 * This file is part of the Laravel Helpers package.
 *
 * @license MIT License https://mit-license.org
 * @author  Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 *
 */
namespace Unckleg\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Unckleg\Helpers\Factory\HelpersResolver;

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

        // Resolve view and action helpers if they are enabled through config
        HelpersResolver::resolve();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([

        ]);
    }
}