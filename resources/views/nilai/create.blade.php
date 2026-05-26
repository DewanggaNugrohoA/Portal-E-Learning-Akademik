@extends('layouts.app')

@section('title', 'Tambah Nilai')

@section('content')
<div class="page">
    <div class="container-small">
        <div class="header">
            <h1>Tambah Data Nilai</h1>
            <p>Tambahkan data nilai baru pada Portal E-Learning Akademik.</p>
        </div>

        <div class="card">
            <div class="info-box">
                Pastikan guru dan nilai KKM sudah sesuai sebelum data disimpan.
            </div>

            <form id="formNilai">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="guru_id">Guru</label>
                        <select id="guru_id" required>
                            <option value="">-- Pilih Guru --</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kkm">KKM</label>
                        <input type="number" id="kkm" min="0" max="100" placeholder="Contoh: 75" required>
                    </div>

                    <div class="form-group full">
                        <label for="deskripsi_a">Deskripsi Predikat A</label>
                        <textarea id="deskripsi_a" placeholder="Masukkan deskripsi predikat A" required></textarea>
                    </div>

                    <div class="form-group full">
                        <label for="deskripsi_b">Deskripsi Predikat B</label>
                        <textarea id="deskripsi_b" placeholder="Masukkan deskripsi predikat B" required></textarea>
                    </div>

                    <div class="form-group full">
                        <label for="deskripsi_c">Deskripsi Predikat C</label>
                        <textarea id="deskripsi_c" placeholder="Masukkan deskripsi predikat C" required></textarea>
                    </div>

                    <div class="form-group full">
                        <label for="deskripsi_d">Deskripsi Predikat D</label>
                        <textarea id="deskripsi_d" placeholder="Masukkan deskripsi predikat D" required></textarea>
                    </div>
                </div>

                <div class="actions">
                    <a href="/nilai" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary" id="btnSimpan">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    function loadGuru() {
        $.ajax({
            url: '/api/guru-list',
            type: 'GET',
            headers: {
                'Accept': 'application/json'
            },
            success: function (response) {
                var options = '<option value="">-- Pilih Guru --</option>';

                $.each(response.data || [], function (index, guru) {
                    options += '<option value="' + guru.id + '">' + guru.nama + '</option>';
                });

                $('#guru_id').html(options);
            },
            error: function () {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Gagal memuat data guru.',
                    icon: 'error',
                    confirmButtonText: 'Coba Lagi',
                    confirmButtonColor: '#B91C1C'
                });
            }
        });
    }

    $('#formNilai').submit(function (e) {
        e.preventDefault();

        var dataNilai = {
            guru_id: $('#guru_id').val(),
            kkm: $('#kkm').val(),
            deskripsi_a: $('#deskripsi_a').val(),
            deskripsi_b: $('#deskripsi_b').val(),
            deskripsi_c: $('#deskripsi_c').val(),
            deskripsi_d: $('#deskripsi_d').val()
        };

        $('#btnSimpan').prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: '/api/nilai',
            type: 'POST',
            data: dataNilai,
            headers: {
                'Accept': 'application/json'
            },
            success: function (response) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: response.message || 'Data nilai berhasil ditambahkan.',
                    icon: 'success',
                    confirmButtonText: 'Oke',
                    confirmButtonColor: '#1E3A8A'
                }).then(function () {
                    window.location.href = '/nilai';
                });
            },
            error: function (xhr) {
                Swal.fire({
                    title: 'Gagal!',
                    text: getErrorMessage(xhr, 'Data nilai gagal ditambahkan.'),
                    icon: 'error',
                    confirmButtonText: 'Coba Lagi',
                    confirmButtonColor: '#B91C1C'
                });

                $('#btnSimpan').prop('disabled', false).text('Simpan Data');
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

    loadGuru();
});
</script>
@endsection