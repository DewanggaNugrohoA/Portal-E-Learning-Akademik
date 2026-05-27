@extends('layouts.app')

@section('title', 'Data Nilai')

@section('content')
<div class="page">
    <div class="container">
        <div class="header">
            <h1>Manajemen Data Nilai</h1>
            <p>Kelola nilai siswa, KKM, predikat, dan keterangan secara otomatis.</p>
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
                    <div class="search-box">
                        <input type="text" id="searchInput" placeholder="Cari siswa, mata pelajaran, nilai, KKM, atau predikat...">
                    </div>

                    <button type="button" class="btn btn-primary" id="btnTambah">
                        <i class="fa-solid fa-plus"></i>
                        Tambah Nilai
                    </button>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Siswa</th>
                                <th>Mata Pelajaran</th>
                                <th>Nilai</th>
                                <th>KKM</th>
                                <th>Predikat</th>
                                <th>Keterangan</th>
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

            <div id="formSection" style="display:none;">
                <h3 id="formTitle">Tambah Nilai</h3>

                <form id="formNilai">
                    <input type="hidden" id="nilai_id">

                    <label>Siswa</label>
                    <select id="siswa_id" required></select>

                    <label>Mata Pelajaran</label>
                    <select id="mata_pelajaran_id" required></select>

                    <label>Nilai</label>
                    <input type="number" id="nilai" min="0" max="100" required>

                    <label>KKM</label>
                    <input type="number" id="kkm" min="0" max="100" required>

                    <div style="margin-top:16px; padding:14px; border-radius:14px; background:#eff6ff; color:#1e3a8a;">
                        Predikat dan keterangan akan otomatis dihitung dari nilai dan KKM.
                        <br>A = 90-100, B = 80-89, C = 70-79, D = kurang dari 70
                    </div>

                    <br>

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

