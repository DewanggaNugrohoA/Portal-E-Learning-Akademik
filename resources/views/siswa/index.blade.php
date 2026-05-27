<div class="page">
    <div class="container">
        <div class="header">
            <h1>Manajemen Data Siswa</h1>
            <p>Kelola data siswa menggunakan jQuery AJAX.</p>
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
            <div id="siswaTableSection">
                <div class="toolbar">
                    <input type="text" id="searchSiswa" placeholder="Cari NIS, nama, email, kelas, no HP, atau status...">

                    <button type="button" class="btn btn-primary" id="btnTambahSiswa">
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

            <div id="siswaFormSection" style="display:none;">
                <h3 id="siswaFormTitle">Tambah Siswa</h3>

                <form id="formSiswa">
                    <input type="hidden" id="siswa_id">

                    <label>NIS</label>
                    <input type="text" id="nis" required>

                    <label>Nama</label>
                    <input type="text" id="nama_siswa" required>

                    <label>Email</label>
                    <input type="email" id="email_siswa" required>

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
                    <input type="text" id="no_hp_siswa">

                    <label>Alamat</label>
                    <textarea id="alamat_siswa"></textarea>

                    <label>Status</label>
                    <select id="status" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>

                    <br><br>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" id="btnBatalSiswa">Batal</button>
                </form>
            </div>

            <div id="siswaDetailSection" style="display:none;"></div>
        </div>
    </div>
</div>

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
                renderSiswa(siswaList);
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

    function renderSiswa(data) {
        var rows = '';

        if (data.length === 0) {
            rows = '<tr><td colspan="9" class="empty">Belum ada data siswa.</td></tr>';
        } else {
            $.each(data, function (index, siswa) {
                rows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${safeHtml(siswa.nis)}</td>
                        <td>${safeHtml(siswa.nama)}</td>
                        <td>${safeHtml(siswa.email)}</td>
                        <td>${safeHtml(siswa.kelas)}</td>
                        <td>${safeHtml(siswa.jenis_kelamin)}</td>
                        <td>${safeHtml(siswa.no_hp)}</td>
                        <td>${safeHtml(siswa.status)}</td>
                        <td>
                            <div class="action-group">
                                <button class="btn btn-detail btnDetailSiswa" data-id="${siswa.id}">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button class="btn btn-edit btnEditSiswa" data-id="${siswa.id}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button class="btn btn-delete btnHapusSiswa" data-id="${siswa.id}">
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

    function showSiswaTable() {
        $('#siswaTableSection').show();
        $('#siswaFormSection').hide();
        $('#siswaDetailSection').hide();
    }

    function showSiswaForm() {
        $('#siswaTableSection').hide();
        $('#siswaFormSection').show();
        $('#siswaDetailSection').hide();
    }

    function showSiswaDetail() {
        $('#siswaTableSection').hide();
        $('#siswaFormSection').hide();
        $('#siswaDetailSection').show();
    }

    $('#btnTambahSiswa').on('click', function () {
        $('#siswaFormTitle').text('Tambah Siswa');
        $('#siswa_id').val('');
        $('#formSiswa')[0].reset();
        showSiswaForm();
    });

    $('#btnBatalSiswa').on('click', function () {
        $('#formSiswa')[0].reset();
        showSiswaTable();
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
                nama: $('#nama_siswa').val(),
                email: $('#email_siswa').val(),
                kelas: $('#kelas').val(),
                jenis_kelamin: $('#jenis_kelamin').val(),
                tanggal_lahir: $('#tanggal_lahir').val(),
                no_hp: $('#no_hp_siswa').val(),
                alamat: $('#alamat_siswa').val(),
                status: $('#status').val()
            },
            success: function (response) {
                alert(response.message || 'Data siswa berhasil disimpan.');
                $('#formSiswa')[0].reset();
                showSiswaTable();
                loadSiswa();
            },
            error: function () {
                alert('Gagal menyimpan data siswa. Cek NIS/email mungkin sudah dipakai.');
            }
        });
    });

    $(document).on('click', '.btnEditSiswa', function () {
        var id = $(this).data('id');

        $.ajax({
            url: apiUrl + '/' + id,
            type: 'GET',
            headers: { 'Accept': 'application/json' },
            success: function (response) {
                var siswa = response.data;

                $('#siswaFormTitle').text('Edit Siswa');
                $('#siswa_id').val(siswa.id);
                $('#nis').val(siswa.nis);
                $('#nama_siswa').val(siswa.nama);
                $('#email_siswa').val(siswa.email);
                $('#kelas').val(siswa.kelas);
                $('#jenis_kelamin').val(siswa.jenis_kelamin);
                $('#tanggal_lahir').val(siswa.tanggal_lahir);
                $('#no_hp_siswa').val(siswa.no_hp);
                $('#alamat_siswa').val(siswa.alamat);
                $('#status').val(siswa.status);

                showSiswaForm();
            },
            error: function () {
                alert('Gagal memuat data siswa.');
            }
        });
    });

    $(document).on('click', '.btnDetailSiswa', function () {
        var id = $(this).data('id');

        $.ajax({
            url: apiUrl + '/' + id,
            type: 'GET',
            headers: { 'Accept': 'application/json' },
            success: function (response) {
                var siswa = response.data;

                $('#siswaDetailSection').html(`
                    <h3>Detail Siswa</h3>
                    <p><b>NIS:</b> ${safeHtml(siswa.nis)}</p>
                    <p><b>Nama:</b> ${safeHtml(siswa.nama)}</p>
                    <p><b>Email:</b> ${safeHtml(siswa.email)}</p>
                    <p><b>Kelas:</b> ${safeHtml(siswa.kelas)}</p>
                    <p><b>Jenis Kelamin:</b> ${safeHtml(siswa.jenis_kelamin)}</p>
                    <p><b>Tanggal Lahir:</b> ${safeHtml(siswa.tanggal_lahir)}</p>
                    <p><b>No HP:</b> ${safeHtml(siswa.no_hp)}</p>
                    <p><b>Alamat:</b> ${safeHtml(siswa.alamat)}</p>
                    <p><b>Status:</b> ${safeHtml(siswa.status)}</p>
                    <br>
                    <button class="btn btn-primary btnEditSiswa" data-id="${siswa.id}">Edit</button>
                    <button class="btn btn-secondary" id="btnKembaliSiswa">Kembali</button>
                `);

                showSiswaDetail();
            },
            error: function () {
                alert('Gagal memuat detail siswa.');
            }
        });
    });

    $(document).on('click', '#btnKembaliSiswa', function () {
        showSiswaTable();
    });

    $(document).on('click', '.btnHapusSiswa', function () {
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
                    alert('Gagal menghapus data siswa.');
                }
            });
        }
    });

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
</script>