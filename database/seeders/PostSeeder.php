<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin\Blog\Post;
use App\Models\Admin\Blog\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run()
    {
        // Posts are created by the admin user
        $admin = User::role('admin')->first();

        if (!$admin) {
            $this->command->warn('No admin user found. Run UserSeeder first.');
            return;
        }

        $categoryMap = BlogCategory::all()->keyBy('slug');

        $posts = [
            [
                'title'       => 'How to Write a Meaningful Obituary',
                'slug'        => 'how-to-write-a-meaningful-obituary',
                'description' => 'A step-by-step guide to crafting an obituary that truly honors your loved one\'s life.',
                'body'        => '<p>Writing an obituary can feel overwhelming when you are already grieving. A meaningful obituary goes beyond listing dates — it tells the story of a life. Start by gathering key facts: full name, date of birth, date of passing, survivors, and career highlights. Then weave in personal details: hobbies, passions, funny memories, and the values your loved one held dear.</p><p>Keep the tone warm and personal. Read it aloud before publishing to ensure it sounds like a tribute, not a form. Most importantly, write from the heart — authenticity is what resonates with readers and honors the person\'s memory.</p>',
                'category'    => 'obituary-writing-tips',
                'status'      => 1,
            ],
            [
                'title'       => 'Five Stages of Grief: What to Expect After a Loss',
                'slug'        => 'five-stages-of-grief-what-to-expect',
                'description' => 'Understanding the grieving process can help you or someone you love navigate one of life\'s hardest journeys.',
                'body'        => '<p>The five stages of grief — denial, anger, bargaining, depression, and acceptance — were introduced by psychiatrist Elisabeth Kübler-Ross. These stages are not a strict linear progression; most people move between them fluidly. Denial often shows up as numbness or disbelief in the immediate aftermath of a loss. Anger may be directed at the deceased, at oneself, or even at others.</p><p>Bargaining involves "what if" thinking, while depression brings deep sadness and withdrawal. Acceptance does not mean forgetting — it means finding a way to live forward while carrying the memory of your loved one. Professional support, community, and time are your greatest allies.</p>',
                'category'    => 'grief-healing',
                'status'      => 1,
            ],
            [
                'title'       => 'Memorial Traditions Around the World',
                'slug'        => 'memorial-traditions-around-the-world',
                'description' => 'Different cultures celebrate and remember the departed in beautiful and unique ways.',
                'body'        => '<p>Across cultures, humanity has developed rich traditions to honor those who have passed. In Mexico, Día de los Muertos brings families together to build altars, share food, and celebrate the lives of loved ones. In Japan, the Obon festival involves lighting lanterns and floating them on rivers to guide spirits home.</p><p>In Ghana, fantasy coffins are crafted to reflect the deceased\'s life and passions — from planes to fish. In Ireland, a wake is an opportunity to gather, tell stories, and celebrate the life just lived. Understanding these traditions reminds us that grief is universal, but the ways we honor the dead are beautifully diverse.</p>',
                'category'    => 'memorial-traditions',
                'status'      => 1,
            ],
            [
                'title'       => 'Planning a Meaningful Funeral on a Budget',
                'slug'        => 'planning-a-meaningful-funeral-on-a-budget',
                'description' => 'Practical tips to help families create a dignified farewell without financial strain.',
                'body'        => '<p>Funerals in the United States can cost anywhere from $7,000 to $12,000 or more. However, a meaningful farewell does not have to break the bank. Start by requesting an itemized price list from funeral homes — the FTC\'s Funeral Rule requires them to provide one. Consider direct cremation or green burial as lower-cost alternatives.</p><p>Personalize the service with family-made displays, a playlist of the deceased\'s favourite songs, and a potluck reception. Many cemeteries and funeral homes offer payment plans. Pre-planning your own funeral is also one of the kindest gifts you can give your family.</p>',
                'category'    => 'funeral-planning',
                'status'      => 1,
            ],
            [
                'title'       => 'How Our Community Came Together to Honor a Local Hero',
                'slug'        => 'community-honors-local-hero',
                'description' => 'A touching story of how neighbors rallied to celebrate the life of a beloved firefighter.',
                'body'        => '<p>When retired firefighter Thomas Walsh passed away last autumn, no one expected the outpouring that followed. Hundreds of residents lined the streets of Maplewood to pay their respects during his funeral procession. Former colleagues arrived in fire trucks from three counties. Students from the school he volunteered at made hand-drawn cards.</p><p>His daughter, Karen Walsh, told us: "Dad always said he was just doing his job. But seeing this community response made us realize how many lives he truly touched." Thomas\'s story is a reminder that the most meaningful lives are often lived quietly, one act of service at a time.</p>',
                'category'    => 'community-stories',
                'status'      => 1,
            ],
        ];

        foreach ($posts as $data) {
            $category = $categoryMap->get($data['category']);

            Post::firstOrCreate(
                ['slug' => $data['slug']],
                [
                    'title'       => $data['title'],
                    'slug'        => $data['slug'],
                    'description' => $data['description'],
                    'body'        => $data['body'],
                    'category_id' => $category?->id,
                    'status'      => $data['status'],
                ]
            );
        }
    }
}
