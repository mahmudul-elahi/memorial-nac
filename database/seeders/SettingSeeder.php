<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            // General
            ['name' => 'app_name',             'value' => 'Memorial'],
            ['name' => 'app_description',      'value' => 'A compassionate platform to honor and remember loved ones.'],
            ['name' => 'app_tagline',          'value' => 'Honoring Lives, Preserving Memories'],
            ['name' => 'app_logo',             'value' => 'default_logo.png'],
            ['name' => 'dir',                  'value' => 'ltr'],
            ['name' => 'app_email',            'value' => 'info@memorial.com'],
            ['name' => 'app_phone',            'value' => '+1 800 555 0199'],
            ['name' => 'app_address',          'value' => '123 Remembrance Avenue, New York, NY 10001'],
            // Pagination / limits
            ['name' => 'num_of_results',       'value' => '10'],
            ['name' => 'num_comments_at_time', 'value' => '5'],
            // Feature flags (1 = enabled, 0 = disabled)
            ['name' => 'new_entries',          'value' => '1'],
            ['name' => 'new_comments',         'value' => '1'],
            ['name' => 'jumbotron',            'value' => '1'],
            // Social links
            ['name' => 'facebook_url',         'value' => '#'],
            ['name' => 'twitter_url',          'value' => '#'],
            ['name' => 'instagram_url',        'value' => '#'],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(['name' => $setting['name']], ['value' => $setting['value']]);
        }
    }
}
