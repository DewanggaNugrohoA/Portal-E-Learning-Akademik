@extends('layouts.app')

@section('title', 'Detail Guru')

@section('content')

<style>
    .detail-container{
        padding: 30px;
    }

    .detail-header{
        background: #243c96;
        color: white;
        padding: 35px;
        border-radius: 30px;
        margin-bottom: 25px;
    }

    .detail-header h1{
        font-size: 42px;
        margin-bottom: 10px;
    }

    .detail-header p{
        font-size: 18px;
        opacity: .9;
    }

    .profile-card{
        background: white;
        border-radius: 30px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,.05);
    }

    .profile-top{
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
    }

    .profile-icon{
        width: 90px;
        height: 90px;
        border-radius: 25px;
        background: #243c96;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 35px;
    }

    .profile-name{
        font-size: 38px;
        font-weight: bold;
        color: #0f172a;
    }

    .profile-email{
        color: #64748b;
        margin-top: 5px;
        font-size: 17px;
    }

    .badge-group{
        display: flex;
        gap: 15px;
        margin-top: 15px;
    }

    .badge{
        background: #eef2ff;
        color: #243c96;
        padding: 10px 18px;
        border-radius: 12px;
        font-weight: 600;
    }

    .info-box{
        margin-top: 25px;
        border: 1px solid #e2e8f0;
        border-radius: 25px;
        padding: 25px;
    }

    .info-title{
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 25px;
        color: #0f172a;
    }

    .info-grid{
        display: grid;
        grid-template-columns: repeat(2,1fr);
        gap: 20px;
    }

    .info-item{
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 20px;
    }

    .info-item span{
        display: block;
        color: #64748b;
        font-size: 15px;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .info-item h3{
        margin: 0;
        color: #0f172a;
        font-size: 22px;
    }

    .button-group{
        display: flex;
        justify-content: end;
        gap: 15px;
        margin-top: 30px;
    }

    .btn{
        padding: 14px 24px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-back{
        background: #e2e8f0;
        color: #0f172a;
    }

    .btn-edit{
        background: #243c96;
        color: white;
    }
</style>

<div class="detail-container">

    <div class="detail-header">
        <h1>Detail Data Guru</h1>
        <p>Informasi lengkap data guru Portal E-Learning Akademik.</p>
    </div>

    <div class="profile-card">

        <div class="profile-top">
            <div class="profile-icon">
                <i class="fa-solid fa-user-tie"></i>
            </div>

            <div>
                <div class="profile-name">
                    {{ $guru->nama }}
                </div>

                <div class="profile-email">
                    {{ $guru->email }}
                </div>

                <div class="badge-group">
                    <div class="badge">
                        {{ $guru->nip }}
                    </div>

                    <div class="badge">
                        {{ $guru->mapel ?? $guru->mata_pelajaran }}
                    </div>
                </div>
            </div>
        </div>

        <div class="info-box">

            <div class="info-title">
                Informasi Guru
            </div>

            <div class="info-grid">

                <div class="info-item">
                    <span>Nama Guru</span>
                    <h3>{{ $guru->nama }}</h3>
                </div>

                <div class="info-item">
                    <span>NIP</span>
                    <h3>{{ $guru->nip }}</h3>
                </div>

                <div class="info-item">
                    <span>Email</span>
                    <h3>{{ $guru->email }}</h3>
                </div>

                <div class="info-item">
                    <span>No HP</span>
                    <h3>{{ $guru->no_hp }}</h3>
                </div>

                <div class="info-item">
                    <span>Mata Pelajaran</span>
                    <h3>{{ $guru->mapel ?? $guru->mata_pelajaran }}</h3>
                </div>

                <div class="info-item">
                    <span>Alamat</span>
                    <h3>{{ $guru->alamat }}</h3>
                </div>

            </div>

        </div>

        <div class="button-group">

            <a href="/guru" class="btn btn-back">
                ← Kembali
            </a>

            <a href="/guru/{{ $guru->id }}/edit" class="btn btn-edit">
                ✏ Edit Guru
            </a>

        </div>

    </div>

</div>

@endsection