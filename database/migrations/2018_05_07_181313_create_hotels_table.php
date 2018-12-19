<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TODO fix this blasphemy :P
        Schema::create('hotels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('sixbeds')->default(0);
            $table->integer('fivebeds')->default(0);
            $table->integer('fourbeds')->default(0);
            $table->integer('threebeds')->default(0);
            $table->integer('twobeds')->default(0);
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
        Schema::dropIfExists('hotels');
    }
}
