<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {

            $table->increments('id');

            $table->string('code', 5);

            $table->unsignedBigInteger('raffle');          //FK of raffles

            $table->unsignedInteger('buyer')->nullable();  //FK of users

            $table->boolean('sold')->default(false);
            $table->boolean('bingo')->default(false);
            $table->timestamps();

            $table->foreign('raffle')
                ->references('id')
                ->on('raffles')
                ->onDelete('cascade');

            $table->foreign('buyer')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');
        });

        Schema::create('referralsbuys', function (Blueprint $table) {

            $table->increments('id');

            $table->unsignedInteger('comisionist');
            $table->unsignedInteger('ticket');
            $table->timestamps();

            $table->foreign('comisionist')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('ticket')
                ->references('id')
                ->on('tickets')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referralsbuys');
        Schema::dropIfExists('tickets');
    }
}
