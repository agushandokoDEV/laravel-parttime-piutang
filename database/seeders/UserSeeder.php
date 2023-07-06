<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        User::create([
            'name' => 'DINAS LINGKUNGAN HIDUP',
            'no_skpd' => '405947/078.800',
            'role' => 'nasabah',
            'email' => 'user1@gmail.com',
            // 'id_jenis' => 1, // relasi dengan table jenis piutang -> Sedder = JenisPiutang
            // 'umur_piutang' => '8 Tahun',
            // 'pokok' => 250000,
            // 'tgl_piutang' => Carbon::now(),
            'password' => Hash::make('12345678')
        ]);

        User::create([
            'name' => 'DPRD KOTA BANDUNG',
            'no_skpd' => '405947/078.802',
            'role' => 'nasabah',
            'email' => 'user2@gmail.com',
            // 'id_jenis' => 1, // relasi dengan table jenis piutang -> Sedder = JenisPiutang
            // 'umur_piutang' => '8 Tahun',
            // 'pokok' => 250000,
            // 'tgl_piutang' => Carbon::now(),
            'password' => Hash::make('12345678')
        ]);
    }
}
