<?php

namespace App\Domains\Public\Providers;

use Illuminate\Support\ServiceProvider;

class PublicServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../Views', 'public');
        $this->loadMigrationsFrom(__DIR__.'/../Migrations');
    }
}
