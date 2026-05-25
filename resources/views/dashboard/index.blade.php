@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page">
    <div class="container">
        <div class="header">
            <h1>Dashboard Portal E-Learning Akademik</h1>
            <p>
                Dashboard ini digunakan sebagai halaman utama untuk mengakses seluruh modul sistem,
                seperti data siswa, guru, mata pelajaran, materi pembelajaran, dan nilai.
            </p>
        </div>

        <div class="dashboard-grid">
            <a href="{{ url('/siswa') }}" class="dashboard-card">
                <i class="fa-solid fa-user-graduate"></i>
                <h3>Data Siswa</h3>
                <p>Modul pengelolaan data siswa pada sistem akademik.</p>
            </a>

            <a href="{{ url('/guru') }}" class="dashboard-card">
                <i class="fa-solid fa-chalkboard-user"></i>
                <h3>Data Guru</h3>
                <p>Modul pengelolaan data guru dan informasi pengajar.</p>
            </a>

            <a href="{{ url('/mata-pelajaran') }}" class="dashboard-card">
                <i class="fa-solid fa-book-open"></i>
                <h3>Mata Pelajaran</h3>
                <p>Modul pengelolaan daftar mata pelajaran akademik.</p>
            </a>

            <a href="{{ url('/materi') }}" class="dashboard-card">
                <i class="fa-solid fa-book"></i>
                <h3>Materi</h3>
                <p>Modul pengelolaan materi pembelajaran dan file materi.</p>
            </a>
        </div>

        <div class="stat-grid">
            <div class="stat-card">
                <span>Status Sistem</span>
                <h2>Aktif</h2>
            </div>

            <div class="stat-card">
                <span>Framework</span>
                <h2>Laravel</h2>
            </div>

            <div class="stat-card">
                <span>Modul Utama</span>
                <h2>E-Learning</h2>
            </div>
        </div>

        <div class="panel">
            <div class="toolbar">
                <div>
                    <h2 style="margin:0;">Informasi Project</h2>
                    <p style="margin:6px 0 0; color:#64748b;">
                        Sistem ini dikembangkan untuk mendukung pengelolaan aktivitas pembelajaran akademik berbasis web.
                    </p>
                </div>

                <a href="{{ url('/materi') }}" class="btn btn-primary">
                    <i class="fa-solid fa-arrow-right"></i>
                    Masuk ke Modul Materi
                </a>
            </div>

            <div class="info-box">
                Bagian dashboard, navbar, sidebar, dan layout utama digunakan sebagai tampilan dasar sistem.
            </div>
        </div>
    </div>
</div>
@endsection