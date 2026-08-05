<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class Installation
{
    public static function isInstalled(): bool
    {
        if (App::environment('testing')) {
            return true;
        }

        return Cache::remember('installation.status', 3600, function () {
            if (! File::exists(storage_path('installed'))) {
                return false;
            }

            $env = File::get(base_path('.env'));
            if (! preg_match('/^APP_KEY=.+/m', $env)) {
                return false;
            }
            if (! preg_match('/^DB_DATABASE=.+/m', $env)) {
                return false;
            }
            if (! preg_match('/^DB_USERNAME=.+/m', $env)) {
                return false;
            }

            try {
                if (! Schema::hasTable('migrations')) {
                    return false;
                }
                if (DB::table('migrations')->count() === 0) {
                    return false;
                }
            } catch (\Exception) {
                return false;
            }

            return true;
        });
    }

    public static function markAsInstalled(): void
    {
        File::put(storage_path('installed'), date('Y-m-d H:i:s'));
        Cache::forget('installation.status');
    }
}
