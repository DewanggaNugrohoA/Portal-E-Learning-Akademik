@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Materi Pembelajaran</h1>

    <form action="{{ route('materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="margin-bottom:15px;">
            <label>Judul Materi</label><br>
            <input type="text" name="judul_materi" value="{{ old('judul_materi', $materi->judul_materi) }}" style="width:100%;">
            @error('judul_materi')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom:15px;">
            <label>Deskripsi</label><br>
            <textarea name="deskripsi" rows="5" style="width:100%;">{{ old('deskripsi', $materi->deskripsi) }}</textarea>
            @error('deskripsi')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom:15px;">
            <label>Mata Pelajaran</label><br>
            <select name="mata_pelajaran_id" style="width:100%;">
                <option value="">-- Pilih Mata Pelajaran --</option>
                @foreach ($mataPelajarans as $mapel)
                    <option value="{{ $mapel->id }}" {{ old('mata_pelajaran_id', $materi->mata_pelajaran_id) == $mapel->id ? 'selected' : '' }}>
                        {{ $mapel->nama_mapel }}
                    </option>
                @endforeach
            </select>
            @error('mata_pelajaran_id')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom:15px;">
            <label>Guru</label><br>
            <select name="guru_id" style="width:100%;">
                <option value="">-- Pilih Guru --</option>
                @foreach ($gurus as $guru)
                    <option value="{{ $guru->id }}" {{ old('guru_id', $materi->guru_id) == $guru->id ? 'selected' : '' }}>
                        {{ $guru->nama }}
                    </option>
                @endforeach
            </select>
            @error('guru_id')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom:15px;">
            <label>File Materi Saat Ini</label><br>
            @if ($materi->file_materi)
                <a href="{{ asset('assets/uploads/materi/' . $materi->file_materi) }}" target="_blank">
                    {{ $materi->file_materi }}
                </a>
            @else
                <span>Tidak ada file</span>
            @endif
        </div>

        <div style="margin-bottom:15px;">
            <label>Ganti File Materi</label><br>
            <input type="file" name="file_materi">
            @error('file_materi')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Update</button>
        <a href="{{ route('materi.index') }}">Kembali</a>
    </form>
</div>
@endsection