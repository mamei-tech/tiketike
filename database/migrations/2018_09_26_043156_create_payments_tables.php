<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->enum('type', ['refund','payment']);
            $table->enum('status', ['executed','pending']);
            $table->timestamps();
        });

        Schema::create('payables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_id');
            $table->bigInteger('payable_id');
            $table->string('payable_type');
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
        Schema::dropIfExists('payment');
        Schema::dropIfExists('payables');
    }
}
