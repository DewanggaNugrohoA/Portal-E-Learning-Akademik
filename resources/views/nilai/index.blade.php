@extends('layouts.app')

@section('title', 'Data Nilai')

@section('content')
<div class="page">
    <div class="container">
        <div class="header">
            <h1>Manajemen Data Nilai</h1>
            <p>Kelola data nilai Portal E-Learning Akademik. Data ditampilkan dan dihapus menggunakan jQuery AJAX.</p>
        </div>

        <div class="panel">
            <div class="toolbar">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Cari guru, KKM, atau predikat...">
                </div>

                <a href="/nilai/create" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Nilai
                </a>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Guru</th>
                            <th>KKM</th>
                            <th>Predikat A</th>
                            <th>Predikat B</th>
                            <th>Predikat C</th>
                            <th>Predikat D</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="dataNilai">
                        <tr>
                            <td colspan="8" class="empty">Memuat data nilai...</td>
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
    var apiUrl = '/api/nilai';
    var nilaiList = [];

    loadNilai();

    function loadNilai() {
        $.ajax({
            url: apiUrl,
            type: 'GET',
            headers: {
                'Accept': 'application/json'
            },
            success: function (response) {
                nilaiList = response.data || [];
                renderTable(nilaiList);
            },
            error: function () {
                $('#dataNilai').html(
                    '<tr>' +
                        '<td colspan="8" class="empty" style="color:#dc2626;">Gagal memuat data nilai.</td>' +
                    '</tr>'
                );
            }
        });
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

    function getGuruName(nilai) {
        if (nilai.guru && nilai.guru.nama) {
            return nilai.guru.nama;
        }

        return '-';
    }

    function renderTable(data) {
        var rows = '';

        if (data.length === 0) {
            rows = '<tr><td colspan="8" class="empty">Belum ada data nilai.</td></tr>';
        } else {
            $.each(data, function (index, nilai) {
                rows +=
                    '<tr>' +
                        '<td>' + (index + 1) + '</td>' +
                        '<td>' + safeHtml(getGuruName(nilai)) + '</td>' +
                        '<td><span class="badge badge-blue">' + safeHtml(nilai.kkm) + '</span></td>' +
                        '<td>' + safeHtml(nilai.deskripsi_a) + '</td>' +
                        '<td>' + safeHtml(nilai.deskripsi_b) + '</td>' +
                        '<td>' + safeHtml(nilai.deskripsi_c) + '</td>' +
                        '<td>' + safeHtml(nilai.deskripsi_d) + '</td>' +

                        '<td>' +
                            '<div class="action-group">' +
                                '<a href="/nilai/' + nilai.id + '" class="btn btn-detail btn-icon" title="Detail">' +
                                    '<i class="fa-solid fa-eye"></i>' +
                                '</a>' +

                                '<a href="/nilai/' + nilai.id + '/edit" class="btn btn-edit btn-icon" title="Edit">' +
                                    '<i class="fa-solid fa-pen-to-square"></i>' +
                                '</a>' +

                                '<button type="button" class="btn btn-delete btn-icon btnHapus" data-id="' + nilai.id + '" title="Hapus">' +
                                    '<i class="fa-solid fa-trash"></i>' +
                                '</button>' +
                            '</div>' +
                        '</td>' +
                    '</tr>';
            });
        }

        $('#dataNilai').html(rows);
    }

    $('#searchInput').on('keyup', function () {
        var keyword = $(this).val().toLowerCase();

        var filtered = nilaiList.filter(function (nilai) {
            var gabungan =
                String(getGuruName(nilai) || '') + ' ' +
                String(nilai.kkm || '') + ' ' +
                String(nilai.deskripsi_a || '') + ' ' +
                String(nilai.deskripsi_b || '') + ' ' +
                String(nilai.deskripsi_c || '') + ' ' +
                String(nilai.deskripsi_d || '');

            return gabungan.toLowerCase().indexOf(keyword) !== -1;
        });

        renderTable(filtered);
    });

    $(document).on('click', '.btnHapus', function () {
        var id = $(this).data('id');

        if (confirm('Yakin ingin menghapus data nilai ini?')) {
            $.ajax({
                url: apiUrl + '/' + id,
                type: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                },
                success: function (response) {
                    alert(response.message || 'Data nilai berhasil dihapus.');
                    loadNilai();
                },
                error: function () {
                    alert('Gagal menghapus data nilai.');
                }
            });
        }
    });
});
</script>
@endsection