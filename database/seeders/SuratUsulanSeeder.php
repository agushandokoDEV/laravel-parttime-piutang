<?php

namespace Database\Seeders;

use App\Models\SuratUsulan;
use Illuminate\Database\Seeder;

class SuratUsulanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SuratUsulan::create([
            'users_id' => 2,
            'id_jenis' => 1,
            'no_skrd' => '405947/078.612',
            'nama_peminjam' => 'PT.BENTENG TEGUH PERKASA',
            'rincian' => 'Hutang Daerah',
            'tgl_surat' => '2009-04-24',
            'denda' => 50000.00,
            'nilai_rincian' => 45000000.00,
            'total_rincian' => 45000000.00,
        ]);

        SuratUsulan::create([
            'users_id' => 2,
            'id_jenis' => 1,
            'no_skrd' => '405948/078.612',
            'nama_peminjam' => 'PT.BENTENG TEGUH PERKASA',
            'rincian' => 'Hutang Daerah',
            'tgl_surat' => '2009-04-24',
            'denda' => 50000.00,
            'nilai_rincian' => 301000.00,
            'total_rincian' => 301000.00,
        ]);

        SuratUsulan::create([
            'users_id' => 2,
            'id_jenis' => 1,
            'no_skrd' => '1121/-1.725.1',
            'nama_peminjam' => 'RS.Islam',
            'rincian' => 'Hutang Rumah Sakit',
            'tgl_surat' => '2008-12-25',
            'denda' => 50000.00,
            'nilai_rincian' => 37189900.00,
            'total_rincian' => 37189900.00,
        ]);

        SuratUsulan::create([
            'users_id' => 2,
            'id_jenis' => 1,
            'no_skrd' => '1086/1.725.1',
            'nama_peminjam' => 'PT. PHILINDO SPORTING AMUS',
            'rincian' => 'Hutang PT',
            'tgl_surat' => '2008-12-25',
            'denda' => 50000.00,
            'nilai_rincian' => 49985000.00,
            'total_rincian' => 49985000.00,
        ]);

        SuratUsulan::create([
            'users_id' => 2,
            'id_jenis' => 1,
            'no_skrd' => '008743/-078.612',
            'nama_peminjam' => 'PT Sahid Inti Dinamika',
            'rincian' => 'Hutang PT',
            'tgl_surat' => '2010-12-25',
            'denda' => 50000.00,
            'nilai_rincian' => 1649000.00,
            'total_rincian' => 1649000.00,
        ]);

        SuratUsulan::create([
            'users_id' => 2,
            'id_jenis' => 1,
            'no_skrd' => '008744/-078.612',
            'nama_peminjam' => 'PT Sahid Inti Dinamika',
            'rincian' => 'Hutang PT',
            'tgl_surat' => '2010-12-25',
            'denda' => 50000.00,
            'nilai_rincian' => 9323900.00,
            'total_rincian' => 9323900.00,
        ]);
    }
}
