<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuccessMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('success_messages', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('message');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('success_messages');
    }
}
