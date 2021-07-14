<?php

namespace Paycoin\Paycoins;

use Illuminate\Support\ServiceProvider;

class PaycoinsServiceProvider extends ServiceProvider
{
    
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
          __DIR__.'/../config/paycoinConfig.php' => config_path('paycoinConfig.php')
        ]);
    }
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
     $this->app->singleton(Paycoins::class, function($app){
       return new Paycoins();
     });
    }
     /**
    * Get the services provided by the provider
    *
    * @return array
    */
}
