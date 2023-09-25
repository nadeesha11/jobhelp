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
        Schema::create('electronics', function (Blueprint $table) {
            $table->id();
            $table->string('ele_condition');
            $table->unsignedBigInteger('ads_id');
            $table->unsignedBigInteger('brands_id');
            $table->unsignedBigInteger('models_id');
            $table->string('ele_edition');
            $table->Integer('ele_price_negotiable');
            $table->unsignedBigInteger('sub_catgeory_types_id');
            $table->string('elec_screen_size');
            $table->string('elec_capacity');
            $table->timestamps();

            $table->foreign('ads_id')
            ->references('id')->on('ads')->onDelete('cascade');

            $table->foreign('brands_id')
            ->references('id')->on('subcategory_brands')->onDelete('cascade');

            $table->foreign('models_id')
            ->references('id')->on('brandmodel')->onDelete('cascade');

            $table->foreign('sub_catgeory_types_id')
            ->references('id')->on('sub_category_types')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('electronics');
    }
};
