<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name' => 'Cristian Gonzalez',
        	'rut' => '16.74.0850-8',
        	'email' => 'cs.gonzalez3@gmail.com',
        	'password' => bcrypt('123456'),
        	'validation' => 0,
        	'state' => 1,
        	'account_id' => 1,
        	'created_at' =>today(),
        	'updated_at' =>today(),
        ]);
    }
}
