@extends('layouts.app')

@section('title', 'Detail Nilai')

@section('content')
<div class="page">
    <div class="container">
        <div class="header">
            <h1>Detail Data Nilai</h1>
            <p>Informasi lengkap data nilai pada Portal E-Learning Akademik.</p>
        </div>

        <div class="panel">
            <div id="detailNilai" class="detail-box">
                Memuat data nilai...
            </div>

            <div class="action-group" style="margin-top: 20px;">
                <a href="/nilai" class="btn btn-detail">
                    Kembali
                </a>

                <a href="/nilai/{{ $id }}/edit" class="btn btn-edit">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    var id = "{{ $id }}";

    function safeHtml(value) {
        if (value === null || value === undefined || value === '') {
            return '-';
        }

        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    $.ajax({
        url: '/api/nilai/' + id,
        type: 'GET',
        headers: {
            'Accept': 'application/json'
        },
        success: function (response) {
            var nilai = response.data;
            var guruNama = nilai.guru && nilai.guru.nama ? nilai.guru.nama : '-';

            $('#detailNilai').html(
                '<div class="detail-row">' +
                    '<strong>Nama Guru</strong>' +
                    '<span>' + safeHtml(guruNama) + '</span>' +
                '</div>' +

                '<div class="detail-row">' +
                    '<strong>KKM</strong>' +
                    '<span class="badge badge-blue">' + safeHtml(nilai.kkm) + '</span>' +
                '</div>' +

                '<div class="detail-row">' +
                    '<strong>Deskripsi Predikat A</strong>' +
                    '<span>' + safeHtml(nilai.deskripsi_a) + '</span>' +
                '</div>' +

                '<div class="detail-row">' +
                    '<strong>Deskripsi Predikat B</strong>' +
                    '<span>' + safeHtml(nilai.deskripsi_b) + '</span>' +
                '</div>' +

                '<div class="detail-row">' +
                    '<strong>Deskripsi Predikat C</strong>' +
                    '<span>' + safeHtml(nilai.deskripsi_c) + '</span>' +
                '</div>' +

                '<div class="detail-row">' +
                    '<strong>Deskripsi Predikat D</strong>' +
                    '<span>' + safeHtml(nilai.deskripsi_d) + '</span>' +
                '</div>'
            );
        },
        error: function () {
            $('#detailNilai').html(
                '<p style="color:#dc2626;">Gagal memuat detail nilai.</p>'
            );
        }
    });
});
</script>
@endsection