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
                'title'       => 'About Us',
                'slug'        => 'about-us',
                'description' => 'Learn about our mission to help families honor and remember their loved ones.',
                'content'     => '<p>Memorial is a compassionate platform dedicated to helping families and friends create lasting tributes for those they have lost. We believe that every life deserves to be remembered and celebrated, regardless of social standing or background.</p><p>Our platform provides a safe, respectful space where you can create an obituary page, share memories, upload photos, and receive condolences from your community. We are committed to making the process of remembrance as simple and meaningful as possible during one of life\'s most difficult moments.</p><p>Founded in 2020, Memorial has helped thousands of families across the country honor their loved ones with dignity and love.</p>',
                'status'      => 1,
            ],
            [
                'title'       => 'Privacy Policy',
                'slug'        => 'privacy-policy',
                'description' => 'How we collect, use, and protect your personal information.',
                'content'     => '<p>Your privacy is important to us. This Privacy Policy explains how Memorial collects, uses, discloses, and safeguards your information when you visit our website.</p><h3>Information We Collect</h3><p>We may collect personal information such as your name, email address, and profile data when you register for an account. We also collect content you voluntarily submit, including memorial pages, photos, and comments.</p><h3>How We Use Your Information</h3><p>We use your information to operate and improve our platform, communicate with you about your account, and provide a personalized experience. We do not sell your personal information to third parties.</p><h3>Data Security</h3><p>We implement industry-standard security measures to protect your data. However, no method of transmission over the internet is 100% secure, and we cannot guarantee absolute security.</p><p>If you have any questions about this policy, please contact us at privacy@memorial.com.</p>',
                'status'      => 1,
            ],
            [
                'title'       => 'Terms of Service',
                'slug'        => 'terms-of-service',
                'description' => 'The terms and conditions governing your use of the Memorial platform.',
                'content'     => '<p>By accessing or using Memorial, you agree to be bound by these Terms of Service. Please read them carefully before using our platform.</p><h3>Acceptable Use</h3><p>You agree to use Memorial only for lawful purposes and in a manner that does not infringe the rights of others. You must not post content that is offensive, defamatory, or untrue about any living or deceased individual.</p><h3>Content Ownership</h3><p>You retain ownership of the content you submit to Memorial. By posting content, you grant us a non-exclusive, royalty-free license to display and distribute that content in connection with our services.</p><h3>Account Responsibilities</h3><p>You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account. Please notify us immediately of any unauthorized use.</p><p>We reserve the right to terminate accounts that violate these terms at our discretion.</p>',
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
