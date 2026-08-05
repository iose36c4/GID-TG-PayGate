<?php

namespace App\Http\Controllers;

use App\Helpers\Installation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class InstallController extends Controller
{
    public function requirements()
    {
        if (Installation::isInstalled()) {
            return redirect()->route('home');
        }

        $checks = [
            'PHP >= 8.2' => version_compare(PHP_VERSION, '8.2.0', '>='),
            'Extensión OpenSSL' => extension_loaded('openssl'),
            'Extensión PDO' => extension_loaded('pdo'),
            'Extensión Mbstring' => extension_loaded('mbstring'),
            'Extensión CURL' => extension_loaded('curl'),
            'Extensión GD' => extension_loaded('gd'),
            'Extensión ZIP' => extension_loaded('zip'),
            'Extensión XML' => extension_loaded('xml'),
            'Escritura en storage/' => is_writable(storage_path()),
            'Escritura en bootstrap/cache/' => is_writable(base_path('bootstrap/cache')),
            'Archivo .env existe' => File::exists(base_path('.env')),
        ];

        return view('install.requirements', compact('checks'));
    }

    public function database(Request $request)
    {
        if (Installation::isInstalled()) {
            return redirect()->route('home');
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'db_connection' => 'required|in:sqlite,mysql,pgsql',
                'db_host' => 'required_if:db_connection,mysql,pgsql',
                'db_port' => 'required_if:db_connection,mysql,pgsql|integer',
                'db_database' => 'required',
                'db_username' => 'required_if:db_connection,mysql,pgsql',
                'db_password' => 'nullable',
            ]);

            $this->updateEnv($request->all());

            return redirect()->route('install.migrate');
        }

        return view('install.database');
    }

    public function migrate(Request $request)
    {
        if (Installation::isInstalled()) {
            return redirect()->route('home');
        }

        $output = [];
        $exitCode = 0;

        if ($request->isMethod('post')) {
            try {
                Artisan::call('migrate', ['--force' => true]);
                $output = explode("\n", Artisan::output());
            } catch (\Exception $e) {
                $output = ['Error: '.$e->getMessage()];
                $exitCode = 1;
            }

            if ($exitCode === 0) {
                return redirect()->route('install.admin');
            }
        }

        return view('install.migrate', compact('output', 'exitCode'));
    }

    public function admin(Request $request)
    {
        if (Installation::isInstalled()) {
            return redirect()->route('home');
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => 'admin',
                'is_active' => true,
            ]);

            $user->assignRole('admin');

            Installation::markAsInstalled();

            return redirect()->route('install.complete');
        }

        return view('install.admin');
    }

    public function complete()
    {
        if (! Installation::isInstalled()) {
            return redirect()->route('install.requirements');
        }

        return view('install.complete');
    }

    protected function updateEnv(array $data): void
    {
        $envPath = base_path('.env');
        $env = File::get($envPath);

        $replacements = [
            'DB_CONNECTION' => $data['db_connection'],
            'DB_HOST' => $data['db_host'] ?? '',
            'DB_PORT' => $data['db_port'] ?? '',
            'DB_DATABASE' => $data['db_database'],
            'DB_USERNAME' => $data['db_username'] ?? '',
            'DB_PASSWORD' => $data['db_password'] ?? '',
        ];

        foreach ($replacements as $key => $value) {
            $pattern = "/^{$key}=.*/m";
            if (preg_match($pattern, $env)) {
                $env = preg_replace($pattern, "{$key}={$value}", $env);
            } else {
                $env .= "\n{$key}={$value}";
            }
        }

        File::put($envPath, $env);
    }
}
