<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFollowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_follow', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('follow_id');
            $table->unsignedInteger('follower_id');
            $table->foreign('follow_id')
                ->references('id')
                ->on('users')
                ->onDelete('Cascade');

            $table->foreign('follower_id')
                ->references('id')
                ->on('users')
                ->onDelete('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_follow');
    }
}
