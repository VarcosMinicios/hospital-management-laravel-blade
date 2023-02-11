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
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cpf', 11)->unique();
            $table->string('rg', 15)->nullable();
            $table->string('cns', 15)->unique();
            $table->date('birth_date');
            $table->string('mother_name', 100);
            $table->string('father_name', 100)->nullable();
            $table->boolean('unknown_father')->default(false);
            $table->string('gender', 9);
            $table->string('nationality', 40);
            $table->string('skin_color', 10);
            $table->string('profession', 25);
            $table->timestamps();
            $table->index(['cpf', 'cns', 'gender']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
};
