<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
    GuruSeeder::class,
]);
        Guru::create([
            'nama' => 'Budi Santoso',
            'nip' => '1987654321',
            'email' => 'budi@gmail.com',
            'no_hp' => '081234567890',
            'alamat' => 'Bengkulu',
            'mapel' => 'Matematika',
        ]);

        Guru::create([
            'nama' => 'Adellia',
            'nip' => '1987654322',
            'email' => 'adelia@gmail.com',
            'no_hp' => '081234567891',
            'alamat' => 'Bengkulu',
            'mapel' => 'Informatika',
        ]);
    }
}