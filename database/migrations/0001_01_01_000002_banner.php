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
        Schema::create('banner', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('sub_title');
            $table->string('banner_image');
            $table->timestamps();
        });

        DB::table('banner')->insert([
            'title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
            'sub_title' => 'Praesent porta mi vel bibendum scelerisque',
            'banner_image' => '1444547224banner.jpg',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner');
    }
};
