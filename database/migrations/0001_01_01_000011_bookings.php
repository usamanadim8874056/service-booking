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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('id');
            $table->string('service');
            $table->integer('user');
            $table->integer('provider');
            $table->integer('location');
            $table->string('date');
            $table->string('status')->nullable()->default('0');
            $table->string('user_status')->nullable()->default('0');
            $table->string('provider_status')->nullable()->default('0');
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
        Schema::dropIfExists('bookings');
    }
};
