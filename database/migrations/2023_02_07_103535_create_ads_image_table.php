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
        Schema::create('ads_image', function (Blueprint $table) {
            $table->id();
            $table->string('image_name');
            $table->unsignedBigInteger('ads_id');
            $table->timestamps();

            $table->foreign('ads_id')
            ->references('id')->on('ads')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads_image');
    }
};
