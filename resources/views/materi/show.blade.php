@extends('layouts.app')

@section('title', 'Detail Materi')

@section('content')
<div class="page">
    <div class="container-small">
        <div class="header">
            <h1>Detail Materi Pembelajaran</h1>
            <p>Halaman ini menampilkan detail data materi pembelajaran.</p>
        </div>

        <div class="profile-card">
            <div class="profile-top">
                <div class="detail-avatar">
                    <i class="fa-solid fa-book"></i>
                </div>

                <div class="profile-info">
                    <h2>{{ $materi->judul_materi }}</h2>
                    <p>{{ $materi->nama_mata_pelajaran ?? 'Mata pelajaran belum diisi' }}</p>

                    <div class="badge-row">
                        <span class="badge badge-blue">
                            {{ $materi->nama_guru ?? 'Guru belum diisi' }}
                        </span>

                        <span class="badge badge-green">
                            {{ $materi->created_at ? $materi->created_at->format('d-m-Y H:i') : '-' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-grid">
            <div class="section">
                <h3>Informasi Materi</h3>

                <div class="data-grid">
                    <div class="data-item">
                        <div class="label">Judul Materi</div>
                        <div class="value">{{ $materi->judul_materi }}</div>
                    </div>

                    <div class="data-item">
                        <div class="label">Mata Pelajaran</div>
                        <div class="value">{{ $materi->nama_mata_pelajaran ?? '-' }}</div>
                    </div>

                    <div class="data-item">
                        <div class="label">Nama Guru</div>
                        <div class="value">{{ $materi->nama_guru ?? '-' }}</div>
                    </div>

                    <div class="data-item">
                        <div class="label">File Materi</div>
                        <div class="value">
                            @if ($materi->file_materi)
                                <a href="{{ asset('assets/uploads/materi/' . $materi->file_materi) }}" target="_blank">
                                    Download / Lihat File
                                </a>
                            @else
                                Tidak ada file
                            @endif
                        </div>
                    </div>

                    <div class="data-item full">
                        <div class="label">Deskripsi</div>
                        <div class="value">{{ $materi->deskripsi ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <div class="section">
                <h3>Ringkasan</h3>

                <div class="summary-list">
                    <div class="summary-item">
                        <span>ID Materi</span>
                        <strong>{{ $materi->id }}</strong>
                    </div>

                    <div class="summary-item">
                        <span>Dibuat Pada</span>
                        <strong>{{ $materi->created_at ? $materi->created_at->format('d-m-Y') : '-' }}</strong>
                    </div>

                    <div class="summary-item">
                        <span>Diperbarui Pada</span>
                        <strong>{{ $materi->updated_at ? $materi->updated_at->format('d-m-Y') : '-' }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="actions">
            <a href="{{ url('/materi') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a>

            <a href="{{ route('materi.edit', $materi->id) }}" class="btn btn-primary">
                <i class="fa-solid fa-pen"></i>
                Edit Materi
            </a>
        </div>
    </div>
</div>
@endsection