@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
<div class="page">
    <div class="container-small">
        <div class="header">
            <h1>Detail Data Siswa</h1>
            <p>Detail siswa ditampilkan menggunakan API endpoint /api/siswa/{{ $id }}.</p>
        </div>

        <div class="profile-card" id="detailSiswa">
            <p>Memuat data siswa...</p>
        </div>

        <div class="actions">
            <a href="{{ url('/siswa') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a>

            <a href="{{ url('/siswa/' . $id . '/edit') }}" class="btn btn-primary">
                <i class="fa-solid fa-pen"></i>
                Edit Siswa
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const siswaId = "{{ $id }}";
    const detailSiswa = document.getElementById('detailSiswa');

    async function loadDetailSiswa() {
        try {
            const response = await fetch(`/api/siswa/${siswaId}`, {
                headers: { 'Accept': 'application/json' }
            });

            const result = await response.json();

            if (!response.ok) {
                detailSiswa.innerHTML = `<p>Data siswa tidak ditemukan.</p>`;
                return;
            }

            const siswa = result.data;

            detailSiswa.innerHTML = `
                <div class="profile-top">
                    <div class="detail-avatar">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>

                    <div class="profile-info">
                        <h2>${siswa.nama ?? '-'}</h2>
                        <p>${siswa.nis ?? '-'} • ${siswa.kelas ?? '-'}</p>
                    </div>
                </div>

                <div class="content-grid">
                    <div class="section">
                        <h3>Informasi Siswa</h3>

                        <div class="data-grid">
                            <div class="data-item">
                                <div class="label">NIS</div>
                                <div class="value">${siswa.nis ?? '-'}</div>
                            </div>

                            <div class="data-item">
                                <div class="label">Nama</div>
                                <div class="value">${siswa.nama ?? '-'}</div>
                            </div>

                            <div class="data-item">
                                <div class="label">Email</div>
                                <div class="value">${siswa.email ?? '-'}</div>
                            </div>

                            <div class="data-item">
                                <div class="label">Kelas</div>
                                <div class="value">${siswa.kelas ?? '-'}</div>
                            </div>

                            <div class="data-item">
                                <div class="label">Jenis Kelamin</div>
                                <div class="value">${siswa.jenis_kelamin ?? '-'}</div>
                            </div>

                            <div class="data-item">
                                <div class="label">Tanggal Lahir</div>
                                <div class="value">${siswa.tanggal_lahir ?? '-'}</div>
                            </div>

                            <div class="data-item">
                                <div class="label">No HP</div>
                                <div class="value">${siswa.no_hp ?? '-'}</div>
                            </div>

                            <div class="data-item">
                                <div class="label">Status</div>
                                <div class="value">${siswa.status ?? '-'}</div>
                            </div>

                            <div class="data-item full">
                                <div class="label">Alamat</div>
                                <div class="value">${siswa.alamat ?? '-'}</div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        } catch (error) {
            detailSiswa.innerHTML = `<p>Gagal memuat detail siswa.</p>`;
        }
    }

    loadDetailSiswa();
</script>
@endsection