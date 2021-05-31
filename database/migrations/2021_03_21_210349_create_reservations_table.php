<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("confirmed_by")->unsigned()->nullable();
            $table->bigInteger("reserved_by")->unsigned();
            $table->bigInteger("service_id")->unsigned();
            $table->bigInteger("room_number")->unsigned();

            $table->dateTime("check_in");
            $table->dateTime("check_out");
            $table->integer("reservation_price")->unsigned();
            $table->integer("accompanies")->unsigned()->default(0);

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
        Schema::dropIfExists('reservations');
    }
}
