@extends('layouts.app')

@section('content')

<div class="container">

    <div style="
        background:#1e3a8a;
        color:white;
        padding:30px;
        border-radius:20px;
        margin-bottom:30px;
    ">
        <h1 style="margin:0;">
            Data Mata Pelajaran
        </h1>

        <p style="margin-top:10px;">
            Kelola data mata pelajaran Portal E-Learning Akademik.
        </p>
    </div>

    <div style="margin-bottom:20px;">
        <a href="{{ route('mata-pelajaran.create') }}"
           style="
                background:#2563eb;
                color:white;
                padding:12px 20px;
                text-decoration:none;
                border-radius:10px;
                display:inline-block;
           ">
            + Tambah Mata Pelajaran
        </a>
    </div>

    <div style="
        background:white;
        padding:25px;
        border-radius:20px;
        box-shadow:0 10px 25px rgba(0,0,0,0.08);
    ">

        <table border="0"
               cellpadding="12"
               cellspacing="0"
               width="100%">

            <thead style="
                background:#1e3a8a;
                color:white;
                text-align:center;
            ">
                <tr>
                    <th>No</th>
                    <th>Kode Mapel</th>
                    <th>Nama Mata Pelajaran</th>
                    <th>Guru Pengampu</th>
                    <th>Jumlah Jam</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($data as $item)

                <tr style="border-bottom:1px solid #e5e7eb; text-align:center;">

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->kode_mapel }}</td>

                    <td>{{ $item->nama_mapel }}</td>

                    <td>{{ $item->guru_pengampu }}</td>

                    <td>{{ $item->jumlah_jam }}</td>

                    <td>

                        <a href="{{ route('mata-pelajaran.show', $item->id) }}"
                           style="
                                background:#22c55e;
                                color:white;
                                padding:8px 14px;
                                border-radius:10px;
                                text-decoration:none;
                                margin-right:5px;
                                display:inline-block;
                           ">
                            Detail
                        </a>

                        <a href="{{ route('mata-pelajaran.edit', $item->id) }}"
                           style="
                                background:#f59e0b;
                                color:white;
                                padding:8px 14px;
                                border-radius:10px;
                                text-decoration:none;
                                margin-right:5px;
                                display:inline-block;
                           ">
                            Edit
                        </a>

                        <form action="{{ route('mata-pelajaran.destroy', $item->id) }}"
                              method="POST"
                              style="display:inline-block;">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    onclick="return confirm('Yakin hapus data?')"
                                    style="
                                        background:#dc2626;
                                        color:white;
                                        padding:8px 14px;
                                        border:none;
                                        border-radius:10px;
                                        cursor:pointer;
                                    ">
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" align="center">
                        Data mata pelajaran kosong
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection