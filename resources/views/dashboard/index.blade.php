@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page">
    <div class="container">
        <div class="dashboard-hero">
            <div>
                <span class="hero-badge">
                    <i class="fa-solid fa-layer-group"></i>
                    Portal Akademik
                </span>

                <h1>Dashboard Portal E-Learning Akademik</h1>

                <p>
                    Dashboard ini digunakan sebagai halaman utama untuk mengakses seluruh modul sistem,
                    seperti data siswa, guru, mata pelajaran, materi pembelajaran, dan nilai.
                </p>
            </div>

            <div class="hero-icon">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
        </div>

        <div class="dashboard-stats">
            <div class="dashboard-stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-server"></i>
                </div>

                <div>
                    <span>Status Sistem</span>
                    <h2>Aktif</h2>
                </div>
            </div>

            <div class="dashboard-stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-code"></i>
                </div>

                <div>
                    <span>Framework</span>
                    <h2>Laravel</h2>
                </div>
            </div>

            <div class="dashboard-stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-cloud"></i>
                </div>

                <div>
                    <span>Basis Sistem</span>
                    <h2>RESTful API</h2>
                </div>
            </div>
        </div>

        <div class="dashboard-panel">
            <div class="dashboard-toolbar">
                <div>
                    <h2>Menu Modul Sistem</h2>
                    <p>
                        Pilih modul untuk mengelola data akademik sesuai pembagian tugas anggota.
                    </p>
                </div>
            </div>

            <div class="module-grid">
                <a href="/siswa" class="module-card">
                    <div class="module-icon">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>

                    <div class="module-content">
                        <h3>Data Siswa</h3>
                        <p>Modul pengelolaan data siswa pada sistem akademik.</p>
                    </div>

                    <i class="fa-solid fa-arrow-right module-arrow"></i>
                </a>

                <a href="/guru" class="module-card">
                    <div class="module-icon">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>

                    <div class="module-content">
                        <h3>Data Guru</h3>
                        <p>Modul pengelolaan data guru dan informasi pengajar.</p>
                    </div>

                    <i class="fa-solid fa-arrow-right module-arrow"></i>
                </a>

                <a href="/mata-pelajaran" class="module-card">
                    <div class="module-icon">
                        <i class="fa-solid fa-book-open"></i>
                    </div>

                    <div class="module-content">
                        <h3>Mata Pelajaran</h3>
                        <p>Modul pengelolaan daftar mata pelajaran akademik.</p>
                    </div>

                    <i class="fa-solid fa-arrow-right module-arrow"></i>
                </a>

                <a href="/materi" class="module-card">
                    <div class="module-icon">
                        <i class="fa-solid fa-book"></i>
                    </div>

                    <div class="module-content">
                        <h3>Materi</h3>
                        <p>Modul pengelolaan materi pembelajaran berbasis API.</p>
                    </div>

                    <i class="fa-solid fa-arrow-right module-arrow"></i>
                </a>

                <a href="/nilai" class="module-card">
                    <div class="module-icon">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>

                    <div class="module-content">
                        <h3>Nilai</h3>
                        <p>Modul pengelolaan data nilai siswa.</p>
                    </div>

                    <i class="fa-solid fa-arrow-right module-arrow"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .dashboard-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #2447a3 55%, #172554 100%);
        color: white;
        border-radius: 28px;
        padding: 34px 38px;
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 24px;
        box-shadow: 0 20px 45px rgba(30, 58, 138, 0.22);
        overflow: hidden;
        position: relative;
    }

    .dashboard-hero::after {
        content: "";
        position: absolute;
        width: 240px;
        height: 240px;
        right: -60px;
        top: -80px;
        background: rgba(255, 255, 255, 0.10);
        border-radius: 50%;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.18);
        color: white;
        padding: 9px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .dashboard-hero h1 {
        margin: 0;
        font-size: 36px;
        line-height: 1.2;
        font-weight: 800;
        max-width: 850px;
    }

    .dashboard-hero p {
        margin: 14px 0 0;
        max-width: 900px;
        font-size: 16px;
        line-height: 1.8;
        opacity: 0.92;
    }

    .hero-icon {
        width: 96px;
        height: 96px;
        border-radius: 30px;
        background: rgba(255, 255, 255, 0.16);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 42px;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
    }

    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 24px;
    }

    .dashboard-stat-card {
        background: white;
        border: 1px solid #e5eaf3;
        border-radius: 22px;
        padding: 22px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.07);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        background: #eff6ff;
        color: #1e3a8a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        flex-shrink: 0;
    }

    .dashboard-stat-card span {
        display: block;
        color: #64748b;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .dashboard-stat-card h2 {
        margin: 0;
        color: #1e3a8a;
        font-size: 25px;
        line-height: 1.2;
    }

    .dashboard-panel {
        background: white;
        border: 1px solid #e5eaf3;
        border-radius: 24px;
        padding: 26px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.07);
        margin-bottom: 24px;
    }

    .dashboard-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 18px;
        flex-wrap: wrap;
        margin-bottom: 22px;
    }

    .dashboard-toolbar h2 {
        margin: 0;
        font-size: 24px;
        color: #111827;
    }

    .dashboard-toolbar p {
        margin: 7px 0 0;
        color: #64748b;
        line-height: 1.6;
    }

    .module-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .module-card {
        background: #f8fbff;
        border: 1px solid #e5eaf3;
        border-radius: 20px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        color: #111827;
        text-decoration: none;
        transition: 0.2s ease;
        position: relative;
        overflow: hidden;
    }

    .module-card:hover {
        transform: translateY(-3px);
        border-color: #1e3a8a;
        box-shadow: 0 18px 32px rgba(15, 23, 42, 0.10);
    }

    .module-card.active-module {
        background: #eff6ff;
        border-color: rgba(30, 58, 138, 0.35);
    }

    .module-icon {
        width: 54px;
        height: 54px;
        border-radius: 17px;
        background: #1e3a8a;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        flex-shrink: 0;
    }

    .module-content {
        flex: 1;
        min-width: 0;
    }

    .module-content h3 {
        margin: 0;
        color: #1e3a8a;
        font-size: 19px;
        font-weight: 800;
    }

    .module-content p {
        margin: 7px 0 0;
        color: #64748b;
        line-height: 1.5;
        font-size: 14px;
    }

    .module-arrow {
        color: #1e3a8a;
        opacity: 0.5;
        transition: 0.2s;
    }

    .module-card:hover .module-arrow {
        opacity: 1;
        transform: translateX(4px);
    }

    @media (max-width: 1100px) {
        .dashboard-hero {
            align-items: flex-start;
            flex-direction: column;
        }

        .hero-icon {
            display: none;
        }

        .dashboard-stats,
        .module-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .dashboard-hero {
            padding: 26px 22px;
        }

        .dashboard-hero h1 {
            font-size: 28px;
        }

        .dashboard-panel {
            padding: 20px;
        }
    }
</style>
@endsection