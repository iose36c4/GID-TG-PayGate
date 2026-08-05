<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view channels', 'view channel detail', 'purchase channel',
            'view own subscriptions', 'manage own profile', 'create tickets',
            'manage own channels', 'view own analytics', 'manage own payouts',
            'manage own api tokens', 'manage own team', 'configure webhooks',
            'view all users', 'view all channels', 'manage tickets',
            'assign tickets', 'view reports', 'manage knowledge base',
            'impersonate users', 'suspend channels', 'extend subscriptions',
            'manage staff', 'manage global settings', 'manage feature flags',
            'view security logs', 'manage backups', 'access telescope',
            'manage fees', 'manage limits', 'view all transactions',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        $roles = [
            'user' => ['view channels', 'view channel detail', 'purchase channel', 'view own subscriptions', 'manage own profile', 'create tickets'],
            'creador' => ['view channels', 'view channel detail', 'purchase channel', 'view own subscriptions', 'manage own profile', 'create tickets', 'manage own channels', 'view own analytics', 'manage own payouts', 'manage own api tokens', 'manage own team', 'configure webhooks'],
            'staff' => ['view all users', 'view all channels', 'manage tickets', 'assign tickets', 'view reports', 'manage knowledge base', 'impersonate users', 'suspend channels', 'extend subscriptions'],
            'admin' => ['manage staff', 'manage global settings', 'manage feature flags', 'view security logs', 'manage backups', 'access telescope', 'manage fees', 'manage limits', 'view all transactions'],
        ];

        foreach ($roles as $roleName => $perms) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
            $role->syncPermissions($perms);
        }
    }
}
