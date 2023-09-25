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
        Schema::create('subcategory_brands', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name');
            $table->integer('status');
            $table->unsignedBigInteger('sub_cat_id');
            $table->timestamps();

            $table->foreign('sub_cat_id')
            ->references('id')->on('subcategory')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcategory_brands');
    }
};
