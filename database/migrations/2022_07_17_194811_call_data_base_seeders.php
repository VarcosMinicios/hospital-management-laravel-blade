<?php

use Database\Seeders\NationalitySeeder;
use Database\Seeders\SkinColorSeeder;
use Database\Seeders\StateSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Artisan::call('db:seed', ['--class' => StateSeeder::class]);
        Artisan::call('db:seed', ['--class' => NationalitySeeder::class]);
        Artisan::call('db:seed', ['--class' => SkinColorSeeder::class]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
