<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use App\Models\AnggotaAcaraRegistrasi;

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
        Paginator::useBootstrap();

        Validator::extend('not_registered_for_event', function ($attribute, $value, $parameters, $validator) {
            // Check if the user is already registered for the selected event
            $user_id = auth()->id();
            return !AnggotaAcaraRegistrasi::where('user_id', $user_id)->where('acara_id', $value)->exists();
        });

        Validator::replacer('not_registered_for_event', function ($message, $attribute, $rule, $parameters) {
            return "Anda sudah terdaftar event ini";
        });
    }
}
