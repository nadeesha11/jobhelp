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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ads_id');
            $table->string('jobType');
            $table->string('job_work_expirience');
            $table->string('job_education');
            $table->string('jobs_application_deadline');
            $table->string('sallary_start_from');
            $table->string('sallary_start_to');
            $table->string('job_employer');
            $table->string('job_employer_website');

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
        Schema::dropIfExists('jobs');
    }
};
