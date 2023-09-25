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
            $table->id();
            $table->integer("price_negotiable");
            $table->unsignedBigInteger("sub_cat_types_id");
            $table->unsignedBigInteger("ads_id");
            $table->timestamps();

            $table->foreign('ads_id')
            ->references('id')->on('ads')->onDelete('cascade');

            $table->foreign('sub_cat_types_id')
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
        Schema::dropIfExists('services');
    }
};
