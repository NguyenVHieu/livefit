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
        Schema::table('meals', function (Blueprint $table) {
            $table->string('slug')->after('title');
            $table->string('price')->nullable()->change();
            $table->string('description')->nullable()->change();
            $table->string('ingredients')->nullable()->change();
            $table->string('category')->nullable()->change();
            $table->string('goal')->nullable()->change();
            $table->string('calories')->nullable()->change();
            $table->string('carbs')->nullable()->change();
            $table->string('protein')->nullable()->change();
            $table->string('fat')->nullable()->change();
            $table->string('time')->nullable()->change();
            $table->string('servings')->nullable()->change();
            $table->string('status')->nullable()->change();
            $table->string('is_custom')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meals', function (Blueprint $table) {
            //
        });
    }
};
