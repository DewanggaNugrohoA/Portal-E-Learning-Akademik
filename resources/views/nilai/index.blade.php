@extends('layouts.app')

@section('title', 'Data Nilai')

@section('content')
<div class="page">
    <div class="container">

        <div class="header">
            <h1>Manajemen Data Nilai</h1>
            <p>Kelola KKM dan deskripsi predikat nilai secara otomatis.</p>
        </div>

        <div class="stat-grid">
            <div class="stat-card">
                <span>Total Nilai</span>
                <h2 id="totalNilai">0</h2>
            </div>

            <div class="stat-card">
                <span>Modul</span>
                <h2>Nilai</h2>
            </div>

            <div class="stat-card">
                <span>Penanggung Jawab</span>
                <h2>Admin</h2>
            </div>
        </div>

        <div class="panel">
            <div class="toolbar">
                <input type="text" id="searchNilai" placeholder="Cari guru, KKM, atau predikat...">

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

                    <tbody id="nilaiTable">
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
    let apiUrl = '/api/nilai';
    let nilaiList = [];

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
                $('#totalNilai').text(nilaiList.length);
                renderNilai(nilaiList);
            },
            error: function () {
                $('#nilaiTable').html(
                    '<tr><td colspan="8" class="empty">Gagal memuat data nilai.</td></tr>'
                );
            }
        });
    }

    function safe(value) {
        return value ? value : '-';
    }

    function renderNilai(data) {
        let rows = '';

        if (data.length === 0) {
            rows = '<tr><td colspan="8" class="empty">Belum ada data nilai.</td></tr>';
        } else {
            data.forEach(function (nilai, index) {
                rows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${safe(nilai.nama_guru || nilai.guru)}</td>
                        <td><span class="badge badge-blue">${safe(nilai.kkm)}</span></td>
                        <td>${safe(nilai.predikat_a)}</td>
                        <td>${safe(nilai.predikat_b)}</td>
                        <td>${safe(nilai.predikat_c)}</td>
                        <td>${safe(nilai.predikat_d)}</td>
                        <td>
                            <div class="action-group">
                                <a href="/nilai/${nilai.id}" class="btn btn-detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="/nilai/${nilai.id}/edit" class="btn btn-edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <button class="btn btn-delete btnHapusNilai" data-id="${nilai.id}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }

        $('#nilaiTable').html(rows);
    }

    $('#searchNilai').on('keyup', function () {
        let keyword = $(this).val().toLowerCase();

        let filtered = nilaiList.filter(function (nilai) {
            let text =
                String(nilai.nama_guru || nilai.guru || '') + ' ' +
                String(nilai.kkm || '') + ' ' +
                String(nilai.predikat_a || '') + ' ' +
                String(nilai.predikat_b || '') + ' ' +
                String(nilai.predikat_c || '') + ' ' +
                String(nilai.predikat_d || '');

            return text.toLowerCase().includes(keyword);
        });

        renderNilai(filtered);
    });

    $(document).on('click', '.btnHapusNilai', function () {
        let id = $(this).data('id');

        if (confirm('Yakin ingin menghapus data nilai?')) {
            $.ajax({
                url: apiUrl + '/' + id,
                type: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                },
                success: function () {
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