<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run()
    {
        $pages = [
            [
                'title'       => 'Privacy Policy',
                'slug'        => 'privacy-policy',
                'description' => 'How we collect, use, and protect your personal information.',
                'content'     => '<p>Your privacy is important to us. This Privacy Policy explains how Memorial collects, uses, discloses, and safeguards your information when you visit our website.</p><h3>Information We Collect</h3><p>We may collect personal information such as your name, email address, and profile data when you register for an account. We also collect content you voluntarily submit, including memorial pages, photos, and comments.</p><h3>How We Use Your Information</h3><p>We use your information to operate and improve our platform, communicate with you about your account, and provide a personalized experience. We do not sell your personal information to third parties.</p><h3>Data Security</h3><p>We implement industry-standard security measures to protect your data. However, no method of transmission over the internet is 100% secure, and we cannot guarantee absolute security.</p><p>If you have any questions about this policy, please contact us at privacy@memorial.com.</p>',
                'status'      => 1,
            ],
            [
                'title'       => 'How It Works',
                'slug'        => 'how-it-works',
                'description' => 'A simple guide to creating and sharing memorial pages on our platform.',
                'content'     => '<p>Creating a memorial page on our platform is simple and free. Follow these steps to honor your loved one in just a few minutes.</p><h3>Step 1: Create an Account</h3><p>Sign up for a free account using your email address or social login. Verification takes just a moment.</p><h3>Step 2: Create a Memorial</h3><p>Click "Create Memorial" and fill in the details — name, dates, a biography, and a category. Add a photo to make the tribute personal.</p><h3>Step 3: Share with Family and Friends</h3><p>Once your memorial page is published, share the link with family members and friends so they can leave condolences and memories.</p><h3>Step 4: Receive Condolences</h3><p>Visitors can leave written condolences and light virtual candles on the memorial page. You will receive notifications as messages arrive.</p><p>Our platform is designed to make this process as gentle and straightforward as possible. If you need any help along the way, our support team is ready to assist you.</p>',
                'status'      => 1,
            ],
        ];

        foreach ($pages as $page) {
            Page::firstOrCreate(['slug' => $page['slug']], $page);
        }
    }
}
