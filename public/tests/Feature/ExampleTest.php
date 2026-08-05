<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Mark as installed for tests
        File::put(storage_path('installed'), 'test');
        Cache::forget('installation.status');

        // Ensure APP_KEY is set
        $env = File::get(base_path('.env'));
        if (! preg_match('/^APP_KEY=.+/m', $env)) {
            Artisan::call('key:generate', ['--force' => true]);
            // Reload env
            $this->refreshApplication();
        }

        // Ensure DB_DATABASE is set for SQLite
        $env = File::get(base_path('.env'));
        if (! preg_match('/^DB_DATABASE=.+/m', $env)) {
            $env = preg_replace('/^DB_DATABASE=.*/m', 'DB_DATABASE='.base_path('database/database.sqlite'), $env);
            File::put(base_path('.env'), $env);
        }

        // Ensure DB_USERNAME is set (required by check)
        $env = File::get(base_path('.env'));
        if (! preg_match('/^DB_USERNAME=.+/m', $env)) {
            $env = preg_replace('/^DB_USERNAME=.*/m', 'DB_USERNAME=sqlite', $env);
            File::put(base_path('.env'), $env);
        }
    }

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
