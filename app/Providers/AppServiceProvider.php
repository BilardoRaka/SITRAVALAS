<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Account;
use Illuminate\Support\Facades\Gate;

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

        Gate::define('isAdmin', function(Account $account) {
            return $account->role === 'admin';
        });

        Gate::define('isCabang', function(Account $account) {
            return $account->role === 'cabang';
        });

        Gate::define('isPimpinan', function(Account $account) {
            return $account->role === 'pimpinan';
        });
    }
}
