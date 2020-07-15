<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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

     /***/
    //Untuk menghilangkan error : Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes (SQL: alter table users add unique users_email_unique(email))
    //Saat Migrasi Users
     /**/
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
