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
      Schema::create('exercise_details', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('exercise_id');
        $table->foreign('exercise_id')->references('id')->on('exercises');
        $table->unsignedBigInteger('workout_id');
        $table->foreign('workout_id')->references('id')->on('workouts');
        $table->integer('set');
        $table->integer('rep');
        $table->integer('set_rest');
        $table->integer('exercise_rest');
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
      Schema::dropIfExists('exercise_details');
    }
};
