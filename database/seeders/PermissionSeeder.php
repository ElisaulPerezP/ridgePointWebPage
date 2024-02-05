<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    protected const PERMISSIONS_WEB = [
        'index.user',
        'edit.user',
        'show.user',
        'update.user',
        'changeStatus.user',
        'edit.profile',
        'update.profile',
        'destroy.profile',
        'edit.users.permissions',
        'create.pendingMatter',
        'store.pendingMatter',
        'edit.pendingMatter',
        'update.pendingMatter',
        'destroy.pendingMatter',
        'delete.pendingMatter',
        'edit.users.permissions',
        'create.carousel',
        'store.carousel',
        'edit.carousel',
        'update.carousel',
        'destroy.carousel',
        'delete.carousel',
        'permisions',
        'roles',
    ];

   

    protected const ROLES = [
        'admin',
        'worker',
        'user',
    ];
    public function run(): void
    {
        foreach (self::PERMISSIONS_WEB as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        foreach (self::ROLES as $role) {
            Role::findOrCreate($role, 'web');
        }

        $roleAdminWeb = Role::findByName('admin', 'web');
        $roleAdminWeb->syncPermissions(Permission::whereIn('guard_name', ['web'])->get()->pluck('name')->toArray());
    
    }
}
