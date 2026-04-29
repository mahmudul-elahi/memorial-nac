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
            ['name' => 'app_color',            'value' => '#fd8c99'],
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
            // Pages content
            ['name' => 'terms',               'value' => '<h3>Acceptance of Terms</h3><p>By accessing or using Nac Memorial, you agree to be bound by these Terms &amp; Conditions. Please read them carefully before using our platform.</p><h3>Acceptable Use</h3><p>You agree to use Nac Memorial only for lawful purposes and in a manner that does not infringe the rights of others. You must not post content that is offensive, defamatory, or untrue about any living or deceased individual.</p><h3>Content Ownership</h3><p>You retain ownership of the content you submit. By posting content, you grant us a non-exclusive, royalty-free license to display and distribute that content in connection with our services.</p><h3>Account Responsibilities</h3><p>You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account. Please notify us immediately of any unauthorized use.</p><h3>Limitation of Liability</h3><p>Nac Memorial shall not be liable for any indirect, incidental, or consequential damages arising from your use of the platform. We reserve the right to terminate accounts that violate these terms at our discretion.</p>'],
            ['name' => 'about',               'value' => '<h3>Who We Are</h3><p>Nac Memorial is a compassionate platform dedicated to helping families and friends create lasting tributes for beloved pets and companions. We believe that every life — no matter how small — deserves to be remembered and celebrated.</p><h3>Our Mission</h3><p>Our mission is to provide a safe, respectful space where you can create a memorial page, share memories, upload photos, and receive condolences from your community. We are committed to making the process of remembrance as simple and meaningful as possible during one of life\'s most difficult moments.</p><h3>Our Story</h3><p>Founded with love and purpose, Nac Memorial has helped thousands of pet owners across the country honor their companions with dignity. We understand the deep bond between humans and their animals, and we are here to help you celebrate that bond forever.</p><h3>Contact Us</h3><p>Have questions or need support? Reach out to us at <strong>info@memorial.com</strong> — our team is always here to help.</p>'],
            // Feature flags (1 = enabled, 0 = disabled)
            ['name' => 'new_entries',          'value' => '1'],
            ['name' => 'new_comments',         'value' => '1'],
            ['name' => 'jumbotron',            'value' => '1'],
            // Social links
            ['name' => 'facebook_url',         'value' => 'https://www.facebook.com/share/1FWDQEoH77/?mibextid=wwXIfr'],
            ['name' => 'twitter_url',          'value' => '#'],
            ['name' => 'instagram_url',        'value' => '#'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['name' => $setting['name']], ['value' => $setting['value']]);
        }
    }
}
