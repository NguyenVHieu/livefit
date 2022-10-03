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
      Schema::create('exercises', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('description')->nullable();
        $table->string('instruction')->nullable();
        $table->string('image')->nullable();
        $table->string('video')->nullable();
        $table->string('type')->nullable();
        $table->string('goal')->nullable();
        $table->string('level')->nullable();
        $table->string('equipment')->nullable();
        $table->string('location')->nullable();
        $table->string('primary_muscle_group')->nullable();
        $table->string('secondary_muscle_group')->nullable();
        $table->text('tips')->nullable();
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
      Schema::dropIfExists('exercises');
    }
};
