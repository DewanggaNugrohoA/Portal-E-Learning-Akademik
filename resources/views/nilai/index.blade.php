<div class="page">
    <div class="container">
        <div class="header">
            <h1>Manajemen Data Nilai</h1>
            <p>Kelola KKM dan deskripsi predikat nilai secara otomatis.</p>
        </div>

        <div class="panel">
            <div id="tableSection">
                <div class="toolbar">
                    <div class="search-box">
                        <input type="text" id="searchInput" placeholder="Cari guru, KKM, atau predikat...">
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

            <div id="formSection" style="display:none;">
                <h3 id="formTitle">Tambah Nilai</h3>

                <form id="formNilai">
                    <input type="hidden" id="nilai_id">

                    <label>Guru</label>
                    <select id="guru_id" required></select>

                    <label>KKM</label>
                    <input type="number" id="kkm" min="0" max="100" required>

                    <div style="margin-top:16px; padding:14px; border-radius:14px; background:#eff6ff; color:#1e3a8a;">
                        Deskripsi predikat akan otomatis tersimpan:
                        <br>A = Sangat Baik, B = Baik, C = Cukup, D = Kurang
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i>
                        Simpan
                    </button>
                    <button type="button" class="btn btn-secondary" id="btnBatal">Batal</button>
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
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
    box-shadow: 0 10px 25px rgba(30, 58, 138, 0.25);
}

.swal-danger {
    background: #dc2626 !important;
    color: white !important;
    border: none !important;
    border-radius: 16px !important;
    padding: 14px 22px !important;
    font-weight: 700 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
    box-shadow: 0 10px 25px rgba(220, 38, 38, 0.25);
}

.swal-cancel {
    background: #f1f5f9 !important;
    color: #334155 !important;
    border: none !important;
    border-radius: 16px !important;
    padding: 14px 22px !important;
    font-weight: 700 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
}

