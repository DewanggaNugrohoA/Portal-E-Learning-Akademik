@extends('layouts.app')

@section('title', 'Edit Nilai')

@section('content')
<div class="page">
    <div class="container">
        <div class="header">
            <h1>Edit Data Nilai</h1>
            <p>Perbarui data nilai pada Portal E-Learning Akademik.</p>
        </div>

        <div class="panel">
            <form id="formNilai">
                <div class="form-group">
                    <label>Guru</label>
                    <select id="guru_id" class="form-control" required>
                        <option value="">-- Pilih Guru --</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>KKM</label>
                    <input type="number" id="kkm" class="form-control" min="0" max="100" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi Predikat A</label>
                    <textarea id="deskripsi_a" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label>Deskripsi Predikat B</label>
                    <textarea id="deskripsi_b" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label>Deskripsi Predikat C</label>
                    <textarea id="deskripsi_c" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label>Deskripsi Predikat D</label>
                    <textarea id="deskripsi_d" class="form-control" required></textarea>
                </div>

                <div class="action-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i>
                        Update
                    </button>

                    <a href="/nilai" class="btn btn-detail">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    var id = "{{ $id }}";

    function loadGuru(selectedGuruId) {
        $.ajax({
            url: '/api/guru-list',
            type: 'GET',
            headers: {
                'Accept': 'application/json'
            },
            success: function (response) {
                var options = '<option value="">-- Pilih Guru --</option>';

                $.each(response.data || [], function (index, guru) {
                    var selected = guru.id == selectedGuruId ? 'selected' : '';
                    options += '<option value="' + guru.id + '" ' + selected + '>' + guru.nama + '</option>';
                });

                $('#guru_id').html(options);
            },
            error: function () {
                alert('Gagal memuat data guru.');
            }
        });
    }

    function loadDetailNilai() {
        $.ajax({
            url: '/api/nilai/' + id,
            type: 'GET',
            headers: {
                'Accept': 'application/json'
            },
            success: function (response) {
                var nilai = response.data;

                $('#kkm').val(nilai.kkm);
                $('#deskripsi_a').val(nilai.deskripsi_a);
                $('#deskripsi_b').val(nilai.deskripsi_b);
                $('#deskripsi_c').val(nilai.deskripsi_c);
                $('#deskripsi_d').val(nilai.deskripsi_d);

                loadGuru(nilai.guru_id);
            },
            error: function () {
                alert('Data nilai tidak ditemukan.');
                window.location.href = '/nilai';
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

        $.ajax({
            url: '/api/nilai/' + id,
            type: 'PUT',
            data: dataNilai,
            headers: {
                'Accept': 'application/json'
            },
            success: function (response) {
                alert(response.message || 'Data nilai berhasil diperbarui.');
                window.location.href = '/nilai';
            },
            error: function () {
                alert('Gagal memperbarui data nilai.');
            }
        });
    });

    loadDetailNilai();
});
</script>
@endsection