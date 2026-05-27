@extends('layouts.app')

@section('title', 'Data Nilai')

@section('content')
<div class="page">
    <div class="container">
        <div class="header">
            <h1>Data Nilai</h1>
            <p>Data nilai ditampilkan menggunakan API dari endpoint /api/nilai.</p>
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
                <h2>Karina</h2>
            </div>
        </div>

        <div class="panel">
            <div id="tableSection">
                <div class="toolbar">
                    <div>
                        <h2 style="margin:0;">Daftar Nilai</h2>
                        <p style="margin:6px 0 0; color:#64748b;">
                            Kelola data nilai menggunakan API.
                        </p>
                    </div>

                    <button type="button" class="btn btn-primary" id="btnTambah">
                        <i class="fa-solid fa-plus"></i>
                        Tambah Nilai
                    </button>
                </div>

                <div style="margin-bottom:18px;">
                    <input type="text" id="searchInput" placeholder="Cari guru, KKM, atau predikat...">
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

            <div id="formSection" style="display:none;">
                <div class="toolbar">
                    <div>
                        <h2 id="formTitle" style="margin:0;">Tambah Nilai</h2>
                        <p style="margin:6px 0 0; color:#64748b;">
                            Form ini diproses menggunakan AJAX tanpa reload halaman.
                        </p>
                    </div>
                </div>

                <form id="formNilai">
                    <input type="hidden" id="nilai_id">

                    <div class="form-grid">
                        <div class="form-group">
                            <label>Guru</label>
                            <select id="guru_id" required>
                                <option value="">-- Pilih Guru --</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>KKM</label>
                            <input type="number" id="kkm" min="0" max="100" required>
                        </div>

                        <div class="form-group full">
                            <label>Deskripsi Predikat A</label>
                            <textarea id="deskripsi_a" required></textarea>
                        </div>

                        <div class="form-group full">
                            <label>Deskripsi Predikat B</label>
                            <textarea id="deskripsi_b" required></textarea>
                        </div>

                        <div class="form-group full">
                            <label>Deskripsi Predikat C</label>
                            <textarea id="deskripsi_c" required></textarea>
                        </div>

                        <div class="form-group full">
                            <label>Deskripsi Predikat D</label>
                            <textarea id="deskripsi_d" required></textarea>
                        </div>
                    </div>

                    <div class="actions">
                        <button type="button" class="btn btn-secondary" id="btnBatal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="btnSimpan">
                            <i class="fa-solid fa-save"></i>
                            Simpan
                        </button>
                    </div>
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
    var apiUrl = '/api/nilai';
    var guruUrl = '/api/guru-list';
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
                $('#totalNilai').text(nilaiList.length);
                renderTable(nilaiList);
            },
            error: function () {
                $('#nilaiTable').html(
                    '<tr><td colspan="8" class="empty">Gagal memuat data nilai.</td></tr>'
                );
            }
        });
    }

    function loadGuru(selectedId) {
        $.ajax({
            url: guruUrl,
            type: 'GET',
            headers: {
                'Accept': 'application/json'
            },
            success: function (response) {
                var options = '<option value="">-- Pilih Guru --</option>';

                $.each(response.data || [], function (index, guru) {
                    var selected = guru.id == selectedId ? 'selected' : '';
                    options += '<option value="' + guru.id + '" ' + selected + '>' + safeHtml(guru.nama) + '</option>';
                });

                $('#guru_id').html(options);
            },
            error: function () {
                showError('Gagal memuat data guru.');
            }
        });
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
                        '<td><strong>' + safeHtml(getGuruName(nilai)) + '</strong></td>' +
                        '<td><span class="badge badge-blue">' + safeHtml(nilai.kkm) + '</span></td>' +
                        '<td>' + safeHtml(nilai.deskripsi_a) + '</td>' +
                        '<td>' + safeHtml(nilai.deskripsi_b) + '</td>' +
                        '<td>' + safeHtml(nilai.deskripsi_c) + '</td>' +
                        '<td>' + safeHtml(nilai.deskripsi_d) + '</td>' +
                        '<td>' +
                            '<div class="action-group">' +
                                '<button type="button" class="btn btn-detail btnDetail" data-id="' + nilai.id + '">' +
                                    '<i class="fa-solid fa-eye"></i>' +
                                '</button>' +

                                '<button type="button" class="btn btn-edit btnEdit" data-id="' + nilai.id + '">' +
                                    '<i class="fa-solid fa-pen"></i>' +
                                '</button>' +

                                '<button type="button" class="btn btn-delete btnHapus" data-id="' + nilai.id + '">' +
                                    '<i class="fa-solid fa-trash"></i>' +
                                '</button>' +
                            '</div>' +
                        '</td>' +
                    '</tr>';
            });
        }

        $('#nilaiTable').html(rows);
    }

    $('#btnTambah').on('click', function () {
        $('#formTitle').text('Tambah Nilai');
        $('#nilai_id').val('');
        $('#formNilai')[0].reset();
        loadGuru('');
        showForm();
    });

    $('#btnBatal').on('click', function () {
        showTable();
    });

    $('#formNilai').on('submit', function (e) {
        e.preventDefault();

        var id = $('#nilai_id').val();
        var method = id ? 'PUT' : 'POST';
        var url = id ? apiUrl + '/' + id : apiUrl;

        $('#btnSimpan').prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: url,
            type: method,
            headers: {
                'Accept': 'application/json'
            },
            data: {
                guru_id: $('#guru_id').val(),
                kkm: $('#kkm').val(),
                deskripsi_a: $('#deskripsi_a').val(),
                deskripsi_b: $('#deskripsi_b').val(),
                deskripsi_c: $('#deskripsi_c').val(),
                deskripsi_d: $('#deskripsi_d').val()
            },
            success: function (response) {
                $('#btnSimpan').prop('disabled', false).html('<i class="fa-solid fa-save"></i> Simpan');
                $('#formNilai')[0].reset();

                Swal.fire({
                    title: 'Berhasil!',
                    text: response.message || 'Data nilai berhasil disimpan.',
                    icon: 'success',
                    confirmButtonColor: '#1e3a8a'
                });

                showTable();
                loadNilai();
            },
            error: function (xhr) {
                $('#btnSimpan').prop('disabled', false).html('<i class="fa-solid fa-save"></i> Simpan');

                Swal.fire({
                    title: 'Gagal!',
                    text: getErrorMessage(xhr, 'Data nilai gagal disimpan.'),
                    icon: 'error',
                    confirmButtonColor: '#b91c1c'
                });
            }
        });
    });

    $(document).on('click', '.btnDetail', function () {
        var id = $(this).data('id');

        $.ajax({
            url: apiUrl + '/' + id,
            type: 'GET',
            headers: {
                'Accept': 'application/json'
            },
            success: function (response) {
                var nilai = response.data;

                $('#detailSection').html(
                    '<div class="toolbar">' +
                        '<div>' +
                            '<h2 style="margin:0;">Detail Nilai</h2>' +
                            '<p style="margin:6px 0 0; color:#64748b;">Detail data nilai dari API.</p>' +
                        '</div>' +
                    '</div>' +

                    '<div class="data-grid">' +
                        '<div class="data-item">' +
                            '<div class="label">Nama Guru</div>' +
                            '<div class="value">' + safeHtml(getGuruName(nilai)) + '</div>' +
                        '</div>' +

                        '<div class="data-item">' +
                            '<div class="label">KKM</div>' +
                            '<div class="value">' + safeHtml(nilai.kkm) + '</div>' +
                        '</div>' +

                        '<div class="data-item full">' +
                            '<div class="label">Deskripsi Predikat A</div>' +
                            '<div class="value">' + safeHtml(nilai.deskripsi_a) + '</div>' +
                        '</div>' +

                        '<div class="data-item full">' +
                            '<div class="label">Deskripsi Predikat B</div>' +
                            '<div class="value">' + safeHtml(nilai.deskripsi_b) + '</div>' +
                        '</div>' +

                        '<div class="data-item full">' +
                            '<div class="label">Deskripsi Predikat C</div>' +
                            '<div class="value">' + safeHtml(nilai.deskripsi_c) + '</div>' +
                        '</div>' +

                        '<div class="data-item full">' +
                            '<div class="label">Deskripsi Predikat D</div>' +
                            '<div class="value">' + safeHtml(nilai.deskripsi_d) + '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div class="actions">' +
                        '<button type="button" class="btn btn-secondary" id="btnKembaliDetail">Kembali</button>' +
                        '<button type="button" class="btn btn-edit btnEdit" data-id="' + nilai.id + '">' +
                            '<i class="fa-solid fa-pen"></i> Edit' +
                        '</button>' +
                    '</div>'
                );

                showDetail();
            },
            error: function () {
                showError('Gagal memuat detail nilai.');
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
            headers: {
                'Accept': 'application/json'
            },
            success: function (response) {
                var nilai = response.data;

                $('#formTitle').text('Edit Nilai');
                $('#nilai_id').val(nilai.id);
                $('#kkm').val(nilai.kkm);
                $('#deskripsi_a').val(nilai.deskripsi_a);
                $('#deskripsi_b').val(nilai.deskripsi_b);
                $('#deskripsi_c').val(nilai.deskripsi_c);
                $('#deskripsi_d').val(nilai.deskripsi_d);

                loadGuru(nilai.guru_id);
                showForm();
            },
            error: function () {
                showError('Data nilai gagal dimuat.');
            }
        });
    });

    $(document).on('click', '.btnHapus', function () {
        var id = $(this).data('id');

        Swal.fire({
            title: 'Hapus Data?',
            text: 'Data nilai yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#b91c1c',
            cancelButtonColor: '#64748b'
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
                            text: response.message || 'Data nilai berhasil dihapus.',
                            icon: 'success',
                            confirmButtonColor: '#1e3a8a'
                        });

                        loadNilai();
                    },
                    error: function () {
                        showError('Data nilai gagal dihapus.');
                    }
                });
            }
        });
    });

    $('#searchInput').on('keyup', function () {
        var keyword = $(this).val().toLowerCase();

        var filtered = nilaiList.filter(function (nilai) {
            var gabungan =
                getGuruName(nilai) + ' ' +
                nilai.kkm + ' ' +
                nilai.deskripsi_a + ' ' +
                nilai.deskripsi_b + ' ' +
                nilai.deskripsi_c + ' ' +
                nilai.deskripsi_d;

            return gabungan.toLowerCase().indexOf(keyword) !== -1;
        });

        renderTable(filtered);
    });

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

    function getGuruName(nilai) {
        return nilai.guru && nilai.guru.nama ? nilai.guru.nama : '-';
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

    function showError(message) {
        Swal.fire({
            title: 'Gagal!',
            text: message,
            icon: 'error',
            confirmButtonColor: '#b91c1c'
        });
    }
});
</script>
@endsection