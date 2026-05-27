@extends('layouts.app')

@section('title', 'Edit Guru')

@section('content')
<div class="page">
    <div class="container">
        <div class="header">
            <h1>Edit Data Guru</h1>
            <p>Perbarui data guru pada sistem akademik.</p>
        </div>

        <div class="panel">
            <form action="{{ route('guru.update', $guru->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <div class="form-group">
                        <label>Nama Guru</label>
                        <input type="text" name="nama" value="{{ $guru->nama }}" required>
                    </div>

                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" name="nip" value="{{ $guru->nip }}" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ $guru->email }}" required>
                    </div>

                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="no_hp" value="{{ $guru->no_hp }}">
                    </div>

                    <div class="form-group full">
                        <label>Alamat</label>
                        <textarea name="alamat">{{ $guru->alamat }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Mata Pelajaran</label>
                        <input type="text" name="mapel" value="{{ $guru->mapel ?? $guru->mata_pelajaran }}">
                    </div>
                </div>

                <div class="actions">
                    <a href="/guru" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i>
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection