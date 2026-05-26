<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $dataSiswa = [
            [
                'nis' => '240101',
                'nama' => 'Nabila Putri Azzahra',
                'email' => 'nabila.putri@gmail.com',
                'kelas' => 'X RPL 1',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '2008-02-14',
                'no_hp' => '081245671001',
                'alamat' => 'Bandung',
                'status' => 'Aktif',
            ],
            [
                'nis' => '240102',
                'nama' => 'Fajar Maulana',
                'email' => 'fajar.maulana@gmail.com',
                'kelas' => 'X RPL 2',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '2008-06-22',
                'no_hp' => '081245671002',
                'alamat' => 'Jakarta',
                'status' => 'Aktif',
            ],
            [
                'nis' => '240103',
                'nama' => 'Salsa Amalia',
                'email' => 'salsa.amalia@gmail.com',
                'kelas' => 'XI TKJ 1',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '2007-09-10',
                'no_hp' => '081245671003',
                'alamat' => 'Surabaya',
                'status' => 'Aktif',
            ],
            [
                'nis' => '240104',
                'nama' => 'Rangga Saputra',
                'email' => 'rangga.saputra@gmail.com',
                'kelas' => 'XI TKJ 2',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '2007-12-05',
                'no_hp' => '081245671004',
                'alamat' => 'Yogyakarta',
                'status' => 'Tidak Aktif',
            ],
        ];

        foreach ($dataSiswa as $siswa) {
            Siswa::updateOrCreate(
                ['nis' => $siswa['nis']],
                $siswa
            );
        }
    }
}