<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('GuzzleHttp\Client', function(){
            $client = new Client();
            return $client->request('GET', 'https://api.github.com/user',[
                'auth' => ['805128256', 'ZHXzhx122067']
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
