<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = ['Photograph', 'UI & UX'];

        foreach ($categories as $item) {
            Category::create(['name' => $item, 'status' => 1]);
        }
    }
}
