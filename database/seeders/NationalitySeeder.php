<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['description' => 'Brasileira'],
            ['description' => 'Naturalizado Brasileiro'],
            ['description' => 'Boliviana'],
            ['description' => 'Argentina'],
            ['description' => 'Chilena'],
            ['description' => 'Paraguaia'],
            ['description' => 'Uruguaia'],
            ['description' => 'Alemã'],
            ['description' => 'Belga'],
            ['description' => 'Britânica'],
            ['description' => 'Canadense'],
            ['description' => 'Espanhola'],
            ['description' => 'Norte Americana'],
            ['description' => 'Francesa'],
            ['description' => 'Suíça'],
            ['description' => 'Italiana'],
            ['description' => 'Japonesa'],
            ['description' => 'Chinesa'],
            ['description' => 'Coreana'],
            ['description' => 'Portuguesa'],
            ['description' => 'Outros (América latina)'],
            ['description' => 'Outros (Asiáticos)'],
            ['description' => 'Outros (Indeterminado)'],
        ];

        foreach ($datas as $data) {
            $exists = DB::table('nationalities')
                ->where('description', $data['description'])
                ->exists();

            if (!$exists) {
                DB::table('nationalities')->insert($data);
            }
        }
    }
}
