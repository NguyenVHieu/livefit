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
        Schema::table('plans', function (Blueprint $table) {
            $table->string('price')->nullable()->change();
            $table->string('description')->nullable()->change();
            $table->string('instruction')->nullable()->change();
            $table->string('goal')->nullable()->change();
            $table->string('level')->nullable()->change();
            $table->string('equipment')->nullable()->change();
            $table->string('location')->nullable()->change();
            $table->boolean('is_sell')->nullable()->change();
            $table->string('calendar_exercises')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans', function (Blueprint $table) {
            //
        });
    }
};
