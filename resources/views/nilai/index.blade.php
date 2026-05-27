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

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" id="btnBatal">Batal</button>
                </form>
            </div>

            <div id="detailSection" style="display:none;"></div>
        </div>
    </div>
</div>

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
                alert('Gagal memuat data guru.');
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
                alert(response.message || 'Data berhasil disimpan.');
                $('#formNilai')[0].reset();
                showTable();
                loadNilai();
            },
            error: function () {
                alert('Gagal menyimpan data nilai.');
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
                alert('Gagal memuat detail nilai.');
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
                alert('Gagal memuat data nilai.');
            }
        });
    });

    $(document).on('click', '.btnHapus', function () {
        var id = $(this).data('id');

        if (confirm('Yakin ingin menghapus data nilai ini?')) {
            $.ajax({
                url: apiUrl + '/' + id,
                type: 'DELETE',
                headers: { 'Accept': 'application/json' },
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