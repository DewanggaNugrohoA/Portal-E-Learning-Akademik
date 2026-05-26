@extends('layouts.app')

@section('content')

<div style="max-width: 850px; margin:40px auto;">

    <div style="
        background:#1e3a8a;
        color:white;
        padding:30px;
        border-radius:20px;
        margin-bottom:25px;
    ">
        <h1 style="margin:0; font-size:36px;">
            Detail Mata Pelajaran
        </h1>

        <p style="margin-top:10px;">
            Informasi lengkap data mata pelajaran.
        </p>
    </div>

    <div style="
        background:white;
        padding:30px;
        border-radius:20px;
        box-shadow:0 10px 25px rgba(0,0,0,0.08);
    ">

        <div style="margin-bottom:20px;">
            <label style="font-weight:bold;">Kode Mapel</label>

            <div style="
                margin-top:8px;
                padding:12px;
                background:#f1f5f9;
                border-radius:10px;
            ">
                {{ $data->kode_mapel }}
            </div>
        </div>

        <div style="margin-bottom:20px;">
            <label style="font-weight:bold;">Nama Mata Pelajaran</label>

            <div style="
                margin-top:8px;
                padding:12px;
                background:#f1f5f9;
                border-radius:10px;
            ">
                {{ $data->nama_mapel }}
            </div>
        </div>

        <div style="margin-bottom:20px;">
            <label style="font-weight:bold;">Guru Pengampu</label>

            <div style="
                margin-top:8px;
                padding:12px;
                background:#f1f5f9;
                border-radius:10px;
            ">
                {{ $data->guru_pengampu }}
            </div>
        </div>

        <div style="margin-bottom:20px;">
            <label style="font-weight:bold;">Jumlah Jam</label>

            <div style="
                margin-top:8px;
                padding:12px;
                background:#f1f5f9;
                border-radius:10px;
            ">
                {{ $data->jumlah_jam }}
            </div>
        </div>

        <div style="text-align:right;">

            <a href="{{ route('mata-pelajaran.index') }}"
               style="
                    background:#1e3a8a;
                    color:white;
                    padding:10px 18px;
                    border-radius:10px;
                    text-decoration:none;
               ">
                Kembali
            </a>

        </div>

    </div>

</div>

@endsection