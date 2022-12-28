<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $role = Role::create(['name' => 'Developer', 'guard_name' => 'web']);
        $role->givePermissionTo(Permission::all()->modelKeys());
    }
}
