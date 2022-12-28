<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = new User;
        $user->name     = 'Orkhan Shukurlu';
        $user->email    = 'orkhandev@gmail.com';
        $user->password = '12345';
        $user->role_id  = 1;
        $user->save();
        $user->assignRole(1);
    }
}
