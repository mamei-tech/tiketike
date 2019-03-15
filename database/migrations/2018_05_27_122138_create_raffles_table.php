<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRafflesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rafflecategories', function (Blueprint $table) {
            $table->increments('id');      //PK
            $table->string('category', 25)->unique();
            $table->string('icon');
            $table->timestamps();
        });

        Schema::create('rafflestatus', function (Blueprint $table) {
            $table->increments('id');   //PK
            $table->string('status', 12)->unique();
            $table->timestamps();
        });

        Schema::create('raffle_pays',function (Blueprint $table) {
            $table->increments('id');   //PK
            $table->unsignedBigInteger('raffle_id');
            $table->string('charge_id');
            $table->float('amount');
        });

        Schema::create('raffles', function (Blueprint $table) {

            $table->unsignedBigInteger('id');       //PK

            $table->unsignedInteger('owner');       //FK of users
            $table->unsignedInteger('category');    //FK of categories
            $table->unsignedInteger('status');      //FK of status
            $table->unsignedInteger('location');    //FK of location

            $table->string('title', 60);
            $table->text('description');
            $table->float('price');
            $table->float('progress')->default(0);
            $table->unsignedInteger('tickets_count')->default(0);
            $table->float('tickets_price')->nullable();
            $table->string('image')->default("pics/common/rotating_card_profile.png");
            $table->unsignedtinyInteger('profit')->nullable();
            $table->float('commissions')->nullable();
            $table->date('activation_date')->nullable();
            $table->timestamps();

            //Keys specificationUserProfile
            $table->primary('id');      //PK

            $table->foreign('owner')    //FK
            ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->foreign('category') //FK
            ->references('id')
                ->on('rafflecategories')
                ->onDelete('restrict');

            $table->foreign('status')   //FK
            ->references('id')
                ->on('rafflestatus')
                ->onDelete('restrict');

            $table->foreign('location')  //FK
            ->references('id')
                ->on('world_countries')
                ->onDelete('restrict');
        });

        Schema::create('rafflepictures', function (Blueprint $table) {
            $table->increments('id');               //PK
            $table->unsignedBigInteger('raffle');   //FK of raffles
            $table->string('src', 255);
            $table->timestamps();

            //Keys specification
            $table->foreign('raffle')
                ->references('id')
                ->on('raffles')
                ->onDelete('cascade');
        });

        Schema::create('raffleitems', function (Blueprint $table) {
            $table->increments('id');               //PK
            $table->unsignedBigInteger('raffle');   //FK of raffles
            $table->string('name', 35);
            $table->string('description')->nullable();
            $table->timestamps();

            //Keys specification
            $table->foreign('raffle')
                ->references('id')
                ->on('raffles')
                ->onDelete('restrict');
        });

        Schema::create('raffle_confirmation', function (Blueprint $table) {
            $table->increments('id');      //PK
            $table->integer('winner_id')->unsigned();
            $table->boolean('wconfirmation');
            $table->integer('owner_id')->unsigned();
            $table->boolean('oconfirmation');
            $table->unsignedBigInteger('raffle_id');

            $table->foreign('winner_id')    //FK
            ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->foreign('owner_id')    //FK
            ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->foreign('raffle_id')    //FK
            ->references('id')
                ->on('raffles')
                ->onDelete('restrict');
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
        Schema::dropIfExists('raffleitems');
        Schema::dropIfExists('rafflepictures');
        Schema::dropIfExists('raffles');
        Schema::dropIfExists('rafflestatus');
        Schema::dropIfExists('rafflecategories');
    }
}
