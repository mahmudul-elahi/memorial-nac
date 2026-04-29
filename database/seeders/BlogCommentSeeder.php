<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin\Blog\Post;
use App\Models\Admin\Blog\BlogComment;
use Illuminate\Database\Seeder;

class BlogCommentSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $posts = Post::all();

        if ($users->isEmpty() || $posts->isEmpty()) {
            $this->command->warn('No users or posts found. Run UserSeeder and PostSeeder first.');
            return;
        }

        $comments = [
            // Post 1 – How to Write a Meaningful Obituary
            [
                'post_slug' => 'how-to-write-a-meaningful-obituary',
                'entries'   => [
                    ['user_email' => 'john@memorial.com',    'comment' => 'This was incredibly helpful. I struggled to find the right words for my father and this guide really made the process easier.'],
                    ['user_email' => 'sarah@memorial.com',   'comment' => 'Thank you for this. I especially liked the advice about reading it aloud before publishing — such a simple but powerful tip.'],
                    ['user_email' => 'emily@memorial.com',   'comment' => 'Writing the obituary was the hardest part for our family. I wish I had read this sooner. Bookmarking for the future.'],
                    ['user_email' => 'michael@memorial.com', 'comment' => 'Great article. The reminder to focus on the "why" rather than just listing facts really resonated with me.'],
                ],
            ],
            // Post 2 – Five Stages of Grief
            [
                'post_slug' => 'five-stages-of-grief-what-to-expect',
                'entries'   => [
                    ['user_email' => 'jessica@memorial.com', 'comment' => 'I lost my dog last month and I can honestly say I felt every single one of these stages. This article helped me feel less alone.'],
                    ['user_email' => 'daniel@memorial.com',  'comment' => 'Really important to emphasize that these stages are not linear. I kept going back and forth between anger and depression for weeks.'],
                    ['user_email' => 'ashley@memorial.com',  'comment' => 'Beautifully written. Grief is so personal and yet so universal. Thank you for putting it into words.'],
                ],
            ],
            // Post 3 – Memorial Traditions Around the World
            [
                'post_slug' => 'memorial-traditions-around-the-world',
                'entries'   => [
                    ['user_email' => 'chris@memorial.com',   'comment' => 'The section on Día de los Muertos was beautiful. I think Western cultures could learn so much from that tradition.'],
                    ['user_email' => 'john@memorial.com',    'comment' => 'I had no idea about the fantasy coffins in Ghana! Fascinating and moving at the same time.'],
                    ['user_email' => 'sarah@memorial.com',   'comment' => 'The Irish wake tradition is something my family still practices. There is something so healing about gathering and sharing stories.'],
                    ['user_email' => 'emily@memorial.com',   'comment' => 'This made me want to research my own family\'s cultural traditions around loss. Thank you for the inspiration.'],
                ],
            ],
            // Post 4 – Planning a Funeral on a Budget
            [
                'post_slug' => 'planning-a-meaningful-funeral-on-a-budget',
                'entries'   => [
                    ['user_email' => 'michael@memorial.com', 'comment' => 'The tip about requesting an itemized price list is gold. Many people do not know they have that right and end up overpaying.'],
                    ['user_email' => 'jessica@memorial.com', 'comment' => 'We used a potluck reception for my grandmother and it was actually one of the most beautiful parts of the day. Highly recommend.'],
                ],
            ],
            // Post 5 – Community Honors Local Hero
            [
                'post_slug' => 'community-honors-local-hero',
                'entries'   => [
                    ['user_email' => 'daniel@memorial.com',  'comment' => 'Stories like this restore my faith in humanity. What a wonderful tribute to a life of service.'],
                    ['user_email' => 'ashley@memorial.com',  'comment' => 'Thomas sounds like an incredible person. The image of students making hand-drawn cards brought tears to my eyes.'],
                    ['user_email' => 'chris@memorial.com',   'comment' => 'This is exactly the kind of community spirit we need more of. Rest in peace, Thomas.'],
                    ['user_email' => 'john@memorial.com',    'comment' => 'My grandfather was a firefighter too. Reading this made me want to call my family and tell them how much I love them.'],
                ],
            ],
        ];

        $postMap = Post::all()->keyBy('slug');
        $userMap = $users->keyBy('email');

        foreach ($comments as $group) {
            $post = $postMap->get($group['post_slug']);
            if (!$post) continue;

            foreach ($group['entries'] as $entry) {
                $user = $userMap->get($entry['user_email']);
                if (!$user) continue;

                BlogComment::firstOrCreate(
                    [
                        'post_id'      => $post->id,
                        'commented_by' => $user->id,
                        'comment'      => $entry['comment'],
                    ],
                    ['status' => 1]
                );
            }
        }
    }
}
