@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
<div class="page">
    <div class="container">
        <div class="header">
            <h1>Data Siswa</h1>
            <p>Data siswa ditampilkan menggunakan API dari endpoint /api/siswa.</p>
        </div>

        <div class="stat-grid">
            <div class="stat-card">
                <span>Total Siswa</span>
                <h2 id="totalSiswa">0</h2>
            </div>

            <div class="stat-card">
                <span>Modul</span>
                <h2>Siswa</h2>
            </div>

            <div class="stat-card">
                <span>Penanggung Jawab</span>
                <h2>Sevi</h2>
            </div>
        </div>

        <div class="panel">
            <div class="toolbar">
                <div>
                    <h2 style="margin:0;">Daftar Siswa</h2>
                    <p style="margin:6px 0 0; color:#64748b;">
                        Kelola data siswa menggunakan API.
                    </p>
                </div>

                <a href="{{ url('/siswa/create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Siswa
                </a>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="siswaTable">
                        <tr>
                            <td colspan="8" class="empty">Memuat data siswa...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const siswaTable = document.getElementById('siswaTable');
    const totalSiswa = document.getElementById('totalSiswa');

    async function loadSiswa() {
        try {
            const response = await fetch('/api/siswa', {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();
            const data = result.data ?? [];

            siswaTable.innerHTML = '';
            totalSiswa.textContent = data.length;

            if (data.length === 0) {
                siswaTable.innerHTML = `
                    <tr>
                        <td colspan="8" class="empty">Belum ada data siswa.</td>
                    </tr>
                `;
                return;
            }

            data.forEach((siswa, index) => {
                const statusBadge = siswa.status === 'Aktif'
                    ? `<span class="badge badge-blue">Aktif</span>`
                    : `<span class="badge badge-red">Tidak Aktif</span>`;

                siswaTable.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${siswa.nis ?? '-'}</td>
                        <td><strong>${siswa.nama ?? '-'}</strong></td>
                        <td>${siswa.email ?? '-'}</td>
                        <td>${siswa.kelas ?? '-'}</td>
                        <td>${siswa.jenis_kelamin ?? '-'}</td>
                        <td>${statusBadge}</td>
                        <td>
                            <div class="action-group">
                                <a href="/siswa/${siswa.id}" class="btn btn-detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="/siswa/${siswa.id}/edit" class="btn btn-edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <button type="button" onclick="deleteSiswa(${siswa.id})" class="btn btn-delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });
        } catch (error) {
            siswaTable.innerHTML = `
                <tr>
                    <td colspan="8" class="empty">Gagal memuat data siswa.</td>
                </tr>
            `;
        }
    }

    async function deleteSiswa(id) {
        const konfirmasi = confirm('Yakin ingin menghapus data siswa ini?');

        if (!konfirmasi) {
            return;
        }

        try {
            const response = await fetch(`/api/siswa/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            alert(result.message);
            loadSiswa();
        } catch (error) {
            alert('Gagal menghapus data siswa.');
        }
    }

    loadSiswa();
</script>
@endsection