.swal2-actions {
    gap: 12px !important;
}
</style>

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
            headers: { 'Accept': 'application/json' },
            success: function (response) {
                nilaiList = response.data || [];
                renderTable(nilaiList);
            },
            error: function () {
                $('#dataNilai').html('<tr><td colspan="8" class="empty" style="color:#dc2626;">Gagal memuat data nilai.</td></tr>');
            }
        });
    }

    function loadGuru(selectedId = '') {
        $.ajax({
            url: guruUrl,
            type: 'GET',
            headers: { 'Accept': 'application/json' },
            success: function (response) {
                var options = '<option value="">-- Pilih Guru --</option>';

                $.each(response.data || [], function (index, guru) {
                    var selected = guru.id == selectedId ? 'selected' : '';
                    options += '<option value="' + guru.id + '" ' + selected + '>' + safeHtml(guru.nama) + '</option>';
                });

                $('#guru_id').html(options);
            },
            error: function () {
                showErrorPopup('Gagal Memuat Guru', 'Data guru gagal dimuat. Pastikan API guru aktif.');
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

    function getGuruName(nilai) {
        return nilai.guru && nilai.guru.nama ? nilai.guru.nama : '-';
    }

    function showSuccessPopup(title, message) {
        Swal.fire({
            title: title,
            html: `
                <p style="color:#64748b; margin:0; font-size:15px; line-height:1.6;">
                    ${message}
                </p>
            `,
            icon: 'success',
            width: '480px',
            background: '#ffffff',
            buttonsStyling: false,
            customClass: {
                popup: 'swal-modern',
                confirmButton: 'swal-confirm'
            },
            confirmButtonText: `
                <i class="fa-solid fa-check"></i>
                Oke
            `
        });
    }

    function showErrorPopup(title, message) {
        Swal.fire({
            title: title,
            html: `
                <p style="color:#64748b; margin:0; font-size:15px; line-height:1.6;">
                    ${message}
                </p>
            `,
            icon: 'error',
            width: '480px',
            background: '#ffffff',
            buttonsStyling: false,
            customClass: {
                popup: 'swal-modern',
                confirmButton: 'swal-danger'
            },
            confirmButtonText: `
                <i class="fa-solid fa-xmark"></i>
                Tutup
            `
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
                        '<td>' + safeHtml(getGuruName(nilai)) + '</td>' +
                        '<td><span class="badge badge-blue">' + safeHtml(nilai.kkm) + '</span></td>' +
                        '<td>' + safeHtml(nilai.deskripsi_a) + '</td>' +
                        '<td>' + safeHtml(nilai.deskripsi_b) + '</td>' +
                        '<td>' + safeHtml(nilai.deskripsi_c) + '</td>' +
                        '<td>' + safeHtml(nilai.deskripsi_d) + '</td>' +
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
        loadGuru();
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
            html: `
                <p style="color:#64748b; margin-bottom:18px; font-size:15px; line-height:1.6;">
                    Pastikan data guru dan KKM sudah benar sebelum ${actionText} data.
                </p>

                <div style="
                    background:#eff6ff;
                    border:1px solid #bfdbfe;
                    border-radius:18px;
                    padding:16px;
                    text-align:left;
                ">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <div style="
                            width:42px;
                            height:42px;
                            border-radius:12px;
                            background:#dbeafe;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            color:#1e3a8a;
                            font-size:18px;
                        ">
                            <i class="fa-solid fa-clipboard-check"></i>
                        </div>

                        <div>
                            <div style="font-weight:700; color:#0f172a; margin-bottom:4px;">
                                Data nilai akan diproses
                            </div>
                            <div style="color:#64748b; font-size:14px;">
                                Predikat A-D akan otomatis tersimpan.
                            </div>
                        </div>
                    </div>
                </div>
            `,
            width: '520px',
            showCancelButton: true,
            confirmButtonText: `
                <i class="fa-solid fa-save"></i>
                Ya, Simpan
            `,
            cancelButtonText: `
                <i class="fa-solid fa-xmark"></i>
                Batal
            `,
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
                        guru_id: $('#guru_id').val(),
                        kkm: $('#kkm').val(),
                        deskripsi_a: 'Sangat Baik',
                        deskripsi_b: 'Baik',
                        deskripsi_c: 'Cukup',
                        deskripsi_d: 'Kurang'
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
                    error: function () {
                        showErrorPopup(
                            'Gagal!',
                            'Data nilai gagal disimpan. Periksa kembali guru dan KKM.'
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
                    '<p><b>Guru:</b> ' + safeHtml(getGuruName(nilai)) + '</p>' +
                    '<p><b>KKM:</b> ' + safeHtml(nilai.kkm) + '</p>' +
                    '<p><b>Predikat A:</b> ' + safeHtml(nilai.deskripsi_a) + '</p>' +
                    '<p><b>Predikat B:</b> ' + safeHtml(nilai.deskripsi_b) + '</p>' +
                    '<p><b>Predikat C:</b> ' + safeHtml(nilai.deskripsi_c) + '</p>' +
                    '<p><b>Predikat D:</b> ' + safeHtml(nilai.deskripsi_d) + '</p>' +
                    '<br>' +
                    '<button type="button" class="btn btn-primary btnEdit" data-id="' + nilai.id + '">Edit</button> ' +
                    '<button type="button" class="btn btn-secondary" id="btnKembaliDetail">Kembali</button>'
                );

                showDetail();
            },
            error: function () {
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
                $('#kkm').val(nilai.kkm);

                loadGuru(nilai.guru_id);
                showForm();
            },
            error: function () {
                showErrorPopup('Gagal!', 'Data nilai gagal dimuat.');
            }
        });
    });

    $(document).on('click', '.btnHapus', function () {
        var id = $(this).data('id');

        Swal.fire({
            title: 'Hapus Data Nilai?',
            html: `
                <div style="margin-top:10px;">
                    <p style="
                        color:#64748b;
                        margin-bottom:18px;
                        font-size:15px;
                        line-height:1.6;
                    ">
                        Data nilai yang dihapus tidak dapat dikembalikan.
                        Pastikan Anda yakin ingin melanjutkan.
                    </p>

                    <div style="
                        background:#fff1f2;
                        border:1px solid #fecdd3;
                        border-radius:18px;
                        padding:16px;
                        text-align:left;
                    ">
                        <div style="display:flex; align-items:center; gap:12px;">
                            <div style="
                                width:42px;
                                height:42px;
                                border-radius:12px;
                                background:#ffe4e6;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                color:#dc2626;
                                font-size:18px;
                            ">
                                <i class="fa-solid fa-trash"></i>
                            </div>

                            <div>
                                <div style="font-weight:700; color:#0f172a; margin-bottom:4px;">
                                    Data akan dihapus
                                </div>
                                <div style="color:#64748b; font-size:14px;">
                                    Data nilai ini akan hilang permanen.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `,
            width: '520px',
            showCancelButton: true,
            confirmButtonText: `
                <i class="fa-solid fa-trash"></i>
                Ya, Hapus
            `,
            cancelButtonText: `
                <i class="fa-solid fa-xmark"></i>
                Batal
            `,
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
                    error: function () {
                        showErrorPopup(
                            'Gagal!',
                            'Data nilai gagal dihapus.'
                        );
                    }
                });
            }
        });
    });

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
});
</script>