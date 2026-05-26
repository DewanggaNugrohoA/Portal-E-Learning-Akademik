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
            Tambah Mata Pelajaran
        </h1>

        <p style="margin-top:10px;">
            Masukkan data mata pelajaran baru untuk Portal E-Learning Akademik.
        </p>
    </div>

    <div style="
        background:white;
        padding:30px;
        border-radius:20px;
        box-shadow:0 10px 25px rgba(0,0,0,0.08);
    ">

        <form action="{{ route('mata-pelajaran.store') }}" method="POST">
            @csrf

            <div style="margin-bottom:20px;">
                <label style="display:block; margin-bottom:8px;">
                    Kode Mapel
                </label>

                <input type="text"
                       name="kode_mapel"
                       placeholder="Contoh: MTK"
                       style="
                            width:100%;
                            padding:12px;
                            border:1px solid #cbd5e1;
                            border-radius:10px;
                       ">
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block; margin-bottom:8px;">
                    Nama Mata Pelajaran
                </label>

                <input type="text"
                       name="nama_mapel"
                       placeholder="Contoh: Matematika"
                       style="
                            width:100%;
                            padding:12px;
                            border:1px solid #cbd5e1;
                            border-radius:10px;
                       ">
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block; margin-bottom:8px;">
                    Guru Pengampu
                </label>

                <input type="text"
                       name="guru_pengampu"
                       placeholder="Contoh: Bu Sari"
                       style="
                            width:100%;
                            padding:12px;
                            border:1px solid #cbd5e1;
                            border-radius:10px;
                       ">
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block; margin-bottom:8px;">
                    Jumlah Jam
                </label>

                <input type="text"
                       name="jumlah_jam"
                       placeholder="Contoh: 4"
                       style="
                            width:100%;
                            padding:12px;
                            border:1px solid #cbd5e1;
                            border-radius:10px;
                       ">
            </div>

            <div style="text-align:right;">

                <a href="{{ route('mata-pelajaran.index') }}"
                   style="
                        background:#e5e7eb;
                        color:#111827;
                        padding:10px 18px;
                        border-radius:10px;
                        text-decoration:none;
                        margin-right:10px;
                   ">
                    Kembali
                </a>

                <button type="submit"
                        style="
                            background:#1e3a8a;
                            color:white;
                            padding:10px 18px;
                            border:none;
                            border-radius:10px;
                            cursor:pointer;
                        ">
                    Simpan Data
                </button>

            </div>

        </form>

    </div>

</div>

@endsection