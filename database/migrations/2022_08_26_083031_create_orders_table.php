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
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->dateTime('datetime'); 
      $table->integer('discount'); 
      $table->float('total_payment', 8, 2); 
      $table->string('paygate'); 
      $table->string('status'); 
      $table->unsignedBigInteger('user_id'); 
      $table->foreign('user_id')->references('id')->on('users'); 
      $table->string('object'); 
      $table->string('object_id'); 
      $table->string('notes'); 
      $table->string('referral_code'); 
      $table->string('trainer_id');
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
    Schema::dropIfExists('orders');
  }
};
