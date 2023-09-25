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
        Schema::create('brandmodel', function (Blueprint $table) {
            $table->id();
            $table->string('model_name');
            $table->integer('status');
            $table->unsignedBigInteger('brand_id');
            $table->timestamps();

            $table->foreign('brand_id')
            ->references('id')->on('subcategory_brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brandmodel_models');
    }
};
