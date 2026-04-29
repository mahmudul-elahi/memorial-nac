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
                'description' => 'Max was a loyal and gentle Golden Retriever who brought endless joy, warmth, and unconditional love to our family for twelve beautiful years. He greeted every morning with a wagging tail and every person he met with pure enthusiasm. Whether it was running through the park, snuggling on the couch, or patiently sitting beside us during difficult moments, Max was always there. He was more than a pet — he was a cherished member of our family whose memory will forever live in our hearts.',
                'category'    => 'dog',
                'detail'      => ['sex' => 'male',   'birth_date' => '2012-04-10', 'death_date' => '2024-04-29', 'funeral_date' => '2024-05-01', 'funeral_place' => 'Peaceful Paws Pet Cemetery, Springfield'],
            ],
            [
                'title'       => 'Forever in Our Hearts: Luna the Tabby Cat',
                'description' => 'Our sweet Luna was a graceful tabby cat who curled up beside us every evening for fifteen wonderful years. She had a soft purr that could calm the most anxious moments and bright eyes that always seemed to understand exactly how we felt. Luna loved sunlit windowsills, warm blankets, and the company of her family above all else. She was our quiet companion through life\'s best and hardest days, and the silence she left behind is felt deeply by everyone who loved her.',
                'category'    => 'cat',
                'detail'      => ['sex' => 'female', 'birth_date' => '2009-07-22', 'death_date' => '2023-04-29', 'funeral_date' => '2023-05-01', 'funeral_place' => 'Home Garden, Riverside'],
            ],
            [
                'title'       => 'Remembering Sunny, Our Beloved Canary',
                'description' => 'Sunny was a bright and spirited canary who filled our home with beautiful song every single morning for seven joyful years. His cheerful chirps were the first sound we heard each day and the melody that made our house feel truly alive. Sunny loved perching by the window to watch the world go by and would sing with extra enthusiasm whenever the sun came through. He was small in size but enormous in spirit, and his absence leaves a quiet that words cannot fully describe.',
                'category'    => 'bird',
                'detail'      => ['sex' => 'male',   'birth_date' => '2017-03-05', 'death_date' => '2022-04-29', 'funeral_date' => '2022-04-30', 'funeral_place' => 'Backyard Garden, Portland'],
            ],
            [
                'title'       => 'Farewell to Cinnamon, Our Little Rabbit',
                'description' => 'Cinnamon was a sweet and energetic rabbit who hopped into our lives and our hearts from the very first day, bringing laughter, warmth, and endless cuddles throughout her five precious years with us. She had the softest fur, the most curious nose, and a personality far bigger than her tiny body. Cinnamon loved exploring every corner of the garden, flopping dramatically in her favourite spots, and binkying with joy whenever she was happy — which was most of the time.',
                'category'    => 'rabbit',
                'detail'      => ['sex' => 'female', 'birth_date' => '2019-08-14', 'death_date' => '2025-04-29', 'funeral_date' => '2025-04-30', 'funeral_place' => 'Home Garden, Denver'],
            ],
            [
                'title'       => 'In Memory of Bubbles, Our Beloved Goldfish',
                'description' => 'Bubbles was a vibrant and graceful goldfish who brought calm, beauty, and unexpected joy to our home aquarium for seven wonderful years. Small in size but enormous in personality, he would swim to the front of the tank whenever someone approached, as if greeting each visitor with curiosity and charm. Caring for Bubbles taught our whole family about patience, responsibility, and the quiet joy of watching a living creature thrive. He was truly one of a kind and deeply, genuinely loved.',
                'category'    => 'fish',
                'detail'      => ['sex' => 'male',   'birth_date' => '2017-01-01', 'death_date' => '2021-04-29', 'funeral_date' => '2021-04-29', 'funeral_place' => 'Home, Seattle'],
            ],
            [
                'title'       => 'Forever Remembered: Peanut the Hamster',
                'description' => 'Peanut was a tiny but fearless Syrian hamster who spun on his wheel, stuffed his cheeks with determination, and stole our hearts completely from the moment we brought him home. For two action-packed years he explored every inch of his habitat, rearranged his bedding nightly with absolute conviction, and somehow managed to escape his enclosure at least four times — each time found sleeping somewhere ridiculous. Peanut was small in size but left a giant impression on everyone who knew him.',
                'category'    => 'hamster',
                'detail'      => ['sex' => 'male',   'birth_date' => '2022-05-10', 'death_date' => '2024-04-29', 'funeral_date' => '2024-04-30', 'funeral_place' => 'Home Garden, Dallas'],
            ],
            [
                'title'       => 'A Tribute to Thunder, Our Majestic Rabbit',
                'description' => 'Thunder was the most curious, adventurous, and endlessly entertaining rabbit we have ever had the joy of knowing. From the day we brought him home he made it abundantly clear that the entire house belonged to him, and we were simply guests in his domain. He loved thumping loudly to announce his displeasure, binkying with wild abandon in the garden, and flopping beside us on warm afternoons. Thunder lived each of his five years with an enormous zest for life that we will never stop admiring.',
                'category'    => 'rabbit',
                'detail'      => ['sex' => 'male',   'birth_date' => '2018-02-14', 'death_date' => '2023-04-29', 'funeral_date' => '2023-04-30', 'funeral_place' => 'Sunrise Garden, Austin'],
            ],
            [
                'title'       => 'Goodbye to Bella, Our Playful Labrador',
                'description' => 'Bella was an exuberant, warm-hearted Labrador who never failed to make us smile through eleven spectacular years together. Her wagging tail was a constant fixture in our home, and her ability to sense when someone was sad and instantly appear with a toy or a nudge of her nose was truly remarkable. Bella lived for morning walks, swimming in any body of water she could find, and stealing socks in the most theatrical way possible. Her passing has left a hole in our home that cannot be filled.',
                'category'    => 'dog',
                'detail'      => ['sex' => 'female', 'birth_date' => '2014-06-18', 'death_date' => '2025-04-29', 'funeral_date' => '2025-05-01', 'funeral_place' => 'Sunny Meadows Pet Garden, Austin'],
            ],

            // ── DOGS ─────────────────────────────────────────────────────────────────
            [
                'title'       => 'Remembering Rocky, Our Faithful German Shepherd',
                'description' => 'Rocky was a noble, intelligent, and fiercely devoted German Shepherd who protected our home and filled our hearts with pride and love for eleven unforgettable years. He had the calm confidence of a guardian and the playful spirit of a puppy that never quite grew up. Rocky excelled at learning new commands, loved long hikes through the woods, and was at his happiest lying across the doorway making sure everyone was safely accounted for. He was, in every sense of the word, irreplaceable.',
                'category'    => 'dog',
                'detail'      => ['sex' => 'male',   'birth_date' => '2013-02-28', 'death_date' => '2024-07-14', 'funeral_date' => '2024-07-16', 'funeral_place' => 'Home Garden, Nashville'],
            ],
            [
                'title'       => 'In Memory of Buddy, Our Happy Beagle',
                'description' => 'Buddy was a spirited and endlessly cheerful Beagle who greeted every single day with enthusiasm and every person he encountered with unconditional love and a frantically wagging tail. For nine joyful years he filled our home with noise, laughter, and the occasional howl at absolutely nothing. Buddy had a nose for adventure and a heart full of warmth. He was the kind of dog who made strangers feel like old friends and made his family feel like the luckiest people alive.',
                'category'    => 'dog',
                'detail'      => ['sex' => 'male',   'birth_date' => '2015-09-10', 'death_date' => '2024-03-05', 'funeral_date' => '2024-03-07', 'funeral_place' => 'Paws at Peace Cemetery, Denver'],
            ],
            [
                'title'       => 'Farewell to Daisy, Our Sweet Border Collie',
                'description' => 'Daisy was a brilliant, energetic, and deeply loving Border Collie who herded hearts wherever she went and devoted twelve extraordinary years to her family with complete and unwavering loyalty. She was the smartest dog we have ever known — quick to learn, eager to please, and somehow always ten steps ahead of everyone in the room. Daisy loved agility courses, early morning runs, and herding the children into the kitchen at dinner time with surprising effectiveness. She is profoundly missed.',
                'category'    => 'dog',
                'detail'      => ['sex' => 'female', 'birth_date' => '2011-11-20', 'death_date' => '2024-02-18', 'funeral_date' => '2024-02-20', 'funeral_place' => 'Green Valley Pet Garden, Portland'],
            ],
            [
                'title'       => 'Honoring Cooper, Our Brave Rottweiler',
                'description' => 'Cooper was a strong, brave, and astonishingly gentle Rottweiler who spent ten memorable years as the proud protector and most affectionate member of our family. Despite his imposing size he was extraordinarily soft with children, endlessly patient with new visitors, and completely devoted to the people he called his own. Cooper loved car rides, belly rubs, and lounging in the sun with a dignity that suggested he was fully aware of how magnificent he was. He was one of the great ones.',
                'category'    => 'dog',
                'detail'      => ['sex' => 'male',   'birth_date' => '2014-07-04', 'death_date' => '2024-08-20', 'funeral_date' => '2024-08-22', 'funeral_place' => 'Sunset Hills Pet Memorial, Houston'],
            ],
            [
                'title'       => 'A Tribute to Sadie, Our Gentle Cocker Spaniel',
                'description' => 'Sadie was a tender, affectionate, and endlessly sweet Cocker Spaniel who filled thirteen years of our lives with softness, warmth, and the kind of gentle love that only the most special dogs can give. She had the softest ears in the world, a perpetually wagging tail, and a gift for curling herself into exactly the shape needed to fit in any lap. Sadie was our shadow, our comfort, and our constant companion. Thirteen years were a gift, and still not nearly enough time with her.',
                'category'    => 'dog',
                'detail'      => ['sex' => 'female', 'birth_date' => '2010-04-12', 'death_date' => '2023-12-01', 'funeral_date' => '2023-12-03', 'funeral_place' => 'Willow Creek Pet Cemetery, Charlotte'],
            ],

            // ── CATS ─────────────────────────────────────────────────────────────────
            [
                'title'       => 'In Memory of Whiskers, Our Gentle Persian Cat',
                'description' => 'Whiskers was a regal, serene, and deeply loving Persian cat who spent thirteen graceful years draped across our most comfortable furniture and softly purring by the fireplace with an air of complete contentment. He had the most magnificent coat, the most expressive eyes, and a calm presence that made our home feel instantly more peaceful. Whiskers was not merely a cat — he was an atmosphere. His quiet dignity and boundless affection made every day richer, and we miss him more than words can say.',
                'category'    => 'cat',
                'detail'      => ['sex' => 'male',   'birth_date' => '2010-11-03', 'death_date' => '2024-09-08', 'funeral_date' => '2024-09-10', 'funeral_place' => 'Backyard Garden, Boston'],
            ],
            [
                'title'       => 'Farewell to Mittens, Our Beloved Siamese',
                'description' => '<p>Mittens was an elegant, vocal, and deeply affectionate Siamese cat who filled our home with quiet elegance and endless love for twelve beautiful years. She had the most striking blue eyes, a voice she was never afraid to use, and an opinion on absolutely everything. Mittens loved being the centre of attention, supervising household activities with great authority, and choosing exactly who she would grace with her presence on any given evening. She was irreplaceable, and we feel her absence in every quiet corner of the house.</p>',
                'category'    => 'cat',
                'detail'      => ['sex' => 'female', 'birth_date' => '2011-05-15', 'death_date' => '2024-01-20', 'funeral_date' => '2024-01-22', 'funeral_place' => 'Home Garden, Seattle'],
            ],
            [
                'title'       => 'Remembering Oliver, Our Curious Maine Coon',
                'description' => 'Oliver was a magnificent, curious, and endlessly entertaining Maine Coon who explored every corner of our home and claimed every comfortable surface as his personal throne for nine wonderful years. He had the most impressive tufted ears, a magnificently fluffy tail, and the personality of someone who was absolutely certain that the world revolved around him — and honestly, in our house, it did. Oliver loved playing fetch, chirping at birds through the window, and supervising dinner preparation with intense focus.',
                'category'    => 'cat',
                'detail'      => ['sex' => 'male',   'birth_date' => '2015-01-08', 'death_date' => '2024-06-14', 'funeral_date' => '2024-06-15', 'funeral_place' => 'Backyard Garden, San Francisco'],
            ],
            [
                'title'       => 'In Loving Memory of Nala, Our Tortoiseshell Cat',
                'description' => 'Nala was a sassy, sharp, and deeply loving tortoiseshell cat who brought eleven years of colour, character, and warmth into our lives. She had strong opinions, a quick wit, and an unshakeable belief that her needs should always come first — which somehow made us love her even more. Nala was fiercely loyal to the people she chose, and once chosen, she was the most devoted companion imaginable. Her tortitude was legendary, her purr was thunder, and her memory is something we will carry forever.',
                'category'    => 'cat',
                'detail'      => ['sex' => 'female', 'birth_date' => '2012-08-30', 'death_date' => '2023-11-11', 'funeral_date' => '2023-11-12', 'funeral_place' => 'Home Garden, Atlanta'],
            ],
            [
                'title'       => 'Goodbye to Leo, Our Adventurous Orange Tabby',
                'description' => 'Leo was a bold, bright, and gloriously adventurous orange tabby who spent fourteen magnificent years chasing sunbeams, investigating every open bag or box, and curling up beside us each evening as though the whole day had been a grand expedition for our mutual benefit. He had the loudest purr, the most expressive face, and an absolute inability to resist squeezing himself into containers that were clearly too small. Leo made every ordinary day feel like an adventure, and we are forever grateful for the time we had.',
                'category'    => 'cat',
                'detail'      => ['sex' => 'male',   'birth_date' => '2009-03-22', 'death_date' => '2023-10-05', 'funeral_date' => '2023-10-06', 'funeral_place' => 'Backyard Garden, Chicago'],
            ],

            // ── BIRDS ────────────────────────────────────────────────────────────────
            [
                'title'       => 'A Tribute to Kiwi, Our Colorful Parrot',
                'description' => 'Kiwi was a vivid, intelligent, and gloriously theatrical African parrot who talked, sang, danced, and charmed his way into every heart he encountered across eight unforgettable years. He had a vocabulary that surprised visitors, a sense of humour that delighted us daily, and an ear for music that led him to sing along — loudly and enthusiastically — to songs he had only heard once. Kiwi was never just a bird; he was a personality, a performer, and a deeply cherished member of our family.',
                'category'    => 'bird',
                'detail'      => ['sex' => 'male',   'birth_date' => '2015-08-12', 'death_date' => '2024-06-30', 'funeral_date' => '2024-07-01', 'funeral_place' => 'Home, Miami'],
            ],
            [
                'title'       => 'Remembering Tweety, Our Sweet Parakeet',
                'description' => 'Tweety was a delightful, cheerful, and endlessly sweet parakeet who brightened every single morning with her gentle song for six wonderful years. She had the most beautiful blue and yellow feathers, a love of mirrors that was both adorable and slightly vain, and a talent for mimicking the ringtone of our phone with remarkable accuracy at the most inconvenient moments. Tweety brought lightness and joy to our home every day, and the quiet she left behind is something we feel deeply and constantly.',
                'category'    => 'bird',
                'detail'      => ['sex' => 'female', 'birth_date' => '2018-02-10', 'death_date' => '2024-05-22', 'funeral_date' => '2024-05-23', 'funeral_place' => 'Home Garden, Phoenix'],
            ],
            [
                'title'       => 'In Memory of Piper, Our Wise African Grey',
                'description' => 'Piper was a remarkable, wise, and deeply perceptive African Grey parrot who spent fifteen extraordinary years with us, holding conversations, offering unsolicited opinions, and always somehow knowing when we needed comfort the most. He had an astonishing vocabulary, a gift for mimicry that frequently fooled visitors, and a habit of saying exactly the wrong thing at exactly the right moment to make everyone burst out laughing. Piper was in every sense a companion, a confidant, and an irreplaceable part of our family.',
                'category'    => 'bird',
                'detail'      => ['sex' => 'male',   'birth_date' => '2007-06-01', 'death_date' => '2022-10-18', 'funeral_date' => '2022-10-19', 'funeral_place' => 'Backyard, Washington D.C.'],
            ],

            // ── RABBITS ──────────────────────────────────────────────────────────────
            [
                'title'       => 'Remembering Clover, Our Sweet Holland Lop',
                'description' => 'Clover was a gentle, endlessly curious, and completely lovable Holland Lop rabbit who brought five years of joy, softness, and quiet companionship to our family. She had the most perfectly floppy ears, a nose that never stopped twitching with interest, and a fondness for rearranging her hay into elaborate configurations that she appeared to take very seriously. Clover loved exploring the garden in the early morning, flopping in sunlit patches, and receiving chin rubs with an expression of pure, undisguised bliss.',
                'category'    => 'rabbit',
                'detail'      => ['sex' => 'female', 'birth_date' => '2019-04-20', 'death_date' => '2024-12-05', 'funeral_date' => '2024-12-06', 'funeral_place' => 'Home Garden, Phoenix'],
            ],
            [
                'title'       => 'Farewell to Thumper, Our Energetic Dwarf Rabbit',
                'description' => 'Thumper was an irrepressibly energetic, bold, and thoroughly entertaining Dwarf rabbit who zoomed through our lives and left the most enormous footprints for such a remarkably tiny creature. He had a habit of thumping his back feet at three in the morning for reasons known only to himself, binkying with wild abandon whenever he felt particularly joyful, and staring at us with an intensity that suggested he was constantly re-evaluating our worth as companions. He was absolutely, undeniably wonderful.',
                'category'    => 'rabbit',
                'detail'      => ['sex' => 'male',   'birth_date' => '2020-10-05', 'death_date' => '2024-10-04', 'funeral_date' => '2024-10-05', 'funeral_place' => 'Home Garden, Columbus'],
            ],

            // ── FISH ─────────────────────────────────────────────────────────────────
            [
                'title'       => 'Goodbye to Nemo, Our Clownfish',
                'description' => 'Nemo was a vivid, lively, and utterly captivating clownfish who brought the colours and wonder of the ocean into our living room for four spectacular years. He had the most striking orange and white markings, an endearing habit of swimming in tight little circles when excited, and a remarkable ability to make our entire family gather around the tank at feeding time as though it were the best show in town. Nemo was proof that even the smallest creatures can make the biggest difference to a home.',
                'category'    => 'fish',
                'detail'      => ['sex' => 'male',   'birth_date' => '2020-03-15', 'death_date' => '2024-11-22', 'funeral_date' => '2024-11-22', 'funeral_place' => 'Home, Chicago'],
            ],
            [
                'title'       => 'In Memory of Goldie, Our Graceful Betta Fish',
                'description' => 'Goldie was a breathtakingly beautiful and graceful Betta fish who glided through the water with an elegance and quiet confidence that made her tank the centrepiece of every room she inhabited for three spectacular years. Her flowing fins shimmered in shades of gold and crimson, catching the light in a way that made even the most distracted visitor stop and stare. Goldie was proof that beauty can be found in the smallest, most unexpected places, and her tank feels impossibly empty without her.',
                'category'    => 'fish',
                'detail'      => ['sex' => 'female', 'birth_date' => '2021-06-18', 'death_date' => '2024-07-25', 'funeral_date' => '2024-07-25', 'funeral_place' => 'Home, San Diego'],
            ],
            [
                'title'       => 'Remembering Splash, Our Playful Koi',
                'description' => 'Splash was a magnificent, serene, and quietly joyful Koi who spent eight peaceful years gliding through our garden pond and bringing a sense of calm and wonder to everyone who stopped to watch. He had brilliant scales that caught the afternoon light like living jewels, a habit of surfacing at exactly the right moment to greet whoever sat beside the pond, and a presence that made the garden feel complete in a way that is difficult to explain but impossible not to feel now that he is gone.',
                'category'    => 'fish',
                'detail'      => ['sex' => 'male',   'birth_date' => '2015-05-20', 'death_date' => '2023-08-10', 'funeral_date' => '2023-08-10', 'funeral_place' => 'Garden Pond, Sacramento'],
            ],

            // ── HAMSTERS ─────────────────────────────────────────────────────────────
            [
                'title'       => 'In Loving Memory of Hazel the Hamster',
                'description' => 'Hazel was a small but utterly captivating Syrian hamster who brightened every single evening with her curious, adventurous, and endlessly entertaining personality throughout two wonderful years with our family. She had the most perfect round cheeks, an impressive ability to stuff those cheeks with quantities of food that defied all logic, and a nightly exercise routine on her wheel that kept us all simultaneously amused and sleep-deprived. Hazel was a tiny soul who left a very large, very warm space in all of our hearts.',
                'category'    => 'hamster',
                'detail'      => ['sex' => 'female', 'birth_date' => '2022-09-01', 'death_date' => '2024-08-28', 'funeral_date' => '2024-08-29', 'funeral_place' => 'Home, San Diego'],
            ],
            [
                'title'       => 'Farewell to Nibbles, Our Tiny Syrian Hamster',
                'description' => 'Nibbles was a fearless, inquisitive, and wonderfully spirited Syrian hamster who packed more personality, adventure, and pure entertainment into two short years than most creatures manage in a lifetime. He had an insatiable curiosity about the world beyond his enclosure, an impressive collection of cheek-pouched treasures, and an ability to look simultaneously guilty and completely innocent that made discipline entirely impossible. Nibbles filled every day with laughter and left a lasting impression on everyone fortunate enough to meet him.',
                'category'    => 'hamster',
                'detail'      => ['sex' => 'male',   'birth_date' => '2023-01-15', 'death_date' => '2025-01-14', 'funeral_date' => '2025-01-14', 'funeral_place' => 'Home, Minneapolis'],
            ],
            [
                'title'       => 'Remembering Cookie, Our Sweet Dwarf Hamster',
                'description' => 'Cookie was a tiny, sweet, and wonderfully curious Dwarf hamster who filled every corner of her habitat — and our hearts — with warmth, wonder, and quiet joy throughout two delightful years as part of our family. She had the most perfectly round little body, enormous dark eyes that seemed to take in the whole world with fascination, and a nightly routine of rearranging her entire enclosure with the focused determination of someone who had very strong opinions about interior design. Cookie was deeply, genuinely loved.',
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
