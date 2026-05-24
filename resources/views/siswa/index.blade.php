@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
<div class="page">
    <div class="container">
        <div class="header">
            <h1>Manajemen Data Siswa</h1>
            <p>Kelola data siswa Portal E-Learning Akademik. Data ditampilkan dan dihapus menggunakan jQuery AJAX.</p>
        </div>

        <div class="stat-grid">
            <div class="stat-card">
                <span>Total Siswa</span>
                <h2 id="totalSiswa">0</h2>
            </div>

            <div class="stat-card">
                <span>Siswa Aktif</span>
                <h2 id="totalAktif">0</h2>
            </div>

            <div class="stat-card">
                <span>Tidak Aktif</span>
                <h2 id="totalTidakAktif">0</h2>
            </div>
        </div>

        <div class="panel">
            <div class="toolbar">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Cari NIS, nama, email, kelas, no HP, atau status...">
                </div>

                <a href="/siswa/create" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Siswa
                </a>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Siswa</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>
                            <th>No HP</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="dataSiswa">
                        <tr>
                            <td colspan="8" class="empty">Memuat data siswa...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    var apiUrl = '/api/siswa';
    var siswaList = [];

    loadSiswa();

    function loadSiswa() {
        $.ajax({
            url: apiUrl,
            type: 'GET',
            headers: {
                'Accept': 'application/json'
            },
            success: function (response) {
                siswaList = response.data || [];
                updateStats(siswaList);
                renderTable(siswaList);
            },
            error: function () {
                $('#dataSiswa').html(
                    '<tr>' +
                        '<td colspan="8" class="empty" style="color:#dc2626;">Gagal memuat data siswa.</td>' +
                    '</tr>'
                );
            }
        });
    }

    function updateStats(data) {
        var aktif = 0;
        var tidakAktif = 0;

        $.each(data, function (index, item) {
            if (item.status === 'Aktif') {
                aktif++;
            }

            if (item.status === 'Tidak Aktif') {
                tidakAktif++;
            }
        });

        $('#totalSiswa').text(data.length);
        $('#totalAktif').text(aktif);
        $('#totalTidakAktif').text(tidakAktif);
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

    function statusBadge(status) {
        if (status === 'Aktif') {
            return '<span class="badge badge-green">Aktif</span>';
        }

        return '<span class="badge badge-red">Tidak Aktif</span>';
    }

    function renderTable(data) {
        var rows = '';

        if (data.length === 0) {
            rows = '<tr><td colspan="8" class="empty">Belum ada data siswa.</td></tr>';
        } else {
            $.each(data, function (index, siswa) {
                rows +=
                    '<tr>' +
                        '<td>' + (index + 1) + '</td>' +

                        '<td>' +
                            '<div class="student-info">' +
                                '<div class="avatar">' + getInitial(siswa.nama) + '</div>' +
                                '<div>' +
                                    '<div class="student-name">' + safeHtml(siswa.nama) + '</div>' +
                                    '<div class="student-email">' + safeHtml(siswa.email) + '</div>' +
                                '</div>' +
                            '</div>' +
                        '</td>' +

                        '<td><span class="badge badge-blue">' + safeHtml(siswa.nis) + '</span></td>' +
                        '<td>' + safeHtml(siswa.kelas) + '</td>' +
                        '<td>' + safeHtml(siswa.jenis_kelamin) + '</td>' +
                        '<td>' + safeHtml(siswa.no_hp) + '</td>' +
                        '<td>' + statusBadge(siswa.status) + '</td>' +

                        '<td>' +
                            '<div class="action-group">' +
                                '<a href="/siswa/' + siswa.id + '" class="btn btn-detail btn-icon" title="Detail" aria-label="Detail">' +
                                    '<i class="fa-solid fa-eye"></i>' +
                                '</a>' +

                                '<a href="/siswa/' + siswa.id + '/edit" class="btn btn-edit btn-icon" title="Edit" aria-label="Edit">' +
                                    '<i class="fa-solid fa-pen-to-square"></i>' +
                                '</a>' +

                                '<button type="button" class="btn btn-delete btn-icon btnHapus" data-id="' + siswa.id + '" title="Hapus" aria-label="Hapus">' +
                                    '<i class="fa-solid fa-trash"></i>' +
                                '</button>' +
                            '</div>' +
                        '</td>' +
                    '</tr>';
            });
        }

        $('#dataSiswa').html(rows);
    }

    $('#searchInput').on('keyup', function () {
        var keyword = $(this).val().toLowerCase();
        var filtered = [];

        $.each(siswaList, function (index, siswa) {
            var gabungan =
                String(siswa.nis || '') + ' ' +
                String(siswa.nama || '') + ' ' +
                String(siswa.email || '') + ' ' +
                String(siswa.kelas || '') + ' ' +
                String(siswa.jenis_kelamin || '') + ' ' +
                String(siswa.no_hp || '') + ' ' +
                String(siswa.status || '');

            if (gabungan.toLowerCase().indexOf(keyword) !== -1) {
                filtered.push(siswa);
            }
        });

        renderTable(filtered);
    });

    $(document).on('click', '.btnHapus', function () {
        var id = $(this).data('id');

        Swal.fire({
            title: 'Hapus Data Siswa?',
            text: 'Data yang sudah dihapus tidak bisa dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#B91C1C',
            cancelButtonColor: '#6B7280',
            reverseButtons: true
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: apiUrl + '/' + id,
                    type: 'DELETE',
                    headers: {
                        'Accept': 'application/json'
                    },
                    success: function (response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message || 'Data siswa berhasil dihapus.',
                            icon: 'success',
                            confirmButtonText: 'Oke',
                            confirmButtonColor: '#1E3A8A'
                        });

                        loadSiswa();
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data siswa gagal dihapus.',
                            icon: 'error',
                            confirmButtonText: 'Coba Lagi',
                            confirmButtonColor: '#B91C1C'
                        });
                    }
                });
            }
        });
    });
});
</script>
@endsection