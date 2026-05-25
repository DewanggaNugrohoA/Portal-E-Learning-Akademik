<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        Siswa::create([
            'nis' => '230001',
            'nama' => 'Sevi Rina Pertiwi',
            'email' => 'sevi@gmail.com',
            'kelas' => 'X IPA 1',
            'jenis_kelamin' => 'Perempuan',
            'tanggal_lahir' => '2007-05-12',
            'no_hp' => '081234567890',
            'alamat' => 'Bengkulu',
            'status' => 'Aktif',
        ]);

        Siswa::create([
            'nis' => '230002',
            'nama' => 'Aulia Rahma',
            'email' => 'aulia@gmail.com',
            'kelas' => 'X IPA 2',
            'jenis_kelamin' => 'Perempuan',
            'tanggal_lahir' => '2007-08-21',
            'no_hp' => '082345678901',
            'alamat' => 'Bengkulu',
            'status' => 'Aktif',
        ]);

        Siswa::create([
            'nis' => '230003',
            'nama' => 'Rizky Pratama',
            'email' => 'rizky@gmail.com',
            'kelas' => 'XI IPS 1',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '2006-11-03',
            'no_hp' => '083456789012',
            'alamat' => 'Bengkulu',
            'status' => 'Aktif',
        ]);
    }
}