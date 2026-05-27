@extends('layouts.app')

@section('title', 'Detail Mata Pelajaran')

@section('content')
<div class="page">
    <div class="container-small">
        <div class="header">
            <h1>Detail Data Mata Pelajaran</h1>
            <p>Detail mata pelajaran ditampilkan menggunakan API endpoint /api/mata-pelajaran/{{ $id }}.</p>
        </div>

        <div class="profile-card" id="detailMataPelajaran">
            <p>Memuat data mata pelajaran...</p>
        </div>

        <div class="actions">
            <a href="{{ url('/mata-pelajaran') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a>

            <a href="{{ url('/mata-pelajaran/' . $id . '/edit') }}" class="btn btn-primary">
                <i class="fa-solid fa-pen"></i>
                Edit Mata Pelajaran
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const mataPelajaranId = "{{ $id }}";
    const detailMataPelajaran = document.getElementById('detailMataPelajaran');

    async function loadDetailMataPelajaran() {
        try {
            const response = await fetch(`/api/mata-pelajaran/${mataPelajaranId}`, {
                headers: { 'Accept': 'application/json' }
            });

            const result = await response.json();

            if (!response.ok) {
                detailMataPelajaran.innerHTML = `<p>Data mata pelajaran tidak ditemukan.</p>`;
                return;
            }

            const mapel = result.data;

            detailMataPelajaran.innerHTML = `
                <div class="profile-top">
                    <div class="detail-avatar">
                        <i class="fa-solid fa-book"></i>
                    </div>

                    <div class="profile-info">
                        <h2>${mapel.nama_mata_pelajaran ?? '-'}</h2>
                        <p>${mapel.kode_mata_pelajaran ?? '-'} • ${mapel.semester ?? '-'}</p>
                    </div>
                </div>

                <div class="content-grid">
                    <div class="section">
                        <h3>Informasi Mata Pelajaran</h3>

                        <div class="data-grid">
                            <div class="data-item">
                                <div class="label">Kode Mata Pelajaran</div>
                                <div class="value">${mapel.kode_mata_pelajaran ?? '-'}</div>
                            </div>

                            <div class="data-item">
                                <div class="label">Nama Mata Pelajaran</div>
                                <div class="value">${mapel.nama_mata_pelajaran ?? '-'}</div>
                            </div>

                            <div class="data-item">
                                <div class="label">Guru Pengampu</div>
                                <div class="value">${mapel.guru_pengampu ?? '-'}</div>
                            </div>

                            <div class="data-item">
                                <div class="label">Jam Pelajaran</div>
                                <div class="value">${mapel.jam_pelajaran ?? '-'}</div>
                            </div>

                            <div class="data-item">
                                <div class="label">Semester</div>
                                <div class="value">${mapel.semester ?? '-'}</div>
                            </div>

                            <div class="data-item">
                                <div class="label">Status</div>
                                <div class="value">${mapel.status ?? '-'}</div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        } catch (error) {
            detailMataPelajaran.innerHTML = `<p>Gagal memuat detail mata pelajaran.</p>`;
        }
    }

    loadDetailMataPelajaran();
</script>
@endsection