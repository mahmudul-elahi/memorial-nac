<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('categories')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
