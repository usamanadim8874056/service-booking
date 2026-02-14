<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('com_name');
            $table->string('com_logo')->nullable(); 
            $table->string('com_email'); 
            $table->string('com_phone');
            $table->string('address');
            $table->text('description');
            $table->string('copyright_text');
            $table->string('cur_format');
            $table->tinyInteger('auto_approve_service')->default('1');
            $table->integer('min_add_amount')->default('10');
            $table->timestamps();
        });

        DB::table('general_settings')->insert([
            'com_name' => 'Service Booking',
            'com_logo' => '',
            'com_email' => 'servicebooking@gmail.com',
            'com_phone' => '+92 307 8458800',
            'address' => 'Multan, Punjab, Pakistan',
            'description' => 'Find trusted professionals for cleaning, repairs, beauty, and more. Compare providers, check availability, and book quality service near you with ease.',
            'copyright_text' => 'Copyright © 2025-2030 | Service Booking',
            'cur_format' => '$',
            'min_add_amount' => '10',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
};
