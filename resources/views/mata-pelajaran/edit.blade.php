@extends('layouts.app')

@section('content')

<div style="max-width: 900px; margin:40px auto;">

    <div style="
        background:#1e3a8a;
        color:white;
        padding:30px;
        border-radius:20px;
        margin-bottom:25px;
    ">
        <h1 style="margin:0; font-size:36px;">
            Edit Mata Pelajaran
        </h1>

        <p style="margin-top:10px;">
            Perbarui data mata pelajaran Portal E-Learning Akademik.
        </p>
    </div>

    <div style="
        background:white;
        padding:30px;
        border-radius:20px;
        box-shadow:0 10px 25px rgba(0,0,0,0.08);
    ">

        <form action="{{ route('mata-pelajaran.update', $data->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div style="
                display:grid;
                grid-template-columns:1fr 1fr;
                gap:20px;
            ">

                <div>
                    <label style="font-weight:bold;">
                        Kode Mapel
                    </label>

                    <input
                        type="text"
                        name="kode_mapel"
                        value="{{ $data->kode_mapel }}"
                        style="
                            width:100%;
                            padding:12px;
                            margin-top:8px;
                            border:1px solid #cbd5e1;
                            border-radius:10px;
                        "
                    >
                </div>

                <div>
                    <label style="font-weight:bold;">
                        Nama Mapel
                    </label>

                    <input
                        type="text"
                        name="nama_mapel"
                        value="{{ $data->nama_mapel }}"
                        style="
                            width:100%;
                            padding:12px;
                            margin-top:8px;
                            border:1px solid #cbd5e1;
                            border-radius:10px;
                        "
                    >
                </div>

                <div>
                    <label style="font-weight:bold;">
                        Guru Pengampu
                    </label>

                    <input
                        type="text"
                        name="guru_pengampu"
                        value="{{ $data->guru_pengampu }}"
                        style="
                            width:100%;
                            padding:12px;
                            margin-top:8px;
                            border:1px solid #cbd5e1;
                            border-radius:10px;
                        "
                    >
                </div>

                <div>
                    <label style="font-weight:bold;">
                        Jumlah Jam
                    </label>

                    <input
                        type="number"
                        name="jumlah_jam"
                        value="{{ $data->jumlah_jam }}"
                        style="
                            width:100%;
                            padding:12px;
                            margin-top:8px;
                            border:1px solid #cbd5e1;
                            border-radius:10px;
                        "
                    >
                </div>

            </div>

            <div style="
                display:flex;
                justify-content:flex-end;
                gap:10px;
                margin-top:30px;
            ">

                <a href="{{ route('mata-pelajaran.index') }}"
                   style="
                        background:#64748b;
                        color:white;
                        padding:12px 18px;
                        border-radius:10px;
                        text-decoration:none;
                   ">
                    Kembali
                </a>

                <button
                    type="submit"
                    style="
                        background:#2563eb;
                        color:white;
                        border:none;
                        padding:12px 20px;
                        border-radius:10px;
                        cursor:pointer;
                    "
                >
                    Update Data
                </button>

            </div>

        </form>

    </div>

</div>

@endsection