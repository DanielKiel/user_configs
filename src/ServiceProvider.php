<?php
/**
 * Created by PhpStorm.
 * User: dk
 * Date: 26.07.18
 * Time: 11:25
 */

namespace Dion\UserConfig;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        //register macros
        foreach (glob(__DIR__ . "/helper/*.php") as $filename) {
            require $filename;
        }

        //run php artisan vendor:publish  --tag=migrations, so later you can run php artisan:migrate to do your migration
        $this->publishes([
            __DIR__.'/database/migrations/' => $this->app->databasePath().'/migrations',
        ], 'migrations');
    }

    public function register()
    {

    }
}