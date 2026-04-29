<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Dog',     'slug' => 'dog',     'description' => 'Memorials for beloved dogs.'],
            ['name' => 'Cat',     'slug' => 'cat',     'description' => 'Memorials for cherished cats.'],
            ['name' => 'Bird',    'slug' => 'bird',    'description' => 'Memorials for feathered companions.'],
            ['name' => 'Rabbit',  'slug' => 'rabbit',  'description' => 'Memorials for beloved rabbits.'],
            ['name' => 'Fish',    'slug' => 'fish',    'description' => 'Memorials for aquatic companions.'],
            ['name' => 'Hamster', 'slug' => 'hamster', 'description' => 'Memorials for small furry friends.'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['slug' => $cat['slug']],
                ['name' => $cat['name'], 'description' => $cat['description'], 'status' => 1]
            );
        }
    }
}
