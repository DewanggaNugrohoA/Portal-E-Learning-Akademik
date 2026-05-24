<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;

class MataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        MataPelajaran::create([
            'kode_mapel' => 'MTK',
            'nama_mapel' => 'Matematika',
            'guru_pengampu' => 'Bu Sari',
            'jumlah_jam' => 4,
        ]);

        MataPelajaran::create([
            'kode_mapel' => 'PWEB',
            'nama_mapel' => 'Pemrograman Web',
            'guru_pengampu' => 'Pak Andi',
            'jumlah_jam' => 3,
        ]);

        MataPelajaran::create([
            'kode_mapel' => 'BIND',
            'nama_mapel' => 'Bahasa Indonesia',
            'guru_pengampu' => 'Bu Rina',
            'jumlah_jam' => 2,
        ]);
    }
}