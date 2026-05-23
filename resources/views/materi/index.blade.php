@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Materi Pembelajaran</h1>

    <a href="{{ route('materi.create') }}" style="display:inline-block; margin-bottom:15px;">
        Tambah Materi
    </a>

    @if (session('success'))
        <div style="padding:10px; background:#d1e7dd; color:#0f5132; margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Materi</th>
                <th>Mata Pelajaran</th>
                <th>Guru</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($materis as $materi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $materi->judul_materi }}</td>
                    <td>{{ $materi->mataPelajaran->nama_mapel ?? '-' }}</td>
                    <td>{{ $materi->guru->nama ?? '-' }}</td>
                    <td>
                        @if ($materi->file_materi)
                            <a href="{{ asset('assets/uploads/materi/' . $materi->file_materi) }}" target="_blank">
                                Lihat File
                            </a>
                        @else
                            Tidak ada file
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('materi.show', $materi->id) }}">Detail</a> |
                        <a href="{{ route('materi.edit', $materi->id) }}">Edit</a> |

                        <form action="{{ route('materi.destroy', $materi->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" onclick="return confirm('Yakin ingin menghapus data materi ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" align="center">Belum ada data materi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:15px;">
        {{ $materis->links() }}
    </div>
</div>
@endsection