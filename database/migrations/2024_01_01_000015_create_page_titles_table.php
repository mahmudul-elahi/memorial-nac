<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageTitlesTable extends Migration
{
    public function up()
    {
        Schema::create('page_titles', function (Blueprint $table) {
            $table->id();
            $table->string('page_identifier')->unique();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_titles');
    }
}
