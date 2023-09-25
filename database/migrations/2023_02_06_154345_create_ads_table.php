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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('ads_location');
            $table->string('ads_sublocation');
            $table->string('ads_title');
            $table->string('ads_description');
            $table->string('ads_type');
            $table->float('ads_price', 8, 2);
            $table->string('ads_main_image');
            $table->integer('status');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sub_cat_id');
            $table->unsignedBigInteger('cat_id');
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
        Schema::dropIfExists('ads');
    }
};
