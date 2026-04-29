<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@memorial.com'],
            [
                'name'              => 'Admin User',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        $regularUsers = [
            ['name' => 'John Smith',      'email' => 'john@memorial.com'],
            ['name' => 'Sarah Johnson',   'email' => 'sarah@memorial.com'],
            ['name' => 'Emily Davis',     'email' => 'emily@memorial.com'],
            ['name' => 'Michael Brown',   'email' => 'michael@memorial.com'],
            ['name' => 'Jessica Wilson',  'email' => 'jessica@memorial.com'],
            ['name' => 'Daniel Martinez', 'email' => 'daniel@memorial.com'],
            ['name' => 'Ashley Taylor',   'email' => 'ashley@memorial.com'],
            ['name' => 'Chris Anderson',  'email' => 'chris@memorial.com'],
        ];

        foreach ($regularUsers as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name'              => $data['name'],
                    'password'          => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );
            $user->assignRole('user');
        }
    }
}
