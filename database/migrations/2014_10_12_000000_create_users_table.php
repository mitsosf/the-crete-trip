<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

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
            $table->string('name')->default("");
            $table->string('surname')->default("");
            $table->string('role_id')->default("1"); //possible roles Participant, LC/GL, OC
            $table->string('email')->unique();
            $table->string('password');
            $table->string('section')->default("");
            $table->string('esncard')->nullable();
            $table->string('esncardstatus')->nullable();  //either "active", "available", "expired", "invalid"
            $table->string('document')->default("")->nullable(); //ID or passport number
            $table->string('birthday')->default("")->nullable();
            $table->string('gender')->default("")->nullable();
            $table->string('phone')->default("")->nullable();
            $table->string('country')->default("")->nullable();
            $table->string('boat')->default("")->nullable();
            $table->string('tshirt')->default("")->nullable();
            $table->string('city')->default("")->nullable();
            $table->string('facebook')->default("")->nullable();
            $table->string('allergies')->default("")->nullable();
            $table->string('comments')->default("")->nullable();
            $table->string('glcomments')->default("")->nullable();
            $table->string('fee')->default('No')->nullable();   //event fee payed
            $table->dateTime('feedate')->nullable();
            $table->string('tickets')->default('No')->nullable(); //boat tickets
            $table->dateTime('ticketsdate')->nullable();
            $table->string('rooming')->default('No')->nullable();
            $table->string('roomingcomments')->default("")->nullable();
            $table->string('checkin')->default("No")->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