<style>
    .swal-modern {
        border-radius: 28px !important;
        padding: 28px !important;
    }

    .swal-confirm {
        background: #1e3a8a !important;
        color: white !important;
        border: none !important;
        border-radius: 16px !important;
        padding: 14px 22px !important;
        font-weight: 700 !important;
    }

    .swal-danger {
        background: #dc2626 !important;
        color: white !important;
        border: none !important;
        border-radius: 16px !important;
        padding: 14px 22px !important;
        font-weight: 700 !important;
    }

    .swal-cancel {
        background: #f1f5f9 !important;
        color: #334155 !important;
        border: none !important;
        border-radius: 16px !important;
        padding: 14px 22px !important;
        font-weight: 700 !important;
    }

    .swal2-actions {
        gap: 12px !important;
    }
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    var apiUrl = '/api/nilai';
    var siswaUrl = '/api/siswa';
    var mataPelajaranUrl = '/api/mata-pelajaran';
    var nilaiList = [];

    loadNilai();

    function loadNilai() {
        $.ajax({
            url: apiUrl,
            type: 'GET',
            headers: { 'Accept': 'application/json' },
            success: function (response) {
                nilaiList = response.data || [];
                $('#totalNilai').text(nilaiList.length);
                
                renderTable(nilaiList);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                $('#dataNilai').html('<tr><td colspan="8" class="empty" style="color:#dc2626;">Gagal memuat data nilai.</td></tr>');
            }
        });
    }

    function loadSiswa(selectedId = '') {
        $.ajax({
            url: siswaUrl,
            type: 'GET',
            headers: { 'Accept': 'application/json' },
            success: function (response) {
                var options = '<option value="">-- Pilih Siswa --</option>';

                $.each(response.data || [], function (index, siswa) {
                    var selected = siswa.id == selectedId ? 'selected' : '';
                    options += '<option value="' + siswa.id + '" ' + selected + '>' +
                        safeHtml(siswa.nama) +
                        '</option>';
                });

                $('#siswa_id').html(options);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    function loadMataPelajaran(selectedId = '') {
        $.ajax({
            url: mataPelajaranUrl,
            type: 'GET',
            headers: { 'Accept': 'application/json' },
            success: function (response) {
                var options = '<option value="">-- Pilih Mata Pelajaran --</option>';

                $.each(response.data || [], function (index, mapel) {
                    var selected = mapel.id == selectedId ? 'selected' : '';
                    options += '<option value="' + mapel.id + '" ' + selected + '>' +
                        safeHtml(mapel.nama_mata_pelajaran) +
                        '</option>';
                });

                $('#mata_pelajaran_id').html(options);
            },
            error: function (xhr) {
                console.log(xhr.responseText);

                showErrorPopup(
                    'Gagal!',
                    xhr.responseJSON?.message || 'Data mata pelajaran gagal dimuat.'
                );
            }
        });
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

    function getSiswaName(nilai) {
        return nilai.siswa && nilai.siswa.nama ? nilai.siswa.nama : '-';
    }

    function getMataPelajaranName(nilai) {
        if (nilai.mata_pelajaran && nilai.mata_pelajaran.nama_mata_pelajaran) {
            return nilai.mata_pelajaran.nama_mata_pelajaran;
        }

        if (nilai.mataPelajaran && nilai.mataPelajaran.nama_mata_pelajaran) {
            return nilai.mataPelajaran.nama_mata_pelajaran;
        }

        return '-';
    }

    function showSuccessPopup(title, message) {
        Swal.fire({
            title: title,
            html: '<p style="color:#64748b; margin:0; font-size:15px; line-height:1.6;">' + message + '</p>',
            icon: 'success',
            width: '480px',
            background: '#ffffff',
            buttonsStyling: false,
            customClass: {
                popup: 'swal-modern',
                confirmButton: 'swal-confirm'
            },
            confirmButtonText: 'Oke'
        });
    }

    function showErrorPopup(title, message) {
        Swal.fire({
            title: title,
            html: '<p style="color:#64748b; margin:0; font-size:15px; line-height:1.6;">' + message + '</p>',
            icon: 'error',
            width: '480px',
            background: '#ffffff',
            buttonsStyling: false,
            customClass: {
                popup: 'swal-modern',
                confirmButton: 'swal-danger'
            },
            confirmButtonText: 'Tutup'
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
                        '<td>' + safeHtml(getSiswaName(nilai)) + '</td>' +
                        '<td>' + safeHtml(getMataPelajaranName(nilai)) + '</td>' +
                        '<td><span class="badge badge-blue">' + safeHtml(nilai.nilai) + '</span></td>' +
                        '<td><span class="badge badge-blue">' + safeHtml(nilai.kkm) + '</span></td>' +
                        '<td>' + safeHtml(nilai.predikat) + '</td>' +
                        '<td>' + safeHtml(nilai.keterangan) + '</td>' +
                        '<td>' +
                            '<div class="action-group">' +
                                '<button type="button" class="btn btn-detail btn-icon btnDetail" data-id="' + nilai.id + '">' +
                                    '<i class="fa-solid fa-eye"></i>' +
                                '</button>' +
                                '<button type="button" class="btn btn-edit btn-icon btnEdit" data-id="' + nilai.id + '">' +
                                    '<i class="fa-solid fa-pen-to-square"></i>' +
                                '</button>' +
                                '<button type="button" class="btn btn-delete btn-icon btnHapus" data-id="' + nilai.id + '">' +
                                    '<i class="fa-solid fa-trash"></i>' +
                                '</button>' +
                            '</div>' +
                        '</td>' +
                    '</tr>';
            });
        }

        $('#dataNilai').html(rows);
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

    $('#btnTambah').on('click', function () {
        $('#formTitle').text('Tambah Nilai');
        $('#nilai_id').val('');
        $('#formNilai')[0].reset();

        loadSiswa();
        loadMataPelajaran();
        showForm();
    });

    $('#btnBatal').on('click', function () {
        $('#formNilai')[0].reset();
        showTable();
    });

    $('#formNilai').on('submit', function (e) {
        e.preventDefault();

        var id = $('#nilai_id').val();
        var method = id ? 'PUT' : 'POST';
        var url = id ? apiUrl + '/' + id : apiUrl;
        var actionText = id ? 'memperbarui' : 'menyimpan';

        Swal.fire({
            title: id ? 'Update Data Nilai?' : 'Simpan Data Nilai?',
            html: '<p style="color:#64748b; margin-bottom:18px; font-size:15px; line-height:1.6;">Pastikan data siswa, mata pelajaran, nilai, dan KKM sudah benar sebelum ' + actionText + ' data.</p>',
            width: '520px',
            showCancelButton: true,
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            background: '#ffffff',
            buttonsStyling: false,
            customClass: {
                popup: 'swal-modern',
                confirmButton: 'swal-confirm',
                cancelButton: 'swal-cancel'
            }
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: method,
                    headers: { 'Accept': 'application/json' },
                    data: {
                        siswa_id: $('#siswa_id').val(),
                        mata_pelajaran_id: $('#mata_pelajaran_id').val(),
                        nilai: $('#nilai').val(),
                        kkm: $('#kkm').val()
                    },
                    success: function (response) {
                        $('#formNilai')[0].reset();
                        showTable();
                        loadNilai();

                        showSuccessPopup(
                            'Berhasil!',
                            response.message || 'Data nilai berhasil disimpan.'
                        );
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);

                        showErrorPopup(
                            'Gagal!',
                            xhr.responseJSON?.message || 'Data nilai gagal disimpan.'
                        );
                    }
                });
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
                var nilai = response.data;

                $('#detailSection').html(
                    '<h3>Detail Nilai</h3>' +
                    '<p><b>Siswa:</b> ' + safeHtml(getSiswaName(nilai)) + '</p>' +
                    '<p><b>Mata Pelajaran:</b> ' + safeHtml(getMataPelajaranName(nilai)) + '</p>' +
                    '<p><b>Nilai:</b> ' + safeHtml(nilai.nilai) + '</p>' +
                    '<p><b>KKM:</b> ' + safeHtml(nilai.kkm) + '</p>' +
                    '<p><b>Predikat:</b> ' + safeHtml(nilai.predikat) + '</p>' +
                    '<p><b>Keterangan:</b> ' + safeHtml(nilai.keterangan) + '</p>' +
                    '<br>' +
                    '<button type="button" class="btn btn-primary btnEdit" data-id="' + nilai.id + '">Edit</button> ' +
                    '<button type="button" class="btn btn-secondary" id="btnKembaliDetail">Kembali</button>'
                );

                showDetail();
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                showErrorPopup('Gagal!', 'Detail nilai gagal dimuat.');
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
                var nilai = response.data;

                $('#formTitle').text('Edit Nilai');
                $('#nilai_id').val(nilai.id);
                $('#nilai').val(nilai.nilai);
                $('#kkm').val(nilai.kkm);

                loadSiswa(nilai.siswa_id);
                loadMataPelajaran(nilai.mata_pelajaran_id);
                showForm();
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                showErrorPopup('Gagal!', 'Data nilai gagal dimuat.');
            }
        });
    });

    $(document).on('click', '.btnHapus', function () {
        var id = $(this).data('id');

        Swal.fire({
            title: 'Hapus Data Nilai?',
            html: '<p style="color:#64748b; margin-bottom:18px; font-size:15px; line-height:1.6;">Data nilai yang dihapus tidak dapat dikembalikan.</p>',
            width: '520px',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            background: '#ffffff',
            buttonsStyling: false,
            customClass: {
                popup: 'swal-modern',
                confirmButton: 'swal-danger',
                cancelButton: 'swal-cancel'
            }
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: apiUrl + '/' + id,
                    type: 'DELETE',
                    headers: { 'Accept': 'application/json' },
                    success: function (response) {
                        loadNilai();

                        showSuccessPopup(
                            'Berhasil Dihapus!',
                            response.message || 'Data nilai berhasil dihapus.'
                        );
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                        showErrorPopup('Gagal!', 'Data nilai gagal dihapus.');
                    }
                });
            }
        });
    });

    $('#searchInput').on('keyup', function () {
        var keyword = $(this).val().toLowerCase();

        var filtered = nilaiList.filter(function (nilai) {
            var gabungan =
                String(getSiswaName(nilai) || '') + ' ' +
                String(getMataPelajaranName(nilai) || '') + ' ' +
                String(nilai.nilai || '') + ' ' +
                String(nilai.kkm || '') + ' ' +
                String(nilai.predikat || '') + ' ' +
                String(nilai.keterangan || '');

            return gabungan.toLowerCase().indexOf(keyword) !== -1;
        });

        renderTable(filtered);
    });
});
</script>
@endsection