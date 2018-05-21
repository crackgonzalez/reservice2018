<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(BanksTableSeeder::class);
        $this->call(PlansTableSeeder::class);
        $this->call(CreditsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
