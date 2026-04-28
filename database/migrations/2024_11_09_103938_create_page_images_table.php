<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_images', function (Blueprint $table) {
            $table->id();
            $table->string('image_url'); // URL for the image
            $table->string('text')->nullable(); // Text overlay on the image
            $table->integer('order')->default(0); // Order for display
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_images');
    }
}
