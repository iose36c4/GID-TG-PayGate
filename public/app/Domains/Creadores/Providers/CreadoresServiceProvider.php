<?php

namespace App\Domains\Creadores\Providers;

use Illuminate\Support\ServiceProvider;

class CreadoresServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../Views', 'creadores');
        $this->loadMigrationsFrom(__DIR__.'/../Migrations');
    }
}
