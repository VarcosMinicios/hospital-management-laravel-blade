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
        Schema::create('receptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->unsignedInteger('professional_id');
            $table->foreign('professional_id')->references('id')->on('professionals');
            $table->unsignedInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->unsignedInteger('nurse_id')->nullable();
            $table->foreign('nurse_id')->references('id')->on('nurses');
            $table->date('admission_date');
            $table->string('diagnosis', 100)->nullable();
            $table->string('dependency', 20);
            $table->string('clinic', 12);
            $table->integer('security_deposit')->nullable();
            $table->timestamps();
            $table->index(['patient_id', 'doctor_id', 'professional_id', 'admission_date', 'clinic'], 'patient_doctor_professional_date_clinic');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receptions');
    }
};
