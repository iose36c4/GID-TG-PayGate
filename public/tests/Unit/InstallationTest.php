<?php

namespace Tests\Unit;

use App\Helpers\Installation;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class InstallationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    public function test_is_installed_returns_true_in_testing_environment()
    {
        $this->assertTrue(Installation::isInstalled());
    }

    public function test_mark_as_installed_creates_file()
    {
        if (File::exists(storage_path('installed'))) {
            File::delete(storage_path('installed'));
        }

        Installation::markAsInstalled();

        $this->assertTrue(File::exists(storage_path('installed')));
    }
}
