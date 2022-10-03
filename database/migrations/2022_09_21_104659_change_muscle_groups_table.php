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
        Schema::table('muscle_groups', function (Blueprint $table) {
            $table->dropColumn('secondary_muscle_group');
            $table->renameColumn('primary_muscle_group','title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('muscle_groups', function (Blueprint $table) {
            //
        });
    }
};
