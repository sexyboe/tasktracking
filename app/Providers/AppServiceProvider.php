<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*   Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            // Custom validation logic to check the phone number format
            return preg_match('/^\d{10}$/', $value);
        }); */
        Schema::defaultStringLength(191);
    }
}
