<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Carbon\Carbon::setLocale(\App::getLocale());

        Validator::extend('protected_names', function($attribute, $value, $parameters, $validator) {
            return !in_array(mb_strtolower($value), $parameters);
        });

        Validator::extend('password_equal', function($attribute, $value, $parameters, $validator) {
            return \Hash::check($value, \Auth::user()->password);
        });
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
