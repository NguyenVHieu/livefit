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
      Schema::create('workouts', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('plan_id');
        $table->foreign('plan_id')->references('id')->on('plans');
        $table->string('title');
        $table->string('description');
        $table->dateTime('time');
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
      Schema::dropIfExists('workouts');
    }
};
