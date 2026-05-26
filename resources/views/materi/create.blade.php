@extends('layouts.app')

@section('title', 'Tambah Materi')

@section('content')
<div class="page">
    <div class="container-small">
        <div class="header">
            <h1>Tambah Materi Pembelajaran</h1>
            <p>Form ini digunakan untuk menambahkan data materi pembelajaran baru.</p>
        </div>

        <div class="panel">
            <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-grid">
                    <div class="form-group full">
                        <label>Judul Materi</label>
                        <input type="text" name="judul_materi" value="{{ old('judul_materi') }}" placeholder="Masukkan judul materi">
                        @error('judul_materi')
                            <small style="color:#b91c1c;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Nama Mata Pelajaran</label>
                        <input type="text" name="nama_mata_pelajaran" value="{{ old('nama_mata_pelajaran') }}" placeholder="Contoh: Pemrograman Web">
                        @error('nama_mata_pelajaran')
                            <small style="color:#b91c1c;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Nama Guru</label>
                        <input type="text" name="nama_guru" value="{{ old('nama_guru') }}" placeholder="Masukkan nama guru">
                        @error('nama_guru')
                            <small style="color:#b91c1c;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group full">
                        <label>Deskripsi Materi</label>
                        <textarea name="deskripsi" placeholder="Tuliskan deskripsi materi">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <small style="color:#b91c1c;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group full">
                        <label>Upload File Materi</label>
                        <input type="file" name="file_materi">
                        <small style="color:#64748b;">Format: PDF, DOC, DOCX, PPT, PPTX, MP4, ZIP, RAR. Maksimal 20 MB.</small>
                        @error('file_materi')
                            <small style="color:#b91c1c; display:block;">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="actions">
                    <a href="{{ url('/materi') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i>
                        Simpan Materi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection