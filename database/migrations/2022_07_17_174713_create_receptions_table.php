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
            $table->unsignedInteger('people_id');
            $table->foreign('people_id')->references('id')->on('people');
            $table->unsignedInteger('professional_id');
            $table->foreign('professional_id')->references('id')->on('professionals');
            $table->unsignedInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->unsignedInteger('nurse_id');
            $table->foreign('nurse_id')->references('id')->on('nurses');
            $table->date('admission_date');
            $table->string('diagnosis', 100);
            $table->string('dependency', 20);
            $table->string('clinic', 10);
            $table->timestamps();
            $table->index(['people_id', 'doctor_id', 'admission_date', 'clinic']);
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
