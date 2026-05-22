<?php

namespace Database\Seeders;
use app\Models\Guru;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Guru::create([
            'nama' => 'Adel',
            'nip' => '12345',
            'email' => 'adel@gmail.com',
            'no_hp' => '0867980965',
            'alamat' => 'Bengkulu',
            'mata_pelajaran' => 'Matematika',
        ]);
    }
}
