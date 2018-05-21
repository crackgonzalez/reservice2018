<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreditsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('credits')->insert([
        	'description' => 'Basico',
        	'price' => 500,
        	'credit' => 5,
        	'style' => 'bg-success',
        	'created_at' =>today(),
        	'updated_at' =>today(),
        ]);
        DB::table('credits')->insert([
        	'description' => 'Intermedio',
        	'price' => 1000,
        	'credit' => 10,
        	'style' => 'bg-warning',
        	'created_at' =>today(),
        	'updated_at' =>today(),
        ]);
        DB::table('credits')->insert([
        	'description' => 'Avanzado',
        	'price' => 2000,
        	'credit' => 20,
        	'style' => 'bg-danger',
        	'created_at' =>today(),
        	'updated_at' =>today(),
        ]);
    }
}
