<?php

namespace Database\Seeders;

use App\Models\Piutang;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PiutangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Piutang::create([
            'penanggung_piutang' => 'PT. BENTENG TEGUH PERKASA',
            'users_id' => 2,
            'id_jenis' => 1,
            'umur_piutang' => '8 Tahun',
            'pokok' => 250000,
            'tgl_piutang' => Carbon::now(),
        ]);
        
        Piutang::create([
            'penanggung_piutang' => 'Rs. Medika Central',
            'users_id' => 2,
            'id_jenis' => 3,
            'umur_piutang' => '7 Tahun',
            'pokok' => 250000,
            'tgl_piutang' => Carbon::now(),
        ]);

        Piutang::create([
            'penanggung_piutang' => 'Rs. Gunung Jati',
            'users_id' => 3,
            'id_jenis' => 1,
            'umur_piutang' => '3 Tahun',
            'pokok' => 250000,
            'tgl_piutang' => Carbon::now(),
        ]);
    }
}
