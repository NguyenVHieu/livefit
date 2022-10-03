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
        Schema::table('exercise_details', function (Blueprint $table) {
            $table->dropForeign('exercise_details_workout_id_foreign');
            $table->dropForeign('exercise_details_exercise_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exercise_details', function (Blueprint $table) {
            //
        });
    }
};
