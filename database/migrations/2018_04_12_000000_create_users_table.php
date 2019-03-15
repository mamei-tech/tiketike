<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40);
            $table->string('lastname', 40);
            $table->string('email', 35)->unique();
            $table->string('avatar')->nullable();
            $table->string('password')->nullable();
            $table->float('ranking')->nullable();
            $table->string('api_token', 60)->unique()->nullable();   // Auth purpose
            $table->rememberToken();
            $table->timestamps();
        });

        // Schema::create('countries', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('name', 60)->unique();
        // });

        // Schema::create('cities', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('name', 30);

        //     //FK
        //     $table->unsignedInteger('country');
        //     $table->foreign('country')
        //         ->references('id')
        //         ->on('countries')
        //         ->onUpdate('restrict')
        //         ->onDelete('cascade');
        // });


        /* TODO test the delete user opertation delete its profiles to */
        Schema::create('usersprofiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username',  25);                         //The same as unsignedBigInteger
            $table->date('birthdate')->nullable();
            $table->string('gender', 6);                             //male or female
            $table->string('langcode', 2)->default('en');
            $table->string('avatarname')->default('default');               //TODO Check if this is working properly
            $table->string('bio', 116)->nullable();
            $table->string('addrss', 60);
            $table->string('phone', 15)->nullable();
            $table->float('balance')->default(0);
            $table->unsignedInteger('zipcode', false);
            $table->timestamps();

            //FK
            $table->unsignedInteger('user')->index();
            $table->foreign('user')
                ->references('id')
                ->on('users')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->unsignedInteger('city');
            $table->foreign('city')
                ->references('id')
                ->on('world_cities')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            //PK
            //Implicit
        });

        Schema::create('debitcards', function (Blueprint $table) {

            $table->increments('id');                               //PK
            $table->unsignedBigInteger('accnumber')->unique();      // TODO I don't know if this must be unique
            $table->string("expiration", 7)->default("MM/AAAA")->nullable();
            $table->smallInteger("cvv")->nullable();
            $table->timestamps();

            $table->unsignedInteger('owner');        //FK
            $table->foreign('owner')                //Keys specification
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('debitcards');
        Schema::dropIfExists('usersprofiles');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('users');
    }
}
