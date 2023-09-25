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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->integer('price_negotiable')->nullable();
            $table->string('edu_condition')->nullable();
            $table->unsignedBigInteger('ads_id');
            $table->unsignedBigInteger('subCategoryTypesId');
            $table->timestamps();

            $table->foreign('ads_id')
            ->references('id')->on('ads')->onDelete('cascade');
            
            $table->foreign('subCategoryTypesId')
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
        Schema::dropIfExists('educations');
    }
};
