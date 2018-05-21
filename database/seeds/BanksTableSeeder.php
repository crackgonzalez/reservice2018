<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->insert([
        	'name' => 'Banco Estado',
        	'created_at' =>today(),
        	'updated_at' =>today(),
        ]);
        DB::table('banks')->insert([
        	'name' => 'Banco Santander',
        	'created_at' =>today(),
        	'updated_at' =>today(),
        ]);
        DB::table('banks')->insert([
        	'name' => 'Banco BCI',
        	'created_at' =>today(),
        	'updated_at' =>today(),
        ]);
        DB::table('banks')->insert([
        	'name' => 'Banco Falabella',
        	'created_at' =>today(),
        	'updated_at' =>today(),
        ]);
    }
}
