@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')
<div class="page">
    <div class="container-small">
        <div class="header">
            <h1>Edit Data Siswa</h1>
            <p>Perbarui data siswa yang sudah tersimpan pada sistem.</p>
        </div>

        <div class="card">
            <div class="info-box" id="statusBox">Memuat data siswa...</div>

            <form id="formEdit">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="text" id="nis" required>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" required>
                    </div>

                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" id="kelas" required>
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
                        <input type="text" id="no_hp">
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
                        <textarea id="alamat"></textarea>
                    </div>
                </div>

                <div class="actions">
                    <a href="/siswa" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary" id="btnUpdate">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    var id = getIdFromUrl();
    var apiUrl = '/api/siswa';

    loadData();

    function getIdFromUrl() {
        var path = window.location.pathname;
        var parts = path.split('/');
        return parts[2];
    }

    function loadData() {
        $.ajax({
            url: apiUrl + '/' + id,
            type: 'GET',
            headers: {
                'Accept': 'application/json'
            },
            success: function (response) {
                var siswa = response.data;

                $('#nis').val(siswa.nis);
                $('#nama').val(siswa.nama);
                $('#email').val(siswa.email);
                $('#kelas').val(siswa.kelas);
                $('#jenis_kelamin').val(siswa.jenis_kelamin);
                $('#tanggal_lahir').val(siswa.tanggal_lahir);
                $('#no_hp').val(siswa.no_hp);
                $('#alamat').val(siswa.alamat);
                $('#status').val(siswa.status);

                $('#statusBox').text('Data berhasil dimuat. Silakan lakukan perubahan.');
            },
            error: function () {
                Swal.fire({
                    title: 'Data Tidak Ditemukan',
                    text: 'Data siswa yang kamu buka tidak tersedia.',
                    icon: 'error',
                    confirmButtonText: 'Kembali',
                    confirmButtonColor: '#1E3A8A'
                }).then(function () {
                    window.location.href = '/siswa';
                });
            }
        });
    }

    $('#formEdit').submit(function (e) {
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

        $('#btnUpdate').prop('disabled', true).text('Mengupdate...');

        $.ajax({
            url: apiUrl + '/' + id,
            type: 'PUT',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            headers: {
                'Accept': 'application/json'
            },
            success: function (response) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: response.message || 'Data siswa berhasil diperbarui.',
                    icon: 'success',
                    confirmButtonText: 'Oke',
                    confirmButtonColor: '#1E3A8A'
                }).then(function () {
                    window.location.href = '/siswa';
                });
            },
            error: function (xhr) {
                Swal.fire({
                    title: 'Gagal!',
                    text: getErrorMessage(xhr, 'Data siswa gagal diperbarui.'),
                    icon: 'error',
                    confirmButtonText: 'Coba Lagi',
                    confirmButtonColor: '#B91C1C'
                });

                $('#btnUpdate').prop('disabled', false).text('Update Data');
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