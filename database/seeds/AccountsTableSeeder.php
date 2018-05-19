<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
        	'profile' => 'Administrador',
        	'created_at' =>today(),
        	'updated_at' =>today(),
        ]);
        DB::table('accounts')->insert([
        	'profile' => 'Trabajador',
        	'created_at' =>today(),
        	'updated_at' =>today(),
        ]);
        DB::table('accounts')->insert([
        	'profile' => 'Empresa',
        	'created_at' =>today(),
        	'updated_at' =>today(),
        ]);
        DB::table('accounts')->insert([
        	'profile' => 'Cliente',
        	'created_at' =>today(),
        	'updated_at' =>today(),
        ]);
    }
}
