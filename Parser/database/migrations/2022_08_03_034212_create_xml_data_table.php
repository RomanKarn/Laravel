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
        Schema::create('xml_data', function (Blueprint $table) {
            $table->id();
            $table->string("mark", 100);
            $table->string("model", 100);
            $table->string("generation", 100);
            $table->integer("year");
            $table->integer("run");
            $table->string("color", 100);
            $table->string("body-type", 100);
            $table->string("engine-type", 100);
            $table->string("transmission", 100);
            $table->string("gear-type", 100);
            $table->integer("generation_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('xml_data');
    }
};
