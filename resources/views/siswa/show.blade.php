@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
<div class="page">
    <div class="container">

        <div class="header">
            <h1>Detail Data Siswa</h1>
            <p>Informasi lengkap siswa pada Portal E-Learning Akademik.</p>
        </div>

        <div id="detailArea">
            <div class="loading-box">
                Memuat detail siswa...
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {

    var id = getIdFromUrl();
    var apiUrl = '/api/siswa';

    loadDetailSiswa();

    function getIdFromUrl() {
        var path = window.location.pathname;
        var parts = path.split('/');
        return parts[2];
    }

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

    function getInitial(name) {

        if (name && name.length > 0) {
            return safeHtml(name.charAt(0).toUpperCase());
        }

        return 'S';
    }

    function formatTanggal(value) {

        if (!value) {
            return '-';
        }

        var tanggal = value.substring(0, 10);
        var bagian = tanggal.split('-');

        if (bagian.length !== 3) {
            return '-';
        }

        return bagian[2] + '-' + bagian[1] + '-' + bagian[0];
    }

    function statusBadge(status) {

        if (status === 'Aktif') {
            return '<span class="badge badge-blue">Aktif</span>';
        }

        return '<span class="badge badge-red">Tidak Aktif</span>';
    }

    function loadDetailSiswa() {

        $.ajax({
            url: apiUrl + '/' + id,
            type: 'GET',
            headers: {
                'Accept': 'application/json'
            },

            success: function (response) {

                var siswa = response.data;

                $('#detailArea').html(

                    '<div class="profile-card">' +

                        '<div class="profile-top">' +

                            '<div class="detail-avatar">' +
                                getInitial(siswa.nama) +
                            '</div>' +

                            '<div class="profile-info">' +

                                '<h2>' +
                                    safeHtml(siswa.nama) +
                                '</h2>' +

                                '<p>' +
                                    safeHtml(siswa.email) +
                                '</p>' +

                                '<div class="badge-row">' +

                                    '<span class="badge badge-blue">' +
                                        'NIS: ' + safeHtml(siswa.nis) +
                                    '</span>' +

                                    '<span class="badge badge-blue">' +
                                        'Kelas: ' + safeHtml(siswa.kelas) +
                                    '</span>' +

                                    statusBadge(siswa.status) +

                                '</div>' +

                            '</div>' +

                        '</div>' +

                    '</div>' +

                    '<div class="content-grid">' +

                        '<div class="section">' +

                            '<h3>Informasi Utama</h3>' +

                            '<div class="data-grid">' +

                                '<div class="data-item">' +
                                    '<div class="label">NIS</div>' +
                                    '<div class="value">' + safeHtml(siswa.nis) + '</div>' +
                                '</div>' +

                                '<div class="data-item">' +
                                    '<div class="label">Nama Lengkap</div>' +
                                    '<div class="value">' + safeHtml(siswa.nama) + '</div>' +
                                '</div>' +

                                '<div class="data-item">' +
                                    '<div class="label">Email</div>' +
                                    '<div class="value">' + safeHtml(siswa.email) + '</div>' +
                                '</div>' +

                                '<div class="data-item">' +
                                    '<div class="label">Kelas</div>' +
                                    '<div class="value">' + safeHtml(siswa.kelas) + '</div>' +
                                '</div>' +

                                '<div class="data-item">' +
                                    '<div class="label">Jenis Kelamin</div>' +
                                    '<div class="value">' + safeHtml(siswa.jenis_kelamin) + '</div>' +
                                '</div>' +

                                '<div class="data-item">' +
                                    '<div class="label">Tanggal Lahir</div>' +
                                    '<div class="value">' + formatTanggal(siswa.tanggal_lahir) + '</div>' +
                                '</div>' +

                                '<div class="data-item">' +
                                    '<div class="label">No HP</div>' +
                                    '<div class="value">' + safeHtml(siswa.no_hp) + '</div>' +
                                '</div>' +

                                '<div class="data-item">' +
                                    '<div class="label">Status</div>' +
                                    '<div class="value">' + safeHtml(siswa.status) + '</div>' +
                                '</div>' +

                                '<div class="data-item full">' +
                                    '<div class="label">Alamat</div>' +
                                    '<div class="value">' + safeHtml(siswa.alamat) + '</div>' +
                                '</div>' +

                            '</div>' +

                        '</div>' +

                        '<div class="section">' +

                            '<h3>Ringkasan Data</h3>' +

                            '<div class="summary-list">' +

                                '<div class="summary-item">' +
                                    '<span>Status Siswa</span>' +
                                    '<strong>' + safeHtml(siswa.status) + '</strong>' +
                                '</div>' +

                                '<div class="summary-item">' +
                                    '<span>Identitas Kelas</span>' +
                                    '<strong>' + safeHtml(siswa.kelas) + '</strong>' +
                                '</div>' +

                                '<div class="summary-item">' +
                                    '<span>Data Dibuat</span>' +
                                    '<strong>' + formatTanggal(siswa.created_at) + '</strong>' +
                                '</div>' +

                                '<div class="summary-item">' +
                                    '<span>Terakhir Diperbarui</span>' +
                                    '<strong>' + formatTanggal(siswa.updated_at) + '</strong>' +
                                '</div>' +

                            '</div>' +

                        '</div>' +

                    '</div>' +

                    '<div class="actions">' +

                        '<a href="/siswa" class="btn btn-secondary">' +
                            '<i class="fa-solid fa-arrow-left"></i> Kembali' +
                        '</a>' +

                        '<a href="/siswa/' + siswa.id + '/edit" class="btn btn-primary">' +
                            '<i class="fa-solid fa-pen"></i> Edit Siswa' +
                        '</a>' +

                    '</div>'
                );

            },

            error: function () {

                Swal.fire({
                    title: 'Data Tidak Ditemukan',
                    text: 'Data siswa yang kamu buka tidak tersedia.',
                    icon: 'error',
                    confirmButtonColor: '#1E3A8A'
                }).then(function () {
                    window.location.href = '/siswa';
                });

            }
        });

    }

});
</script>
@endsection