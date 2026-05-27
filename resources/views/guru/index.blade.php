@extends('layouts.app')

@section('title', 'Data Guru')

@section('content')
<div class="page">
    <div class="container">
        <div class="header">
            <h1>Data Guru</h1>
            <p>Kelola data guru menggunakan REST API Laravel.</p>
        </div>

        <div class="stat-grid">

            <div class="stat-card">
                <span>Total Guru</span>
                <h2 id="totalGuru">0</h2>
            </div>

            <div class="stat-card">
                <span>Modul</span>
                <h2>Guru</h2>
            </div>

            <div class="stat-card">
                <span>Penanggung Jawab</span>
                <h2>Adel</h2>
            </div>

        </div>

        <div class="panel">
            <div class="toolbar">
                <input type="text" id="searchGuru" placeholder="Cari NIP, nama, email, no HP, atau mapel...">

                <a href="/guru/create" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Guru
                </a>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NIP</th>
                            <th>NAMA</th>
                            <th>EMAIL</th>
                            <th>NO HP</th>
                            <th>MAPEL</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>

                    <tbody id="dataGuru">
                        <tr>
                            <td colspan="7" class="empty">Memuat data guru...</td>
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
    let apiUrl = '/api/guru';
    let guruList = [];

    loadGuru();

    function loadGuru() {
        $.ajax({
            url: apiUrl,
            type: 'GET',
            headers: { 
                'Accept': 'application/json' 
            },
            success: function (response) {
                guruList = response.data || [];
                $('#totalGuru').text(guruList.length);
                renderGuru(guruList);
            },
            error: function () {
                $('#dataGuru').html(
                    '<tr><td colspan="7" class="empty">Gagal memuat data guru.</td></tr>'
                );
            }
        });
    }

    function safe(value) {
        return value ? value : '-';
    }

    function renderGuru(data) {
        let rows = '';

        if (data.length === 0) {
            rows = '<tr><td colspan="7" class="empty">Belum ada data guru.</td></tr>';
        } else {
            data.forEach(function (guru, index) {
                rows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${safe(guru.nip)}</td>
                        <td>${safe(guru.nama)}</td>
                        <td>${safe(guru.email)}</td>
                        <td>${safe(guru.no_hp)}</td>
                        <td>${safe(guru.mapel)}</td>
                        <td>
                            <div class="action-group">
                                <a href="/guru/${guru.id}" class="btn btn-detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="/guru/${guru.id}/edit" class="btn btn-edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <button class="btn btn-delete btnHapusGuru" data-id="${guru.id}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }

        $('#dataGuru').html(rows);
    }

    $('#searchGuru').on('keyup', function () {
        let keyword = $(this).val().toLowerCase();

        let filtered = guruList.filter(function (guru) {
            let text =
                String(guru.nip || '') + ' ' +
                String(guru.nama || '') + ' ' +
                String(guru.email || '') + ' ' +
                String(guru.no_hp || '') + ' ' +
                String(guru.mapel || '');

            return text.toLowerCase().includes(keyword);
        });

        renderGuru(filtered);
    });

    $(document).on('click', '.btnHapusGuru', function () {
        let id = $(this).data('id');

        if (confirm('Yakin hapus data guru?')) {
            $.ajax({
                url: apiUrl + '/' + id,
                type: 'DELETE',
                headers: { 
                    'Accept': 'application/json' 
                },
                success: function () {
                    loadGuru();
                },
                error: function () {
                    alert('Gagal menghapus data guru.');
                }
            });
        }
    });
});
</script>
@endsection