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
        Schema::create('push_point_models', function (Blueprint $table) {
            $table->id('id')->after('email');;
            $table->int('avtor_id')->after('email');;
            $table->string('top')->after('email');;
            $table->string('coords')->after('email');;
            $table->text('allInform')->after('email');;
            $table->string('image')->after('email');;
            $table->string('typePoint')->after('email');;
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('push_point_models');
    }
};
