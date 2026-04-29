<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            PageImageSeeder::class,
            CategorySeeder::class,
            BlogCategorySeeder::class,
            ItemSeeder::class,
            PostSeeder::class,
            PageSeeder::class,
            BlogCommentSeeder::class,
            CommentSeeder::class,
        ]);
    }
}
