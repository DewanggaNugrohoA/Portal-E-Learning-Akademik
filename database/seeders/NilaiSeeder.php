<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nilai;
use App\Models\Guru;

class NilaiSeeder extends Seeder
{
    public function run(): void
    {
        $guru = Guru::first();

        if ($guru) {
            Nilai::create([
                "guru_id" => $guru->id,
                "kkm" => 75,
                "deskripsi_a" => "Sangat Baik",
                "deskripsi_b" => "Baik",
                "deskripsi_c" => "Cukup",
                "deskripsi_d" => "Kurang Baik",
            ]);
        }
    }
}
