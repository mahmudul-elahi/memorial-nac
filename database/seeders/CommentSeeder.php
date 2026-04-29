<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Item;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $items = Item::all();

        if ($users->isEmpty() || $items->isEmpty()) {
            $this->command->warn('No users or items found. Run UserSeeder and ItemSeeder first.');
            return;
        }

        $comments = [
            [
                'item_slug' => 'in-loving-memory-of-max-the-golden-retriever',
                'entries'   => [
                    ['user_email' => 'sarah@memorial.com',   'comment' => 'Max sounds like the most wonderful companion. Sending love to your family during this difficult time.'],
                    ['user_email' => 'emily@memorial.com',   'comment' => 'Golden Retrievers have such a special way of making every day brighter. Max will never be forgotten.'],
                    ['user_email' => 'michael@memorial.com', 'comment' => 'What a beautiful tribute. Twelve years of joy and loyalty — Max truly was one of the good ones.'],
                ],
            ],
            [
                'item_slug' => 'forever-in-our-hearts-luna-the-tabby-cat',
                'entries'   => [
                    ['user_email' => 'john@memorial.com',    'comment' => 'Luna sounds like she was such a gentle soul. I hope her memory brings you comfort every evening.'],
                    ['user_email' => 'jessica@memorial.com', 'comment' => 'Fifteen years is a beautiful long life. She was clearly so loved. My heart goes out to you.'],
                    ['user_email' => 'daniel@memorial.com',  'comment' => 'Cats have a way of becoming the heart of a home. Luna will always be curled up in your memories.'],
                ],
            ],
            [
                'item_slug' => 'remembering-sunny-our-beloved-canary',
                'entries'   => [
                    ['user_email' => 'ashley@memorial.com',  'comment' => 'A home that had Sunny\'s song in it every morning must have been such a joyful place. So sorry for your loss.'],
                    ['user_email' => 'chris@memorial.com',   'comment' => 'Birds bring such unique energy to a home. Sunny clearly brought a lot of light into your life.'],
                ],
            ],
            [
                'item_slug' => 'farewell-to-cinnamon-our-little-rabbit',
                'entries'   => [
                    ['user_email' => 'emily@memorial.com',   'comment' => 'Cinnamon sounds absolutely adorable. Rabbits are so full of personality. Wishing your family peace and healing.'],
                    ['user_email' => 'sarah@memorial.com',   'comment' => 'Such a sweet name for such a sweet little soul. Thank you for sharing Cinnamon\'s memory with us.'],
                    ['user_email' => 'michael@memorial.com', 'comment' => 'I also lost a rabbit last year and know how deeply they can touch your heart. Sending love.'],
                ],
            ],
            [
                'item_slug' => 'in-memory-of-bubbles-our-beloved-goldfish',
                'entries'   => [
                    ['user_email' => 'john@memorial.com',    'comment' => 'Seven years is a wonderful life for a goldfish. Bubbles clearly received so much love and care.'],
                    ['user_email' => 'jessica@memorial.com', 'comment' => 'People sometimes underestimate how attached we get to fish. Bubbles was clearly a true companion.'],
                ],
            ],
            [
                'item_slug' => 'forever-remembered-peanut-the-hamster',
                'entries'   => [
                    ['user_email' => 'ashley@memorial.com',  'comment' => 'Peanut sounds like such a little hero. The small ones always leave the biggest holes in our hearts.'],
                    ['user_email' => 'daniel@memorial.com',  'comment' => 'I love that you gave Peanut a proper memorial. Every life matters and deserves to be remembered.'],
                ],
            ],
            [
                'item_slug' => 'goodbye-to-bella-our-playful-labrador',
                'entries'   => [
                    ['user_email' => 'chris@memorial.com',   'comment' => 'Labs are just pure love. Bella sounds like she was a shining light in your home for so many years.'],
                    ['user_email' => 'emily@memorial.com',   'comment' => 'A wagging tail and warm eyes — that is the perfect way to describe a Lab. So sorry for your loss.'],
                    ['user_email' => 'john@memorial.com',    'comment' => 'Bella will always be running through sunny fields somewhere. Sending warmth to your whole family.'],
                ],
            ],
            [
                'item_slug' => 'remembering-rocky-our-faithful-german-shepherd',
                'entries'   => [
                    ['user_email' => 'michael@memorial.com', 'comment' => 'German Shepherds are among the most devoted animals on earth. Rocky sounds like he was no exception.'],
                    ['user_email' => 'sarah@memorial.com',   'comment' => 'Eleven years of protection and love — what a faithful companion Rocky must have been.'],
                ],
            ],
            [
                'item_slug' => 'in-memory-of-whiskers-our-gentle-persian-cat',
                'entries'   => [
                    ['user_email' => 'jessica@memorial.com', 'comment' => 'Persians are so regal and loving. Thirteen years by the fireplace sounds like a wonderful life.'],
                    ['user_email' => 'daniel@memorial.com',  'comment' => 'Whiskers sounds like the perfect companion for quiet evenings at home. A beautiful tribute.'],
                    ['user_email' => 'ashley@memorial.com',  'comment' => 'The image of a Persian cat by the fireplace is so comforting. Whiskers was clearly cherished.'],
                ],
            ],
            [
                'item_slug' => 'a-tribute-to-kiwi-our-colorful-parrot',
                'entries'   => [
                    ['user_email' => 'chris@memorial.com',   'comment' => 'Parrots are such intelligent and social animals. Eight years of conversation and song — what a gift Kiwi was.'],
                    ['user_email' => 'john@memorial.com',    'comment' => 'I bet the house feels very quiet without Kiwi\'s voice. Thinking of you during this time.'],
                ],
            ],
            [
                'item_slug' => 'remembering-clover-our-sweet-holland-lop',
                'entries'   => [
                    ['user_email' => 'emily@memorial.com',   'comment' => 'Holland Lops are the most gentle creatures. Clover sounds like she was an absolute treasure.'],
                    ['user_email' => 'sarah@memorial.com',   'comment' => 'Five years of curiosity and love. Thank you for honoring Clover\'s memory so beautifully.'],
                ],
            ],
            [
                'item_slug' => 'in-loving-memory-of-hazel-the-hamster',
                'entries'   => [
                    ['user_email' => 'michael@memorial.com', 'comment' => 'Hazel sounds like she packed a lifetime of joy into every single day. What a precious little soul.'],
                    ['user_email' => 'jessica@memorial.com', 'comment' => 'The small animals always find a way into the deepest parts of our hearts. So sorry for your loss.'],
                ],
            ],
        ];

        $itemMap = Item::all()->keyBy('slug');
        $userMap = $users->keyBy('email');

        foreach ($comments as $group) {
            $item = $itemMap->get($group['item_slug']);
            if (!$item) continue;

            foreach ($group['entries'] as $entry) {
                $user = $userMap->get($entry['user_email']);
                if (!$user) continue;

                Comment::firstOrCreate(
                    [
                        'item_id' => $item->id,
                        'user_id' => $user->id,
                        'content' => $entry['comment'],
                    ],
                    ['status' => 1]
                );
            }
        }
    }
}
