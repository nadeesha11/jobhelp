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
        Schema::create('vehicle', function (Blueprint $table) {
            $table->id();
            $table->string('condition')->nullable();
            $table->string('edition')->nullable();
            $table->string('manufacture_year')->nullable();
            $table->string('milage')->nullable();
            $table->string('engine_capacity')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('transmission')->nullable();
            $table->string('body_type')->nullable();
            $table->string('price_negotiable');

            $table->unsignedBigInteger('ads_id');
            $table->unsignedBigInteger('brands_id');
            $table->unsignedBigInteger('models_id');
            $table->unsignedBigInteger('sub_category_types_id');

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
        Schema::dropIfExists('vehicle');
    }
};
