@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="page">
    <div class="container-small">

        <div class="header">
            <h1>Tambah Data Siswa</h1>
            <p>Form tambah data siswa menggunakan REST API Laravel.</p>
        </div>

        <div class="card">

            <div class="info-box">
                Pastikan NIS dan email belum digunakan sebelumnya agar data dapat tersimpan.
            </div>

            <form id="formTambah">

                <div class="form-grid">

                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="text" id="nis" placeholder="Masukkan NIS" required>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Siswa</label>
                        <input type="text" id="nama" placeholder="Masukkan nama siswa" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="contoh@gmail.com" required>
                    </div>

                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" id="kelas" placeholder="Contoh: X RPL 1" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select id="jenis_kelamin" required>
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir">
                    </div>

                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" id="no_hp" placeholder="Masukkan nomor HP">
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="form-group full">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" rows="4" placeholder="Masukkan alamat siswa"></textarea>
                    </div>

                </div>

                <div class="actions">
                    <a href="/siswa" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary" id="btnSimpan">
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
$(document).ready(function () {

    $('#formTambah').submit(function (e) {

        e.preventDefault();

        var formData = {
            nis: $('#nis').val(),
            nama: $('#nama').val(),
            email: $('#email').val(),
            kelas: $('#kelas').val(),
            jenis_kelamin: $('#jenis_kelamin').val(),
            tanggal_lahir: $('#tanggal_lahir').val(),
            no_hp: $('#no_hp').val(),
            alamat: $('#alamat').val(),
            status: $('#status').val()
        };

        $('#btnSimpan').prop('disabled', true).html(`
            <i class="fa-solid fa-spinner fa-spin"></i>
            Menyimpan...
        `);

        $.ajax({
            url: '/api/siswa',
            type: 'POST',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            headers: {
                'Accept': 'application/json'
            },

            success: function (response) {

                Swal.fire({
                    title: 'Berhasil!',
                    text: response.message || 'Data siswa berhasil ditambahkan.',
                    icon: 'success',
                    confirmButtonColor: '#1E3A8A'
                }).then(function () {
                    window.location.href = '/siswa';
                });

            },

            error: function (xhr) {

                Swal.fire({
                    title: 'Gagal!',
                    text: getErrorMessage(xhr, 'Data siswa gagal ditambahkan.'),
                    icon: 'error',
                    confirmButtonColor: '#B91C1C'
                });

                $('#btnSimpan').prop('disabled', false).html(`
                    <i class="fa-solid fa-save"></i>
                    Simpan Siswa
                `);
            }
        });

    });

    function getErrorMessage(xhr, defaultMessage) {

        var pesan = defaultMessage;

        if (xhr.responseJSON) {

            if (xhr.responseJSON.errors) {

                var list = [];

                $.each(xhr.responseJSON.errors, function (key, values) {

                    $.each(values, function (index, value) {
                        list.push(value);
                    });

                });

                pesan = list.join('\n');

            } else if (xhr.responseJSON.message) {

                pesan = xhr.responseJSON.message;

            }
        }

        return pesan;
    }

});
</script>
@endsection