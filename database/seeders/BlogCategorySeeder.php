<?php

namespace Database\Seeders;

use App\Models\Admin\Blog\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name'        => 'Grief & Healing',
                'slug'        => 'grief-healing',
                'description' => 'Articles on coping with loss and finding healing after bereavement.',
                'status'      => 1,
            ],
            [
                'name'        => 'Memorial Traditions',
                'slug'        => 'memorial-traditions',
                'description' => 'Exploring cultural and personal traditions for honoring the departed.',
                'status'      => 1,
            ],
            [
                'name'        => 'Funeral Planning',
                'slug'        => 'funeral-planning',
                'description' => 'Practical guides for planning a meaningful farewell.',
                'status'      => 1,
            ],
            [
                'name'        => 'Obituary Writing Tips',
                'slug'        => 'obituary-writing-tips',
                'description' => 'How to write a heartfelt and memorable obituary.',
                'status'      => 1,
            ],
            [
                'name'        => 'Community Stories',
                'slug'        => 'community-stories',
                'description' => 'Stories and tributes shared by community members.',
                'status'      => 1,
            ],
        ];

        foreach ($categories as $cat) {
            BlogCategory::firstOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
