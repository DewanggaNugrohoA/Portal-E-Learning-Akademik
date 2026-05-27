@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
<div class="page">
    <div class="container">

        <!-- HEADER -->
        <div class="header">
            <h1>Data Siswa</h1>
            <p>Data siswa ditampilkan menggunakan API dari endpoint /api/siswa.</p>
        </div>

        <!-- CARD -->
        <div class="stat-grid">

            <div class="stat-card">
                <span>Total Siswa</span>
                <h2 id="totalSiswa">0</h2>
            </div>

            <div class="stat-card">
                <span>Modul</span>
                <h2>Siswa</h2>
            </div>

            <div class="stat-card">
                <span>Penanggung Jawab</span>
                <h2>Sevi</h2>
            </div>

        </div>

        <!-- PANEL -->
        <div class="panel">

            <!-- TOOLBAR -->
            <div class="toolbar">

                <input
                    type="text"
                    id="searchSiswa"
                    placeholder="Cari NIS, nama, email, kelas, no HP, atau status..."
                >

                <a href="/siswa/create" class="btn btn-primary">
                <div>
                    <h2>Daftar Siswa</h2>
                    <p style="margin:6px 0 0; color:#64748b;">
                        Kelola data siswa menggunakan REST API Laravel.
                    </p>
                </div>

                <a href="{{ url('/siswa/create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Siswa
                </a>

            </div>

            <!-- TABLE -->
            <div class="table-wrapper">

                <table>

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>
                            <th>No HP</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="dataSiswa">

                        <tr>
                            <td colspan="9" class="empty">
                                Memuat data siswa...
                            </td>
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

                $('#totalSiswa').text(siswaList.length);

                renderSiswa(siswaList);

            },

            error: function () {

                $('#dataSiswa').html(
                    '<tr><td colspan="9" class="empty">Gagal memuat data siswa.</td></tr>'
                );

            }

        });

    }
    const dataSiswa = document.getElementById('dataSiswa');
    const totalSiswa = document.getElementById('totalSiswa');
    const totalAktif = document.getElementById('totalAktif');
    const totalTidakAktif = document.getElementById('totalTidakAktif');

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

    function renderSiswa(data) {

        var rows = '';

        if (data.length === 0) {

            rows = `
                <tr>
                    <td colspan="9" class="empty">
                        Belum ada data siswa.
                    </td>
                </tr>
            `;

        } else {

            $.each(data, function (index, siswa) {

                var statusBadge = siswa.status === 'Aktif'
                    ? '<span class="badge badge-blue">Aktif</span>'
                    : '<span class="badge badge-red">Tidak Aktif</span>';
    async function loadSiswa() {
        try {
            const response = await fetch('/api/siswa', {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();
            const siswaList = result.data ?? [];

            totalSiswa.textContent = siswaList.length;
            totalAktif.textContent = siswaList.filter(siswa => siswa.status === 'Aktif').length;
            totalTidakAktif.textContent = siswaList.filter(siswa => siswa.status === 'Tidak Aktif').length;

            dataSiswa.innerHTML = '';

            if (siswaList.length === 0) {
                dataSiswa.innerHTML = `
                    <tr>
                        <td colspan="9" class="empty">Belum ada data siswa.</td>
                    </tr>
                `;
                return;
            }

            siswaList.forEach((siswa, index) => {
                const statusBadge = siswa.status === 'Aktif'
                    ? `<span class="badge badge-blue">Aktif</span>`
                    : `<span class="badge badge-red">Tidak Aktif</span>`;

                dataSiswa.innerHTML += `
                    <tr>

                        <td>${index + 1}</td>

                        <td>${safeHtml(siswa.nis)}</td>

                        <td>
                            <strong>${safeHtml(siswa.nama)}</strong>
                        </td>

                        <td>${safeHtml(siswa.email)}</td>

                        <td>${safeHtml(siswa.kelas)}</td>

                        <td>${safeHtml(siswa.jenis_kelamin)}</td>

                        <td>${safeHtml(siswa.no_hp)}</td>

                        <td>${statusBadge}</td>

                        <td>

                            <div class="action-group">

                                <a href="/siswa/${siswa.id}" class="btn btn-detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="/siswa/${siswa.id}/edit" class="btn btn-edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <button
                                    class="btn btn-delete btnHapusSiswa"
                                    data-id="${siswa.id}"
                                >
                                <button type="button" onclick="deleteSiswa(${siswa.id})" class="btn btn-delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                            </div>

                        </td>

                    </tr>
                `;

            });

        }

        $('#dataSiswa').html(rows);

    }

    // DELETE
    $(document).on('click', '.btnHapusSiswa', function () {

        var id = $(this).data('id');

        if (confirm('Yakin ingin menghapus data siswa ini?')) {

            $.ajax({

                url: apiUrl + '/' + id,
                type: 'DELETE',

                headers: {
                    'Accept': 'application/json'
                },

                success: function (response) {

                    alert(response.message || 'Data siswa berhasil dihapus.');

                    loadSiswa();

                },

                error: function () {

                    alert('Gagal menghapus data siswa.');

        } catch (error) {
            dataSiswa.innerHTML = `
                <tr>
                    <td colspan="9" class="empty">Gagal memuat data siswa dari API.</td>
                </tr>
            `;
        }
    }

    async function deleteSiswa(id) {
        const konfirmasi = confirm('Yakin ingin menghapus data siswa ini?');

        if (!konfirmasi) {
            return;
        }

        try {
            const response = await fetch(`/api/siswa/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                }

            });

        }

    });

    // SEARCH
    $('#searchSiswa').on('keyup', function () {

        var keyword = $(this).val().toLowerCase();

        var filtered = siswaList.filter(function (siswa) {

            var text =
                String(siswa.nis || '') + ' ' +
                String(siswa.nama || '') + ' ' +
                String(siswa.email || '') + ' ' +
                String(siswa.kelas || '') + ' ' +
                String(siswa.jenis_kelamin || '') + ' ' +
                String(siswa.no_hp || '') + ' ' +
                String(siswa.status || '');

            return text.toLowerCase().indexOf(keyword) !== -1;

        });

        renderSiswa(filtered);

    });

});
            const result = await response.json();

            alert(result.message ?? 'Data siswa berhasil dihapus.');
            loadSiswa();
        } catch (error) {
            alert('Gagal menghapus data siswa.');
        }
    }

    loadSiswa();
</script>
@endsection