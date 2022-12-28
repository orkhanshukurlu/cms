<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'brands-index',
            'brands-create',
            'brands-edit',
            'brands-destroy',
            'categories-index',
            'categories-create',
            'categories-edit',
            'categories-destroy',
            'members-index',
            'members-create',
            'members-edit',
            'members-destroy',
            'portfolio-index',
            'portfolio-create',
            'portfolio-show',
            'portfolio-edit',
            'portfolio-destroy',
            'positions-index',
            'positions-create',
            'positions-edit',
            'positions-destroy',
            'roles-index',
            'roles-create',
            'roles-show',
            'roles-edit',
            'roles-destroy',
            'settings-index',
            'settings-create',
            'settings-show',
            'settings-edit',
            'settings-destroy',
            'socials-index',
            'socials-create',
            'socials-edit',
            'socials-destroy',
            'users-index',
            'users-create',
            'users-edit',
            'users-destroy'
        ];

        foreach ($permissions as $item) {
            Permission::create(['name' => $item, 'guard_name' => 'web']);
        }
    }
}
