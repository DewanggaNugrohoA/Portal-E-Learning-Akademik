@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page">
    <div class="container">

        <!-- HERO -->
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

        <!-- STAT -->
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

        <!-- PANEL -->
        <div class="dashboard-panel">

            <div class="dashboard-toolbar">
                <div>
                    <h2>Menu Modul Sistem</h2>

                    <p>
                        Pilih modul untuk mengelola data akademik sesuai pembagian tugas anggota.
                    </p>
                </div>
            </div>

            <!-- MENU -->
            <div class="module-grid">

                <!-- SISWA -->
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

                <!-- GURU -->
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

                <!-- MAPEL -->
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

                <!-- MATERI -->
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

                <!-- NILAI -->
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

.dashboard-hero{
    background: linear-gradient(135deg,#1e3a8a,#1d4ed8);
    border-radius:28px;
    padding:35px;
    color:white;
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:24px;
}

.hero-badge{
    background:rgba(255,255,255,.15);
    padding:8px 14px;
    border-radius:999px;
    display:inline-flex;
    gap:8px;
    align-items:center;
    margin-bottom:18px;
    font-size:13px;
    font-weight:700;
}

.dashboard-hero h1{
    margin:0;
    font-size:38px;
    font-weight:800;
}

.dashboard-hero p{
    margin-top:14px;
    line-height:1.7;
    max-width:760px;
}

.hero-icon{
    width:100px;
    height:100px;
    border-radius:28px;
    background:rgba(255,255,255,.12);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:42px;
}

.dashboard-stats{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:18px;
    margin-bottom:24px;
}

.dashboard-stat-card{
    background:white;
    border-radius:22px;
    padding:24px;
    display:flex;
    align-items:center;
    gap:16px;
}

.stat-icon{
    width:55px;
    height:55px;
    border-radius:18px;
    background:#eff6ff;
    color:#1e3a8a;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
}

.dashboard-stat-card span{
    color:#64748b;
    font-size:14px;
}

.dashboard-stat-card h2{
    margin:6px 0 0;
    color:#1e3a8a;
}

.dashboard-panel{
    background:white;
    border-radius:24px;
    padding:26px;
}

.dashboard-toolbar h2{
    margin:0;
    font-size:30px;
}

.dashboard-toolbar p{
    margin-top:8px;
    color:#64748b;
}

.module-grid{
    margin-top:24px;
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:18px;
}

.module-card{
    background:#f8fbff;
    border:1px solid #dbeafe;
    border-radius:22px;
    padding:22px;
    display:flex;
    align-items:center;
    gap:18px;
    text-decoration:none;
    color:inherit;
    transition:.2s;
}

.module-card:hover{
    transform:translateY(-4px);
    border-color:#1d4ed8;
    box-shadow:0 12px 24px rgba(0,0,0,.08);
}

.module-icon{
    width:60px;
    height:60px;
    border-radius:18px;
    background:#1e3a8a;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
}

.module-content{
    flex:1;
}

.module-content h3{
    margin:0;
    color:#1e3a8a;
    font-size:25px;
}

.module-content p{
    margin-top:8px;
    color:#64748b;
}

.module-arrow{
    color:#1e3a8a;
    opacity:.6;
}

@media(max-width:900px){

    .dashboard-stats,
    .module-grid{
        grid-template-columns:1fr;
    }

    .dashboard-hero{
        flex-direction:column;
        align-items:flex-start;
    }

}

</style>
@endsection