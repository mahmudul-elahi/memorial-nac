<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Detail;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ItemSeeder extends Seeder
{
    public function run()
    {
        $users = User::role('user')->get();

        if ($users->isEmpty()) {
            $this->command->warn('No users with "user" role found. Run UserSeeder first.');
            return;
        }

        $items = [
            // ── ANNIVERSARIES (death_date = April 29 so they appear today) ──────────
            [
                'title'       => 'In Loving Memory of Max the Golden Retriever',
                'description' => 'A loyal and gentle dog who brought endless joy and warmth to our family for twelve years.',
                'category'    => 'dog',
                'detail'      => ['sex' => 'male',   'birth_date' => '2012-04-10', 'death_date' => '2024-04-29', 'funeral_date' => '2024-05-01', 'funeral_place' => 'Peaceful Paws Pet Cemetery, Springfield'],
            ],
            [
                'title'       => 'Forever in Our Hearts: Luna the Tabby Cat',
                'description' => 'Our sweet Luna curled up beside us every evening for fifteen years. She will never be forgotten.',
                'category'    => 'cat',
                'detail'      => ['sex' => 'female', 'birth_date' => '2009-07-22', 'death_date' => '2023-04-29', 'funeral_date' => '2023-05-01', 'funeral_place' => 'Home Garden, Riverside'],
            ],
            [
                'title'       => 'Remembering Sunny, Our Beloved Canary',
                'description' => 'Sunny filled our home with song every morning. His cheerful chirps are deeply missed.',
                'category'    => 'bird',
                'detail'      => ['sex' => 'male',   'birth_date' => '2017-03-05', 'death_date' => '2022-04-29', 'funeral_date' => '2022-04-30', 'funeral_place' => 'Backyard Garden, Portland'],
            ],
            [
                'title'       => 'Farewell to Cinnamon, Our Little Rabbit',
                'description' => 'Cinnamon hopped into our lives and hearts, bringing laughter and cuddles every single day.',
                'category'    => 'rabbit',
                'detail'      => ['sex' => 'female', 'birth_date' => '2019-08-14', 'death_date' => '2025-04-29', 'funeral_date' => '2025-04-30', 'funeral_place' => 'Home Garden, Denver'],
            ],
            [
                'title'       => 'In Memory of Bubbles, Our Beloved Goldfish',
                'description' => 'Small in size but big in personality, Bubbles brightened our home aquarium for seven wonderful years.',
                'category'    => 'fish',
                'detail'      => ['sex' => 'male',   'birth_date' => '2017-01-01', 'death_date' => '2021-04-29', 'funeral_date' => '2021-04-29', 'funeral_place' => 'Home, Seattle'],
            ],
            [
                'title'       => 'Forever Remembered: Peanut the Hamster',
                'description' => 'Peanut was tiny but fearless, spinning on his wheel and stealing our hearts every single day.',
                'category'    => 'hamster',
                'detail'      => ['sex' => 'male',   'birth_date' => '2022-05-10', 'death_date' => '2024-04-29', 'funeral_date' => '2024-04-30', 'funeral_place' => 'Home Garden, Dallas'],
            ],
            [
                'title'       => 'A Tribute to Thunder, Our Majestic Rabbit',
                'description' => 'Thunder was the most curious and adventurous rabbit we have ever had the joy of knowing.',
                'category'    => 'rabbit',
                'detail'      => ['sex' => 'male',   'birth_date' => '2018-02-14', 'death_date' => '2023-04-29', 'funeral_date' => '2023-04-30', 'funeral_place' => 'Sunrise Garden, Austin'],
            ],
            [
                'title'       => 'Goodbye to Bella, Our Playful Labrador',
                'description' => 'Bella never failed to make us smile. Her wagging tail and warm eyes are forever missed.',
                'category'    => 'dog',
                'detail'      => ['sex' => 'female', 'birth_date' => '2014-06-18', 'death_date' => '2025-04-29', 'funeral_date' => '2025-05-01', 'funeral_place' => 'Sunny Meadows Pet Garden, Austin'],
            ],

            // ── DOGS ─────────────────────────────────────────────────────────────────
            [
                'title'       => 'Remembering Rocky, Our Faithful German Shepherd',
                'description' => 'Rocky protected our home and filled our hearts for eleven wonderful years.',
                'category'    => 'dog',
                'detail'      => ['sex' => 'male',   'birth_date' => '2013-02-28', 'death_date' => '2024-07-14', 'funeral_date' => '2024-07-16', 'funeral_place' => 'Home Garden, Nashville'],
            ],
            [
                'title'       => 'In Memory of Buddy, Our Happy Beagle',
                'description' => 'Buddy greeted every day with excitement and every person with love. He is irreplaceable.',
                'category'    => 'dog',
                'detail'      => ['sex' => 'male',   'birth_date' => '2015-09-10', 'death_date' => '2024-03-05', 'funeral_date' => '2024-03-07', 'funeral_place' => 'Paws at Peace Cemetery, Denver'],
            ],
            [
                'title'       => 'Farewell to Daisy, Our Sweet Border Collie',
                'description' => 'Daisy herded hearts wherever she went and gave us twelve years of unconditional devotion.',
                'category'    => 'dog',
                'detail'      => ['sex' => 'female', 'birth_date' => '2011-11-20', 'death_date' => '2024-02-18', 'funeral_date' => '2024-02-20', 'funeral_place' => 'Green Valley Pet Garden, Portland'],
            ],
            [
                'title'       => 'Honoring Cooper, Our Brave Rottweiler',
                'description' => 'Cooper was gentle with children and fiercely loyal to our family for ten memorable years.',
                'category'    => 'dog',
                'detail'      => ['sex' => 'male',   'birth_date' => '2014-07-04', 'death_date' => '2024-08-20', 'funeral_date' => '2024-08-22', 'funeral_place' => 'Sunset Hills Pet Memorial, Houston'],
            ],
            [
                'title'       => 'A Tribute to Sadie, Our Gentle Cocker Spaniel',
                'description' => 'Sadie had the softest ears and the biggest heart. Thirteen years were never enough.',
                'category'    => 'dog',
                'detail'      => ['sex' => 'female', 'birth_date' => '2010-04-12', 'death_date' => '2023-12-01', 'funeral_date' => '2023-12-03', 'funeral_place' => 'Willow Creek Pet Cemetery, Charlotte'],
            ],

            // ── CATS ─────────────────────────────────────────────────────────────────
            [
                'title'       => 'In Memory of Whiskers, Our Gentle Persian Cat',
                'description' => 'Whiskers spent thirteen graceful years with us, always purring softly by the fireplace.',
                'category'    => 'cat',
                'detail'      => ['sex' => 'male',   'birth_date' => '2010-11-03', 'death_date' => '2024-09-08', 'funeral_date' => '2024-09-10', 'funeral_place' => 'Backyard Garden, Boston'],
            ],
            [
                'title'       => 'Farewell to Mittens, Our Beloved Siamese',
                'description' => 'Mittens filled our home with quiet elegance and endless affection for twelve beautiful years.',
                'category'    => 'cat',
                'detail'      => ['sex' => 'female', 'birth_date' => '2011-05-15', 'death_date' => '2024-01-20', 'funeral_date' => '2024-01-22', 'funeral_place' => 'Home Garden, Seattle'],
            ],
            [
                'title'       => 'Remembering Oliver, Our Curious Maine Coon',
                'description' => 'Oliver explored every corner of our home and claimed every lap as his throne for nine years.',
                'category'    => 'cat',
                'detail'      => ['sex' => 'male',   'birth_date' => '2015-01-08', 'death_date' => '2024-06-14', 'funeral_date' => '2024-06-15', 'funeral_place' => 'Backyard Garden, San Francisco'],
            ],
            [
                'title'       => 'In Loving Memory of Nala, Our Tortoiseshell Cat',
                'description' => 'Nala was sassy, sweet, and irreplaceable. Eleven years of purring love we will never forget.',
                'category'    => 'cat',
                'detail'      => ['sex' => 'female', 'birth_date' => '2012-08-30', 'death_date' => '2023-11-11', 'funeral_date' => '2023-11-12', 'funeral_place' => 'Home Garden, Atlanta'],
            ],
            [
                'title'       => 'Goodbye to Leo, Our Adventurous Orange Tabby',
                'description' => 'Leo spent his days chasing sunbeams and his evenings curled up beside us for fourteen loving years.',
                'category'    => 'cat',
                'detail'      => ['sex' => 'male',   'birth_date' => '2009-03-22', 'death_date' => '2023-10-05', 'funeral_date' => '2023-10-06', 'funeral_place' => 'Backyard Garden, Chicago'],
            ],

            // ── BIRDS ────────────────────────────────────────────────────────────────
            [
                'title'       => 'A Tribute to Kiwi, Our Colorful Parrot',
                'description' => 'Kiwi talked, sang, and danced his way into our hearts over eight unforgettable years.',
                'category'    => 'bird',
                'detail'      => ['sex' => 'male',   'birth_date' => '2015-08-12', 'death_date' => '2024-06-30', 'funeral_date' => '2024-07-01', 'funeral_place' => 'Home, Miami'],
            ],
            [
                'title'       => 'Remembering Tweety, Our Sweet Parakeet',
                'description' => 'Tweety brightened every morning with her song for six wonderful years.',
                'category'    => 'bird',
                'detail'      => ['sex' => 'female', 'birth_date' => '2018-02-10', 'death_date' => '2024-05-22', 'funeral_date' => '2024-05-23', 'funeral_place' => 'Home Garden, Phoenix'],
            ],
            [
                'title'       => 'In Memory of Piper, Our Wise African Grey',
                'description' => 'Piper could hold a conversation and always knew when we needed comfort. Fifteen amazing years.',
                'category'    => 'bird',
                'detail'      => ['sex' => 'male',   'birth_date' => '2007-06-01', 'death_date' => '2022-10-18', 'funeral_date' => '2022-10-19', 'funeral_place' => 'Backyard, Washington D.C.'],
            ],

            // ── RABBITS ──────────────────────────────────────────────────────────────
            [
                'title'       => 'Remembering Clover, Our Sweet Holland Lop',
                'description' => 'Clover was gentle, curious, and endlessly lovable during her five happy years with our family.',
                'category'    => 'rabbit',
                'detail'      => ['sex' => 'female', 'birth_date' => '2019-04-20', 'death_date' => '2024-12-05', 'funeral_date' => '2024-12-06', 'funeral_place' => 'Home Garden, Phoenix'],
            ],
            [
                'title'       => 'Farewell to Thumper, Our Energetic Dwarf Rabbit',
                'description' => 'Thumper zoomed through our lives and left the biggest footprints for such a tiny creature.',
                'category'    => 'rabbit',
                'detail'      => ['sex' => 'male',   'birth_date' => '2020-10-05', 'death_date' => '2024-10-04', 'funeral_date' => '2024-10-05', 'funeral_place' => 'Home Garden, Columbus'],
            ],

            // ── FISH ─────────────────────────────────────────────────────────────────
            [
                'title'       => 'Goodbye to Nemo, Our Clownfish',
                'description' => 'Nemo brought the colors of the ocean into our living room and our hearts for four bright years.',
                'category'    => 'fish',
                'detail'      => ['sex' => 'male',   'birth_date' => '2020-03-15', 'death_date' => '2024-11-22', 'funeral_date' => '2024-11-22', 'funeral_place' => 'Home, Chicago'],
            ],
            [
                'title'       => 'In Memory of Goldie, Our Graceful Betta Fish',
                'description' => 'Goldie glided through the water with elegance and grace for three spectacular years.',
                'category'    => 'fish',
                'detail'      => ['sex' => 'female', 'birth_date' => '2021-06-18', 'death_date' => '2024-07-25', 'funeral_date' => '2024-07-25', 'funeral_place' => 'Home, San Diego'],
            ],
            [
                'title'       => 'Remembering Splash, Our Playful Koi',
                'description' => 'Splash spent eight serene years in our garden pond, bringing peace to everyone who watched him.',
                'category'    => 'fish',
                'detail'      => ['sex' => 'male',   'birth_date' => '2015-05-20', 'death_date' => '2023-08-10', 'funeral_date' => '2023-08-10', 'funeral_place' => 'Garden Pond, Sacramento'],
            ],

            // ── HAMSTERS ─────────────────────────────────────────────────────────────
            [
                'title'       => 'In Loving Memory of Hazel the Hamster',
                'description' => 'Hazel was a small bundle of joy who brightened every evening with her curious little adventures.',
                'category'    => 'hamster',
                'detail'      => ['sex' => 'female', 'birth_date' => '2022-09-01', 'death_date' => '2024-08-28', 'funeral_date' => '2024-08-29', 'funeral_place' => 'Home, San Diego'],
            ],
            [
                'title'       => 'Farewell to Nibbles, Our Tiny Syrian Hamster',
                'description' => 'Nibbles filled two short years with more joy and laughter than we ever thought possible.',
                'category'    => 'hamster',
                'detail'      => ['sex' => 'male',   'birth_date' => '2023-01-15', 'death_date' => '2025-01-14', 'funeral_date' => '2025-01-14', 'funeral_place' => 'Home, Minneapolis'],
            ],
            [
                'title'       => 'Remembering Cookie, Our Sweet Dwarf Hamster',
                'description' => 'Cookie was a tiny explorer who filled every corner of her cage and our hearts with wonder.',
                'category'    => 'hamster',
                'detail'      => ['sex' => 'female', 'birth_date' => '2022-11-20', 'death_date' => '2024-11-19', 'funeral_date' => '2024-11-19', 'funeral_place' => 'Home, Detroit'],
            ],
        ];

        $categoryMap = Category::all()->keyBy('slug');

        foreach ($items as $index => $data) {
            $user     = $users[$index % $users->count()];
            $category = $categoryMap->get($data['category']);

            $item = Item::firstOrCreate(
                ['slug' => Str::slug($data['title'])],
                [
                    'title'       => $data['title'],
                    'description' => $data['description'],
                    'user_id'     => $user->id,
                    'category_id' => $category?->id,
                    'slug'        => Str::slug($data['title']),
                    'status'      => 1,
                ]
            );

            if (!$item->details()->exists()) {
                Detail::create(array_merge($data['detail'], ['item_id' => $item->id]));
            }
        }
    }
}
