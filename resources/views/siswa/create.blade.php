@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="page">
    <div class="container-small">

        <div class="header">
            <h1>Tambah Data Siswa</h1>
            <p>Form tambah data siswa menggunakan REST API Laravel.</p>
        </div>

        <div class="panel">
            <form id="createSiswaForm">

                <div class="form-grid">

                    <div class="form-group">
                        <label>NIS</label>
                        <input type="text" name="nis" placeholder="Masukkan NIS" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" name="nama" placeholder="Masukkan nama siswa" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="contoh@gmail.com" required>
                    </div>

                    <div class="form-group">
                        <label>Kelas</label>
                        <input type="text" name="kelas" placeholder="Contoh: X RPL 1" required>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" required>
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir">
                    </div>

                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="no_hp" placeholder="Masukkan nomor HP">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="form-group full">
                        <label>Alamat</label>
                        <textarea name="alamat" rows="4" placeholder="Masukkan alamat siswa"></textarea>
                    </div>

                </div>

                <div class="actions">
                    <a href="{{ url('/siswa') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i>
                        Simpan Siswa
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('createSiswaForm').addEventListener('submit', async function(e) {

    e.preventDefault();

    const formData = new window.FormData(e.target);

    try {

        const response = await fetch('/api/siswa', {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json'
            }
        });

        const result = await response.json();

        if (!response.ok) {

            let message = 'Gagal menambahkan data siswa';

            if (result.errors) {
                message = Object.values(result.errors)
                    .flat()
                    .join('\n');
            }

            alert(message);
            return;
        }

        alert(result.message);

        window.location.href = '/siswa';

    } catch (error) {

        alert('Terjadi kesalahan server');

    }

});
</script>
@endsection