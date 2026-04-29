<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->enum('sex', ['male', 'female'])->nullable();
            $table->date('birth_date')->nullable();
            $table->date('death_date')->nullable();
            $table->date('funeral_date')->nullable();
            $table->string('funeral_place')->nullable();
            $table->foreignId('item_id')->constrained('items')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('details');
    }
}
