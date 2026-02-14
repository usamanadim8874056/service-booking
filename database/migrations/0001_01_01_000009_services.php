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
        Schema::create('services', function (Blueprint $table) {
            $table->id('service_id');
            $table->string('service_name');
            $table->string('service_slug');
	        $table->text('service_description');
	        $table->text('service_images')->nullable();
	        $table->string('service_amount');
	        $table->time('service_start_time');
	        $table->time('service_end_time');
            $table->string('category');
            $table->integer('location');
            $table->integer('provider');
            $table->tinyInteger('status')->default('1');
            $table->tinyInteger('approved')->default('0');
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
        Schema::dropIfExists('services');
    }
};
