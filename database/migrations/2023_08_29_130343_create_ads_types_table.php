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
        Schema::create('ads_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ads_package_id');
            $table->string('name');
            $table->integer('duration');
            $table->float('price');
            $table->timestamps();

            $table->foreign('ads_package_id')
                ->references('id')->on('packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads_types');
    }
};
