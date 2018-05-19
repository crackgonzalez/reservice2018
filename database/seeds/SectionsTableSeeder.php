<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
        	'section' => 'Mañana',
        	'created_at' =>today(),
        	'updated_at' =>today(),
        ]);
        DB::table('sections')->insert([
        	'section' => 'Tarde',
        	'created_at' =>today(),
        	'updated_at' =>today(),
        ]);
        DB::table('sections')->insert([
        	'section' => 'Noche',
        	'created_at' =>today(),
        	'updated_at' =>today(),
        ]);
    }
}
