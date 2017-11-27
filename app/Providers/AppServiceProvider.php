<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $url->forceSchema( getenv( 'APP_SCHEMA' ) );
        \URL::forceScheme( getenv( 'APP_SCHEMA' ) );

        // if ( getenv( "APP_ENV" ) ) !== 'local' ) {
        //     $url->forceSchema('https');
        // }
        // \URL::forceScheme('https');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
