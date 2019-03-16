<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {

            $table->increments('id');                   //PK

            $table->unsignedInteger('user');            //FK of users
            $table->unsignedBigInteger('raffle');       //FK of raffles

            $table->unsignedInteger('parent')->nullable();
            $table->string('text');
            $table->timestamps();

            $table->foreign('parent')
                ->references('id')
                ->on('comments')
                ->onDelete('cascade');

            $table->foreign('user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('raffle')
                ->references('id')
                ->on('raffles')
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
        Schema::dropIfExists('comments');
    }
}
