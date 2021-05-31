<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->string('country')->nullable();

            $table->string('provided_id')->nullable();
            $table->text('avatar')->nullable();

            $table->string('phone')->nullable();
            $table->string('national_id')->nullable();
            $table->enum('gender',['male','female'])->nullable();


            $table->enum('role',['admin','manager','receptionist','client'])->default('client');

            $table->bigInteger('manager_id')->unsigned()->nullable();
            $table->foreign('manager_id')->references('id')->on('users');

            $table->bigInteger('approval_id')->unsigned()->nullable();
            $table->foreign('approval_id')->references('id')->on('users');

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
