<?php

namespace Database\Seeders;

use App\Models\SuccessMessage;
use Illuminate\Database\Seeder;

class SuccessMessageSeeder extends Seeder
{
    public function run()
    {
        SuccessMessage::updateOrCreate(
            ['key' => 'memorial_post_success'],
            ['message' => 'Thank you for submitting your memorial. Our team will review it and publish it shortly. You will be notified once it goes live.']
        );
    }
}
