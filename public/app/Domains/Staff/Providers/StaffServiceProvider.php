<?php

namespace App\Domains\Staff\Providers;

use Illuminate\Support\ServiceProvider;

class StaffServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../Views', 'staff');
        $this->loadMigrationsFrom(__DIR__.'/../Migrations');
    }
}
