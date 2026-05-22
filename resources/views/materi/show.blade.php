@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Materi Pembelajaran</h1>

    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <tr>
            <th width="25%">Judul Materi</th>
            <td>{{ $materi->judul_materi }}</td>
        </tr>

        <tr>
            <th>Deskripsi</th>
            <td>{{ $materi->deskripsi ?? '-' }}</td>
        </tr>

        <tr>
            <th>Mata Pelajaran</th>
            <td>{{ $materi->mataPelajaran->nama_mapel ?? '-' }}</td>
        </tr>

        <tr>
            <th>Guru</th>
            <td>{{ $materi->guru->nama ?? '-' }}</td>
        </tr>

        <tr>
            <th>File Materi</th>
            <td>
                @if ($materi->file_materi)
                    <a href="{{ asset('assets/uploads/materi/' . $materi->file_materi) }}" target="_blank">
                        Download / Lihat File
                    </a>
                @else
                    Tidak ada file
                @endif
            </td>
        </tr>

        <tr>
            <th>Tanggal Dibuat</th>
            <td>{{ $materi->created_at ? $materi->created_at->format('d-m-Y H:i') : '-' }}</td>
        </tr>
    </table>

    <br>

    <a href="{{ route('materi.index') }}">Kembali</a>
    <a href="{{ route('materi.edit', $materi->id) }}">Edit</a>
</div>
@endsection