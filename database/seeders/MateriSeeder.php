<?php

namespace Database\Seeders;

use App\Models\Materi;
use Illuminate\Database\Seeder;

class MateriSeeder extends Seeder
{
    public function run(): void
    {
        Materi::create([
            'judul_materi' => 'Pengenalan Sistem Informasi',
            'deskripsi' => 'Materi ini membahas konsep dasar sistem informasi dalam lingkungan akademik.',
            'file_materi' => null,
            'mata_pelajaran_id' => 1,
            'guru_id' => 1,
        ]);

        Materi::create([
            'judul_materi' => 'Dasar Pemrograman Web',
            'deskripsi' => 'Materi ini menjelaskan dasar HTML, CSS, PHP, dan Laravel.',
            'file_materi' => null,
            'mata_pelajaran_id' => 1,
            'guru_id' => 1,
        ]);
    }
}