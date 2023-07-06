<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(JenisPiutangSeeder::class);
        // $this->call(PiutangSeeder::class);
        $this->call(SuratUsulanSeeder::class);
    }
}
