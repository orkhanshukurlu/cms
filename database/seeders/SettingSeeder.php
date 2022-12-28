<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'keyword' => 'visual_communication',
                'content' => '<span>For Visual</span> <span>Communication</span>'
            ],
            [
                'keyword' => 'lets_work_together',
                'content' => 'Let\'s work together'
            ],
            [
                'keyword' => 'about_us',
                'content' => 'About Us'
            ],
            [
                'keyword' => 'contact_us',
                'content' => 'Contact Us'
            ],
            [
                'keyword' => 'email',
                'content' => 'contact@thanks.az'
            ],
            [
                'keyword' => 'address',
                'content' => 'Baku, Azerbaijan'
            ],
            [
                'keyword' => 'phone',
                'content' => '994 (00) 000-00-00'
            ],
            [
                'keyword' => 'selected_works',
                'content' => 'Selected Works'
            ],
            [
                'keyword' => 'creative_studio',
                'content' => 'Creative Studio'
            ],
            [
                'keyword' => 'get_in_touch',
                'content' => 'Get in Touch'
            ],
            [
                'keyword' => 'hello_stranger',
                'content' => 'Hello Stranger'
            ],
            [
                'keyword' => 'team_members',
                'content' => 'Team Members'
            ],
            [
                'keyword' => 'creative_profiles',
                'content' => 'Creative Profiles'
            ],
            [
                'keyword' => 'join_our_team',
                'content' => 'Join Our Team'
            ],
            [
                'keyword' => 'our_clients',
                'content' => 'Our Clients'
            ],
            [
                'keyword' => 'scroll_down',
                'content' => 'Scroll Down'
            ],
            [
                'keyword' => 'see_all_works',
                'content' => 'See All Works'
            ],
            [
                'keyword' => 'home_description',
                'content' => 'We are trusted by over 28,000 clients across the world to power stunning websites.'
            ],
            [
                'keyword' => 'about_description_1',
                'content' => 'We cover a large range of creative digital projects, platforms and campaigns to create experiences.'
            ],
            [
                'keyword' => 'about_description_2',
                'content' => 'We build beautiful Portfolio WordPress Themes designed to make your works stand out online. Our design philosophy hinges on simplicity. We focus on clean lines, bold typhography and white space to create an aesthetic that’s both modern and timeless.'
            ],
            [
                'keyword' => 'about_description_3',
                'content' => 'We develop gorgeous, memorable projects for our customers.'
            ],
            [
                'keyword' => 'contact_description',
                'content' => 'Let\'s work together and make something that matters.'
            ]
        ];

        foreach ($settings as $item) {
            Setting::create(['keyword' => $item['keyword'], 'content' => $item['content']]);
        }
    }
}
