<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataPelajaran;

class MataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        MataPelajaran::create([
            'kode_mata_pelajaran' => 'K001',
            'nama_mata_pelajaran' => 'Pemrograman Web',
            'guru_pengampu' => 'Meida',
            'jam_pelajaran' => '1',
            'semester' => 'Ganjil',
            'status' => 'Aktif',
        ]);

        MataPelajaran::create([
            'kode_mata_pelajaran' => 'K002',
            'nama_mata_pelajaran' => 'Pemrograman Aplikasi',
            'guru_pengampu' => 'Meida Dina',
            'jam_pelajaran' => '4',
            'semester' => 'Genap',
            'status' => 'Tidak Aktif',
        ]);
    }
}