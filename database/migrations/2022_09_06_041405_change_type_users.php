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
        Schema::table('users', function (Blueprint $table){
            $table->string('birthday')->nullable()->change();
            $table->string('gender')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->boolean('is_trainer')->nullable()->change();
            $table->string('referral_id')->nullable()->change();
            $table->string('meal_ids')->nullable()->change();
            $table->string('body_index')->nullable()->change();
            $table->string('packages')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
