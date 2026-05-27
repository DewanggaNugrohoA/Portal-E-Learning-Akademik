<div class="page">
    <div class="container">
        <div class="header">
            <h1>Manajemen Data Guru</h1>
            <p>Kelola data guru menggunakan jQuery AJAX.</p>
        </div>

        <div class="panel">
            <div id="guruTableSection">
                <div class="toolbar">
                    <input type="text" id="searchGuru" placeholder="Cari nama, NIP, email, no HP, alamat, atau mapel...">

                    <button type="button" class="btn btn-primary" id="btnTambahGuru">
                        <i class="fa-solid fa-plus"></i>
                        Tambah Guru
                    </button>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th>Alamat</th>
                                <th>Mapel</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="dataGuru">
                            <tr>
                                <td colspan="8" class="empty">Memuat data guru...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="guruFormSection" style="display:none;">
                <h3 id="guruFormTitle">Tambah Guru</h3>

                <form id="formGuru">
                    <input type="hidden" id="guru_id">

                    <label>Nama</label>
                    <input type="text" id="nama_guru" required>

                    <label>NIP</label>
                    <input type="text" id="nip" required>

                    <label>Email</label>
                    <input type="email" id="email_guru" required>

                    <label>No HP</label>
                    <input type="text" id="no_hp_guru">

                    <label>Alamat</label>
                    <textarea id="alamat_guru"></textarea>

                    <label>Mapel</label>
                    <input type="text" id="mapel" required>

                    <br><br>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" id="btnBatalGuru">Batal</button>
                </form>
            </div>

            <div id="guruDetailSection" style="display:none;"></div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    var apiUrl = '/api/guru';
    var guruList = [];

    loadGuru();

    function loadGuru() {
        $.ajax({
            url: apiUrl,
            type: 'GET',
            headers: { 'Accept': 'application/json' },
            success: function (response) {
                guruList = response.data || [];
                renderGuru(guruList);
            },
            error: function () {
                $('#dataGuru').html('<tr><td colspan="8" class="empty">Gagal memuat data guru.</td></tr>');
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

    function renderGuru(data) {
        var rows = '';

        if (data.length === 0) {
            rows = '<tr><td colspan="8" class="empty">Belum ada data guru.</td></tr>';
        } else {
            $.each(data, function (index, guru) {
                rows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${safeHtml(guru.nama)}</td>
                        <td>${safeHtml(guru.nip)}</td>
                        <td>${safeHtml(guru.email)}</td>
                        <td>${safeHtml(guru.no_hp)}</td>
                        <td>${safeHtml(guru.alamat)}</td>
                        <td>${safeHtml(guru.mapel)}</td>
                        <td>
                            <div class="action-group">
                                <button class="btn btn-detail btnDetailGuru" data-id="${guru.id}">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button class="btn btn-edit btnEditGuru" data-id="${guru.id}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
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

    function showGuruTable() {
        $('#guruTableSection').show();
        $('#guruFormSection').hide();
        $('#guruDetailSection').hide();
    }

    function showGuruForm() {
        $('#guruTableSection').hide();
        $('#guruFormSection').show();
        $('#guruDetailSection').hide();
    }

    function showGuruDetail() {
        $('#guruTableSection').hide();
        $('#guruFormSection').hide();
        $('#guruDetailSection').show();
    }

    $('#btnTambahGuru').on('click', function () {
        $('#guruFormTitle').text('Tambah Guru');
        $('#guru_id').val('');
        $('#formGuru')[0].reset();
        showGuruForm();
    });

    $('#btnBatalGuru').on('click', function () {
        $('#formGuru')[0].reset();
        showGuruTable();
    });

    $('#formGuru').on('submit', function (e) {
        e.preventDefault();

        var id = $('#guru_id').val();
        var method = id ? 'PUT' : 'POST';
        var url = id ? apiUrl + '/' + id : apiUrl;

        $.ajax({
            url: url,
            type: method,
            headers: { 'Accept': 'application/json' },
            data: {
                nama: $('#nama_guru').val(),
                nip: $('#nip').val(),
                email: $('#email_guru').val(),
                no_hp: $('#no_hp_guru').val(),
                alamat: $('#alamat_guru').val(),
                mapel: $('#mapel').val()
            },
            success: function (response) {
                alert(response.message || 'Data guru berhasil disimpan.');
                $('#formGuru')[0].reset();
                showGuruTable();
                loadGuru();
            },
            error: function () {
                alert('Gagal menyimpan data guru.');
            }
        });
    });

    $(document).on('click', '.btnEditGuru', function () {
        var id = $(this).data('id');

        $.ajax({
            url: apiUrl + '/' + id,
            type: 'GET',
            headers: { 'Accept': 'application/json' },
            success: function (response) {
                var guru = response.data;

                $('#guruFormTitle').text('Edit Guru');
                $('#guru_id').val(guru.id);
                $('#nama_guru').val(guru.nama);
                $('#nip').val(guru.nip);
                $('#email_guru').val(guru.email);
                $('#no_hp_guru').val(guru.no_hp);
                $('#alamat_guru').val(guru.alamat);
                $('#mapel').val(guru.mapel);

                showGuruForm();
            },
            error: function () {
                alert('Gagal memuat data guru.');
            }
        });
    });

    $(document).on('click', '.btnDetailGuru', function () {
        var id = $(this).data('id');

        $.ajax({
            url: apiUrl + '/' + id,
            type: 'GET',
            headers: { 'Accept': 'application/json' },
            success: function (response) {
                var guru = response.data;

                $('#guruDetailSection').html(`
                    <h3>Detail Guru</h3>
                    <p><b>Nama:</b> ${safeHtml(guru.nama)}</p>
                    <p><b>NIP:</b> ${safeHtml(guru.nip)}</p>
                    <p><b>Email:</b> ${safeHtml(guru.email)}</p>
                    <p><b>No HP:</b> ${safeHtml(guru.no_hp)}</p>
                    <p><b>Alamat:</b> ${safeHtml(guru.alamat)}</p>
                    <p><b>Mapel:</b> ${safeHtml(guru.mapel)}</p>
                    <br>
                    <button class="btn btn-primary btnEditGuru" data-id="${guru.id}">Edit</button>
                    <button class="btn btn-secondary" id="btnKembaliGuru">Kembali</button>
                `);

                showGuruDetail();
            },
            error: function () {
                alert('Gagal memuat detail guru.');
            }
        });
    });

    $(document).on('click', '#btnKembaliGuru', function () {
        showGuruTable();
    });

    $(document).on('click', '.btnHapusGuru', function () {
        var id = $(this).data('id');

        if (confirm('Yakin ingin menghapus data guru ini?')) {
            $.ajax({
                url: apiUrl + '/' + id,
                type: 'DELETE',
                headers: { 'Accept': 'application/json' },
                success: function (response) {
                    alert(response.message || 'Data guru berhasil dihapus.');
                    loadGuru();
                },
                error: function () {
                    alert('Gagal menghapus data guru.');
                }
            });
        }
    });

    $('#searchGuru').on('keyup', function () {
        var keyword = $(this).val().toLowerCase();

        var filtered = guruList.filter(function (guru) {
            var text =
                String(guru.nama || '') + ' ' +
                String(guru.nip || '') + ' ' +
                String(guru.email || '') + ' ' +
                String(guru.no_hp || '') + ' ' +
                String(guru.alamat || '') + ' ' +
                String(guru.mapel || '');

            return text.toLowerCase().indexOf(keyword) !== -1;
        });

        renderGuru(filtered);
    });
});
</script>