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
            'title' => 'Book Trusted Local Services in Minutes',
            'sub_title' => 'Find verified professionals near you, compare prices, and schedule appointments with confidence.',
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
