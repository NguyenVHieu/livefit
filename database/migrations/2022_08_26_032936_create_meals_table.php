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
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->string('price');
            $table->string('title');
            $table->string('description');
            $table->string('ingredients');
            $table->string('category');
            $table->string('goal');
            $table->float('calories', 8, 2);
            $table->float('carbs', 8, 2);
            $table->float('protein', 8, 2);
            $table->float('fat', 8, 2);
            $table->dateTime('time');
            $table->string('servings');
            $table->string('status');
            $table->string('image');
            $table->boolean('is_custom');
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
        Schema::dropIfExists('meals');
    }
};
