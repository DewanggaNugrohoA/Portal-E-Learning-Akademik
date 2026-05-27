@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')
<div class="page">
    <div class="container-small">

        <div class="header">
            <h1>Edit Data Siswa</h1>
            <p>Form edit data siswa menggunakan REST API Laravel.</p>
        </div>

        <div class="panel">
            <form id="editSiswaForm">

                <div class="form-grid">

                    <div class="form-group">
                        <label>NIS</label>
                        <input type="text" name="nis" id="nis" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" name="nama" id="nama" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>

                    <div class="form-group">
                        <label>Kelas</label>
                        <input type="text" name="kelas" id="kelas" required>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" required>
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir">
                    </div>

                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="no_hp" id="no_hp">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="form-group full">
                        <label>Alamat</label>
                        <textarea name="alamat" id="alamat" rows="4"></textarea>
                    </div>

                </div>

                <div class="actions">

                    <a href="{{ url('/siswa') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i>
                        Update Siswa
                    </button>

                </div>

            </form>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>

const siswaId = "{{ $id }}";

async function loadDetailSiswa() {

    try {

        const response = await fetch(`/api/siswa/${siswaId}`, {
            headers: {
                'Accept': 'application/json'
            }
        });

        const result = await response.json();

        if (!response.ok) {

            alert(result.message || 'Data siswa tidak ditemukan');

            window.location.href = '/siswa';

            return;
        }

        const siswa = result.data;

        document.getElementById('nis').value = siswa.nis ?? '';
        document.getElementById('nama').value = siswa.nama ?? '';
        document.getElementById('email').value = siswa.email ?? '';
        document.getElementById('kelas').value = siswa.kelas ?? '';
        document.getElementById('jenis_kelamin').value = siswa.jenis_kelamin ?? '';
        document.getElementById('tanggal_lahir').value = siswa.tanggal_lahir ?? '';
        document.getElementById('no_hp').value = siswa.no_hp ?? '';
        document.getElementById('status').value = siswa.status ?? 'Aktif';
        document.getElementById('alamat').value = siswa.alamat ?? '';

    } catch (error) {

        alert('Gagal memuat data siswa');

        window.location.href = '/siswa';

    }

}

document.getElementById('editSiswaForm').addEventListener('submit', async function(e) {

    e.preventDefault();

    const formData = new window.FormData(e.target);

    formData.append('_method', 'PUT');

    try {

        const response = await fetch(`/api/siswa/${siswaId}`, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json'
            }
        });

        const result = await response.json();

        if (!response.ok) {

            let message = 'Gagal memperbarui data siswa';

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

loadDetailSiswa();

</script>
@endsection