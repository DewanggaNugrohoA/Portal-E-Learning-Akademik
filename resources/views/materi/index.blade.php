@extends('layouts.app')

@section('title', 'Data Materi')

@section('content')
<div class="page">
    <div class="container">
        <div class="header">
            <h1>Data Materi Pembelajaran</h1>
            <p>Halaman ini digunakan untuk mengelola data materi pembelajaran pada Portal E-Learning Akademik.</p>
        </div>

        <div class="stat-grid">
            <div class="stat-card">
                <span>Total Materi</span>
                <h2>{{ $materis->total() }}</h2>
            </div>

            <div class="stat-card">
                <span>Modul</span>
                <h2>Materi</h2>
            </div>

            <div class="stat-card">
                <span>Penanggung Jawab</span>
                <h2>Dewangga</h2>
            </div>
        </div>

        <div class="panel">
            <div class="toolbar">
                <div>
                    <h2 style="margin:0;">Daftar Materi</h2>
                    <p style="margin:6px 0 0; color:#64748b;">Kelola data materi, mata pelajaran, guru, dan file pembelajaran.</p>
                </div>

                <a href="{{ route('materi.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Materi
                </a>
            </div>

            @if (session('success'))
                <div class="info-box">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Materi</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru</th>
                            <th>File</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($materis as $materi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <strong>{{ $materi->judul_materi }}</strong>
                                    <div style="color:#64748b; font-size:13px; margin-top:4px;">
                                        {{ Str::limit($materi->deskripsi, 70) }}
                                    </div>
                                </td>

                                <td>
                                    <span class="badge badge-blue">
                                        {{ $materi->nama_mata_pelajaran ?? '-' }}
                                    </span>
                                </td>

                                <td>{{ $materi->nama_guru ?? '-' }}</td>

                                <td>
                                    @if ($materi->file_materi)
                                        <a href="{{ asset('assets/uploads/materi/' . $materi->file_materi) }}" target="_blank" class="btn btn-detail">
                                            <i class="fa-solid fa-file"></i>
                                            Lihat File
                                        </a>
                                    @else
                                        <span class="badge badge-red">Tidak ada file</span>
                                    @endif
                                </td>

                                <td>{{ $materi->created_at ? $materi->created_at->format('d-m-Y H:i') : '-' }}</td>

                                <td>
                                    <div class="action-group">
                                        <a href="{{ route('materi.show', $materi->id) }}" class="btn btn-detail">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        <a href="{{ route('materi.edit', $materi->id) }}" class="btn btn-edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <form action="{{ route('materi.destroy', $materi->id) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty">
                                    Belum ada data materi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="margin-top:20px;">
                {{ $materis->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('.delete-form').on('submit', function(e) {
        e.preventDefault();

        const form = this;

        Swal.fire({
            title: 'Hapus data materi?',
            text: 'Data materi yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#1e3a8a',
            cancelButtonColor: '#64748b'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@endsection