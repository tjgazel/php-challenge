<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTransacaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('status_transacao')->truncate();

        DB::table('status_transacao')->insert([
            'descricao' => 'Paga',
            'codigo' => 1
        ]);
        DB::table('status_transacao')->insert([
            'descricao' => 'Em análise',
            'codigo' => 2
        ]);
    }
}
