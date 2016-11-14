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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Gate::define('admin', function ($user) {
            return ($user->roles->first()->name === 'admin');
        });

        Gate::define('team-member', function ($user, $team) {
            return ($user->teams->find($team->id));
        });
    }
}
