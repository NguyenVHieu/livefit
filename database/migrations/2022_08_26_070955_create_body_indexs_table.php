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
        Schema::create('body_indexs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->dateTime('date');
            $table->float('height', 8, 2);
            $table->float('weight', 8, 2);
            $table->string('exercise_intansity');
            $table->float('bmi', 8, 2);
            $table->float('bmr', 8, 2);
            $table->float('tdee', 8, 2);
            $table->float('marco', 8, 2);
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
        Schema::dropIfExists('body_indexs');
    }
};
