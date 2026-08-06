<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

uses(RefreshDatabase::class);

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

        // Run migrations explicitly for this test
        Artisan::call('migrate', ['--force' => true]);
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
