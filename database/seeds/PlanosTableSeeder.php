<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('planos')->truncate();

        DB::table('planos')->insert([
            'descricao' => 'Mensal',
            'valor' => 9.90
        ]);
        DB::table('planos')->insert([
            'descricao' => 'Semestral',
            'valor' => 49.90
        ]);
        DB::table('planos')->insert([
            'descricao' => 'Anual',
            'valor' => 79.90
        ]);
    }
}
