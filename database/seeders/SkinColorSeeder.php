<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkinColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['description' => 'Branco'],
            ['description' => 'Pardo'],
            ['description' => 'Preto'],
            ['description' => 'Indígena'],
            ['description' => 'Amarelo']
        ];

        foreach ($datas as $data) {
            $exists = DB::table('skin_colors')
                ->where('description', $data['description'])
                ->exists();

            if (!$exists) {
                DB::table('skin_colors')->insert($data);
            }
        }
    }
}
