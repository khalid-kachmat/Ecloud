<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('app_id');
            $table->string('app_patient_id');
            $table->string('app_doc_id');
            $table->string('app_service_id');
            $table->string('app_assurance_id');
            $table->string('app_start_date');
            $table->string('app_start_time');
            $table->string('app_end_date');
            $table->string('app_end_time');
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
        Schema::dropIfExists('appointments');
    }
}
