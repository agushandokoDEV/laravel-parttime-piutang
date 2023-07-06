<?php

namespace Database\Seeders;

use App\Models\JenisPiutang;
use Illuminate\Database\Seeder;

class JenisPiutangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisPiutang::create([
            'jenis' => 'Lain-lain Pendapatan Asli Daerah',
        ]);
    }
}
