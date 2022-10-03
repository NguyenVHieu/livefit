<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('price');
            $table->string('name');
            $table->string('url');
            $table->string('description');
            $table->string('instruction');
            $table->string('goal');
            $table->string('level');
            $table->string('equipment');
            $table->string('location');
            $table->string('image');
            $table->boolean('is_sell');
            $table->string('calendar_exercises');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
};
