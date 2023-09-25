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
        Schema::create('property', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ads_id');
            $table->string('address')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('house_size')->nullable();
            $table->string('land_type')->nullable();

            $table->string('landSize')->nullable();
            $table->string('landSize_measure')->nullable();

            $table->string('unit_price')->nullable();
            $table->string('unit_price_measure')->nullable();

            $table->string('negotiable')->nullable();
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
        Schema::dropIfExists('property');
    }
};
