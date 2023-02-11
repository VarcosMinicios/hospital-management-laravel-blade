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
        Schema::create('professionals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('people_id');
            $table->foreign('people_id')->references('id')->on('people');
            $table->string('name', 100);
            $table->string('schedule', 13);
            $table->string('scale', 7);
            $table->string('sector', 25);
            $table->date('admission_date');
            $table->date('departure_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['people_id', 'sector', 'admission_date', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professionals');
    }
};
