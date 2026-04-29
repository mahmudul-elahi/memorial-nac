<?php

namespace Database\Seeders;

use App\Models\PageImage;
use Illuminate\Database\Seeder;

class PageImageSeeder extends Seeder
{
    public function run()
    {
        $images = [
            ['image_url' => 'img/components/hero_1.jpg', 'text' => 'Honoring Lives, Preserving Memories', 'order' => 1],
            ['image_url' => 'img/components/hero_2.jpg', 'text' => 'A Place to Remember and Reflect',      'order' => 2],
            ['image_url' => 'img/components/hero_3.jpg', 'text' => 'Share Your Tribute with the World',    'order' => 3],
            ['image_url' => 'img/components/hero_4.jpg', 'text' => 'Celebrate a Life Well Lived',          'order' => 4],
            ['image_url' => 'img/components/hero_5.jpg', 'text' => 'Together in Remembrance',              'order' => 5],
        ];

        foreach ($images as $image) {
            PageImage::firstOrCreate(['order' => $image['order']], $image);
        }
    }
}
