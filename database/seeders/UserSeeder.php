<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@mahmudul.elahi'],
            [
                'name'              => 'Admin User',
                'password'          => Hash::make('12345678'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        // Remove old admin email if it still exists from a previous seed
        User::where('email', 'admin@memorial.com')
            ->where('id', '!=', $admin->id)
            ->delete();

        $regularUsers = [
            ['name' => 'Mahmudul Elahi',   'email' => 'mahmudul.elahi@gmail.com'],
            ['name' => 'Mahmudul Softvence','email' => 'mahmudul.softvence@gmail.com'],
            ['name' => 'John Smith',        'email' => 'john@memorial.com'],
            ['name' => 'Sarah Johnson',     'email' => 'sarah@memorial.com'],
            ['name' => 'Emily Davis',       'email' => 'emily@memorial.com'],
            ['name' => 'Michael Brown',     'email' => 'michael@memorial.com'],
            ['name' => 'Jessica Wilson',    'email' => 'jessica@memorial.com'],
            ['name' => 'Daniel Martinez',   'email' => 'daniel@memorial.com'],
            ['name' => 'Ashley Taylor',     'email' => 'ashley@memorial.com'],
            ['name' => 'Chris Anderson',    'email' => 'chris@memorial.com'],
        ];

        foreach ($regularUsers as $data) {
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name'              => $data['name'],
                    'password'          => Hash::make('12345678'),
                    'email_verified_at' => now(),
                ]
            );
            $user->assignRole('user');
        }
    }
}
