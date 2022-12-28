<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    public function run()
    {
        $positions = ['Web Designer', 'Web Developer', 'Support Team'];

        foreach ($positions as $item) {
            Position::create(['name' => $item, 'status' => 1]);
        }
    }
}
