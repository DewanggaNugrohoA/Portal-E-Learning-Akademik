@extends('layouts.app')

@section('title', 'Tambah Guru')

@section('content')

<div class="page">
    <div class="container">

        <div class="header">
            <h1>Tambah Data Guru</h1>
            <p>Tambahkan data guru baru ke sistem akademik.</p>
        </div>

        <div class="panel">

            <form action="{{ route('guru.store') }}" method="POST">
                @csrf

                <div class="form-grid">

                    <div class="form-group">
                        <label>Nama Guru</label>
                        <input type="text" name="nama" placeholder="Masukkan nama guru" required>
                    </div>

                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" name="nip" placeholder="Masukkan NIP" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Masukkan email" required>
                    </div>

                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="no_hp" placeholder="Masukkan nomor HP">
                    </div>

                    <div class="form-group full-width">
                        <label>Alamat</label>
                        <textarea name="alamat" rows="4" placeholder="Masukkan alamat guru"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Mata Pelajaran</label>
                        <input type="text" name="mata_pelajaran" placeholder="Contoh: Matematika">
                    </div>

                </div>

                <div class="button-group">
                    <a href="/guru" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Simpan Data
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>

@endsection