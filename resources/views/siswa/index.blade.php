@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
<div class="page">
    <div class="container">
        <div class="header">
            <h1>Data Siswa</h1>
            <p>Kelola data siswa menggunakan REST API Laravel.</p>
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
            <div id="tableSection">
                <div class="toolbar">
                    <input type="text" id="searchInput" placeholder="Cari NIS, nama, email, kelas, no HP, atau status...">

                    <button type="button" class="btn btn-primary" id="btnTambah">
                        <i class="fa-solid fa-plus"></i>
                        Tambah Siswa
                    </button>
                </div>

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
                                <td colspan="9" class="empty">Memuat data siswa...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="formSection" style="display:none;">
                <h3 id="formTitle">Tambah Siswa</h3>

                <form id="formSiswa">
                    <input type="hidden" id="siswa_id">

                    <label>NIS</label>
                    <input type="text" id="nis" required>

                    <label>Nama Siswa</label>
                    <input type="text" id="nama" required>

                    <label>Email</label>
                    <input type="email" id="email" required>

                    <label>Kelas</label>
                    <input type="text" id="kelas" required>

                    <label>Jenis Kelamin</label>
                    <select id="jenis_kelamin" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>

                    <label>Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir">

                    <label>No HP</label>
                    <input type="text" id="no_hp">

                    <label>Status</label>
                    <select id="status" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>

                    <label>Alamat</label>
                    <textarea id="alamat"></textarea>

                    <br><br>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i>
                        Simpan
                    </button>

                    <button type="button" class="btn btn-secondary" id="btnBatal">
                        Batal
                    </button>
                </form>
            </div>

            <div id="detailSection" style="display:none;"></div>
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
            headers: { 'Accept': 'application/json' },
            success: function (response) {
                siswaList = response.data || [];
                updateStats(siswaList);
                renderTable(siswaList);
            },
            error: function () {
                $('#dataSiswa').html('<tr><td colspan="9" class="empty">Gagal memuat data siswa.</td></tr>');
            }
        });
    }

    function updateStats(data) {
        var aktif = 0;
        var tidakAktif = 0;

        $.each(data, function (index, siswa) {
            if (siswa.status === 'Aktif') aktif++;
            if (siswa.status === 'Tidak Aktif') tidakAktif++;
        });

        $('#totalSiswa').text(data.length);
        $('#totalAktif').text(aktif);
        $('#totalTidakAktif').text(tidakAktif);
    }

    function safeHtml(value) {
        if (value === null || value === undefined || value === '') return '-';

        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function renderTable(data) {
        var rows = '';

        if (data.length === 0) {
            rows = '<tr><td colspan="9" class="empty">Belum ada data siswa.</td></tr>';
        } else {
            $.each(data, function (index, siswa) {
                var statusBadge = siswa.status === 'Aktif'
                    ? '<span class="badge badge-blue">Aktif</span>'
                    : '<span class="badge badge-red">Tidak Aktif</span>';

                rows +=
                    '<tr>' +
                        '<td>' + (index + 1) + '</td>' +
                        '<td>' + safeHtml(siswa.nis) + '</td>' +
                        '<td><strong>' + safeHtml(siswa.nama) + '</strong></td>' +
                        '<td>' + safeHtml(siswa.email) + '</td>' +
                        '<td>' + safeHtml(siswa.kelas) + '</td>' +
                        '<td>' + safeHtml(siswa.jenis_kelamin) + '</td>' +
                        '<td>' + safeHtml(siswa.no_hp) + '</td>' +
                        '<td>' + statusBadge + '</td>' +
                        '<td>' +
                            '<div class="action-group">' +
                                '<button type="button" class="btn btn-detail btnDetail" data-id="' + siswa.id + '">' +
                                    '<i class="fa-solid fa-eye"></i>' +
                                '</button>' +
                                '<button type="button" class="btn btn-edit btnEdit" data-id="' + siswa.id + '">' +
                                    '<i class="fa-solid fa-pen-to-square"></i>' +
                                '</button>' +
                                '<button type="button" class="btn btn-delete btnHapus" data-id="' + siswa.id + '">' +
                                    '<i class="fa-solid fa-trash"></i>' +
                                '</button>' +
                            '</div>' +
                        '</td>' +
                    '</tr>';
            });
        }

        $('#dataSiswa').html(rows);
    }

    function showTable() {
        $('#tableSection').show();
        $('#formSection').hide();
        $('#detailSection').hide();
    }

    function showForm() {
        $('#tableSection').hide();
        $('#formSection').show();
        $('#detailSection').hide();
    }

    function showDetail() {
        $('#tableSection').hide();
        $('#formSection').hide();
        $('#detailSection').show();
    }

    function resetForm() {
        $('#formSiswa')[0].reset();
        $('#siswa_id').val('');
        $('#status').val('Aktif');
    }

    $('#btnTambah').on('click', function () {
        resetForm();
        $('#formTitle').text('Tambah Siswa');
        showForm();
    });

    $('#btnBatal').on('click', function () {
        resetForm();
        showTable();
    });

    $('#formSiswa').on('submit', function (e) {
        e.preventDefault();

        var id = $('#siswa_id').val();
        var method = id ? 'PUT' : 'POST';
        var url = id ? apiUrl + '/' + id : apiUrl;

        $.ajax({
            url: url,
            type: method,
            headers: { 'Accept': 'application/json' },
            data: {
                nis: $('#nis').val(),
                nama: $('#nama').val(),
                email: $('#email').val(),
                kelas: $('#kelas').val(),
                jenis_kelamin: $('#jenis_kelamin').val(),
                tanggal_lahir: $('#tanggal_lahir').val(),
                no_hp: $('#no_hp').val(),
                status: $('#status').val(),
                alamat: $('#alamat').val()
            },
            success: function (response) {
                alert(response.message || 'Data siswa berhasil disimpan.');
                resetForm();
                showTable();
                loadSiswa();
            },
            error: function (xhr) {
                var message = 'Data siswa gagal disimpan.';

                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    message = Object.values(xhr.responseJSON.errors).flat().join('\n');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }

                alert(message);
            }
        });
    });

    $(document).on('click', '.btnDetail', function () {
        var id = $(this).data('id');

        $.ajax({
            url: apiUrl + '/' + id,
            type: 'GET',
            headers: { 'Accept': 'application/json' },
            success: function (response) {
                var siswa = response.data;

                $('#detailSection').html(
                    '<h3>Detail Siswa</h3>' +
                    '<p><b>NIS:</b> ' + safeHtml(siswa.nis) + '</p>' +
                    '<p><b>Nama:</b> ' + safeHtml(siswa.nama) + '</p>' +
                    '<p><b>Email:</b> ' + safeHtml(siswa.email) + '</p>' +
                    '<p><b>Kelas:</b> ' + safeHtml(siswa.kelas) + '</p>' +
                    '<p><b>Jenis Kelamin:</b> ' + safeHtml(siswa.jenis_kelamin) + '</p>' +
                    '<p><b>Tanggal Lahir:</b> ' + safeHtml(siswa.tanggal_lahir) + '</p>' +
                    '<p><b>No HP:</b> ' + safeHtml(siswa.no_hp) + '</p>' +
                    '<p><b>Status:</b> ' + safeHtml(siswa.status) + '</p>' +
                    '<p><b>Alamat:</b> ' + safeHtml(siswa.alamat) + '</p>' +
                    '<br>' +
                    '<button type="button" class="btn btn-primary btnEdit" data-id="' + siswa.id + '">Edit</button> ' +
                    '<button type="button" class="btn btn-secondary" id="btnKembaliDetail">Kembali</button>'
                );

                showDetail();
            },
            error: function () {
                alert('Detail siswa gagal dimuat.');
            }
        });
    });

    $(document).on('click', '#btnKembaliDetail', function () {
        showTable();
    });

    $(document).on('click', '.btnEdit', function () {
        var id = $(this).data('id');

        $.ajax({
            url: apiUrl + '/' + id,
            type: 'GET',
            headers: { 'Accept': 'application/json' },
            success: function (response) {
                var siswa = response.data;

                $('#formTitle').text('Edit Siswa');
                $('#siswa_id').val(siswa.id);
                $('#nis').val(siswa.nis);
                $('#nama').val(siswa.nama);
                $('#email').val(siswa.email);
                $('#kelas').val(siswa.kelas);
                $('#jenis_kelamin').val(siswa.jenis_kelamin);
                $('#tanggal_lahir').val(siswa.tanggal_lahir);
                $('#no_hp').val(siswa.no_hp);
                $('#status').val(siswa.status);
                $('#alamat').val(siswa.alamat);

                showForm();
            },
            error: function () {
                alert('Data siswa gagal dimuat.');
            }
        });
    });

    $(document).on('click', '.btnHapus', function () {
        var id = $(this).data('id');

        if (confirm('Yakin ingin menghapus data siswa ini?')) {
            $.ajax({
                url: apiUrl + '/' + id,
                type: 'DELETE',
                headers: { 'Accept': 'application/json' },
                success: function (response) {
                    alert(response.message || 'Data siswa berhasil dihapus.');
                    loadSiswa();
                },
                error: function () {
                    alert('Data siswa gagal dihapus.');
                }
            });
        }
    });

    $('#searchInput').on('keyup', function () {
        var keyword = $(this).val().toLowerCase();

        var filtered = siswaList.filter(function (siswa) {
            var gabungan =
                String(siswa.nis || '') + ' ' +
                String(siswa.nama || '') + ' ' +
                String(siswa.email || '') + ' ' +
                String(siswa.kelas || '') + ' ' +
                String(siswa.jenis_kelamin || '') + ' ' +
                String(siswa.no_hp || '') + ' ' +
                String(siswa.status || '');

            return gabungan.toLowerCase().indexOf(keyword) !== -1;
        });

        renderTable(filtered);
    });
});
</script>
@endsection