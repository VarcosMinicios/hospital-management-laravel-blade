<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['abbreviation' => "AC", "name" => "Acre"],
            ['abbreviation' => "AL", "name" => "Alagoas"],
            ['abbreviation' => "AP", "name" => "Amapá"],
            ['abbreviation' => "AM", "name" => "Amazonas"],
            ['abbreviation' => "BA", "name" => "Bahia"],
            ['abbreviation' => "CE", "name" => "Ceará"],
            ['abbreviation' => "DF", "name" => "Distrito Federal"],
            ['abbreviation' => "ES", "name" => "Espírito Santo"],
            ['abbreviation' => "GO", "name" => "Goiás"],
            ['abbreviation' => "MA", "name" => "Maranhão"],
            ['abbreviation' => "MT", "name" => "Mato Grosso"],
            ['abbreviation' => "MS", "name" => "Mato Grosso do Sul"],
            ['abbreviation' => "MG", "name" => "Minas Gerais"],
            ['abbreviation' => "PA", "name" => "Pará"],
            ['abbreviation' => "PB", "name" => "Paraíba"],
            ['abbreviation' => "PR", "name" => "Paraná"],
            ['abbreviation' => "PE", "name" => "Pernambuco"],
            ['abbreviation' => "PI", "name" => "Piauí"],
            ['abbreviation' => "RJ", "name" => "Rio de Janeiro"],
            ['abbreviation' => "RN", "name" => "Rio Grande do Norte"],
            ['abbreviation' => "RS", "name" => "Rio Grande do Sul"],
            ['abbreviation' => "RO", "name" => "Rondônia"],
            ['abbreviation' => "RR", "name" => "Roraima"],
            ['abbreviation' => "SC", "name" => "Santa Catarina"],
            ['abbreviation' => "SP", "name" => "São Paulo"],
            ['abbreviation' => "SE", "name" => "Sergipe"],
            ['abbreviation' => "TO", "name" => "Tocantins"]
        ];

        foreach ($datas as $data) {
            $exists = DB::table('states')
                ->where('name', $data['name'])
                ->exists();

            if (!$exists) {
                DB::table('states')->insert($data);
            }
        }
    }
}
