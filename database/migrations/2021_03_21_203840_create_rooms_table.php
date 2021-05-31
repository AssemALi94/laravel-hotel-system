<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('number')->startingValue(1000);
            $table->integer('floor_number')->unsigned();
            $table->bigInteger('created_by')->unsigned();

            $table->integer('room_price')->unsigned();
            $table->integer('capacity')->unsigned()->default(1);
            $table->enum('status',['busy','renewing','available'])->default('available');

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
        Schema::dropIfExists('rooms');
    }
}
