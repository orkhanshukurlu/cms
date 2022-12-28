<?php

namespace Database\Seeders;

use App\Models\Social;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    public function run()
    {
        $socials = [
            [
                'name' => 'Instagram',
                'link' => 'https://www.instagram.com/thanks.az'
            ]
        ];

        foreach ($socials as $item) {
            Social::create([
                'name'   => $item['name'],
                'link'   => $item['link'],
                'status' => 1
            ]);
        }
    }
}
