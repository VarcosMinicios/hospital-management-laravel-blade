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
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('people_id');
            $table->foreign('people_id')->references('id')->on('people');
            $table->string('cep', 8);
            $table->string('street_type', 50);
            $table->string('street', 50);
            $table->string('number', 6);
            $table->string('state', 2);
            $table->string('city', 50);
            $table->string('neighborhood', 50);
            $table->string('ibge', 7);
            $table->string('reference', 50)->nullable();
            $table->string('complement', 50)->nullable();
            $table->timestamps();
            $table->index(['cep', 'people_id', 'street', 'state', 'city']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
