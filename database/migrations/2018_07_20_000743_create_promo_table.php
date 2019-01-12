<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promoclients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->unique();
            $table->string('contact');                                      // Array Field
            $table->string('email', 35);
            $table->timestamps();
        });

        Schema::create('promos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->unique();
            $table->unsignedTinyInteger('type')->default(0);                 // You have only two types [0 principal | 1 secundary]
            $table->unsignedTinyInteger('status')->default(0);               // You have only two types [0 unable | 1 enable]
            $table->string('alternative', 200);
            $table->string('website', 60);
            $table->date('expdate');
            $table->string('image', 70)->nullable();
            $table->timestamps();

            //FK
            $table->unsignedInteger('client');
            $table->foreign('client')
                ->references('id')
                ->on('promoclients')
                ->onUpdate('restrict')
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
        Schema::dropIfExists('promo');
        Schema::dropIfExists('promoclients');
    }
}
