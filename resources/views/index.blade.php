@include('layouts.app')

<script>
    $(document).ready(function () {
        loadSiswa();
    });

    function setActive(index) {
        $('.menu-btn').removeClass('active');
        $('.menu-btn').eq(index).addClass('active');
    }

    function loadSiswa() {
        setActive(0);

        $('#content').html(`
            <div class="form-box" id="formSiswa">
                <h2 id="judulForm">Tambah Siswa</h2>

                <input type="hidden" id="id">

                <div class="form-grid">
                    <div>
                        <label>NIS</label>
                        <input type="text" id="nis">
                    </div>

                    <div>
                        <label>Nama</label>
                        <input type="text" id="nama">
                    </div>

                    <div>
                        <label>Email</label>
                        <input type="email" id="email">
                    </div>

                    <div>
                        <label>Kelas</label>
                        <input type="text" id="kelas">
                    </div>

                    <div>
                        <label>Jenis Kelamin</label>
                        <select id="jenis_kelamin">
                            <option value="">Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label>Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir">
                    </div>

                    <div>
                        <label>No HP</label>
                        <input type="text" id="no_hp">
                    </div>

                    <div>
                        <label>Status</label>
                        <select id="status">
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="full">
                        <label>Alamat</label>
                        <textarea id="alamat"></textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <button class="btn-primary" onclick="simpanSiswa()">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>

                    <button class="btn-secondary" onclick="tutupForm()">
                        <i class="fa-solid fa-xmark"></i> Batal
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="toolbar">
                    <h2>Data Siswa</h2>
                    <button class="btn-primary" onclick="tambahSiswa()">
                        <i class="fa-solid fa-plus"></i> Tambah Siswa
                    </button>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="dataSiswa">
                        <tr>
                            <td colspan="8">Memuat data...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `);

        ambilDataSiswa();
    }

    function ambilDataSiswa() {
        $.ajax({
            url: '/api/siswa',
            type: 'GET',
            success: function (response) {
                let html = '';

                if (response.data.length === 0) {
                    html = `
                        <tr>
                            <td colspan="8">Data siswa masih kosong</td>
                        </tr>
                    `;
                } else {
                    response.data.forEach(function (siswa) {
                        html += `
                            <tr>
                                <td>${siswa.id}</td>
                                <td>${siswa.nis}</td>
                                <td>${siswa.nama}</td>
                                <td>${siswa.email}</td>
                                <td>${siswa.kelas}</td>
                                <td>${siswa.jenis_kelamin}</td>
                                <td>${siswa.status}</td>
                                <td>
                                    <button class="btn-detail" onclick="detailSiswa(${siswa.id})" title="Detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>

                                    <button class="btn-edit" onclick="editSiswa(${siswa.id})" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <button class="btn-delete" onclick="hapusSiswa(${siswa.id})" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                }

                $('#dataSiswa').html(html);
            },
            error: function () {
                $('#dataSiswa').html(`
                    <tr>
                        <td colspan="8">Gagal mengambil data siswa dari API</td>
                    </tr>
                `);
            }
        });
    }

    function tambahSiswa() {
        $('#judulForm').text('Tambah Siswa');

        $('#id').val('');
        $('#nis').val('');
        $('#nama').val('');
        $('#email').val('');
        $('#kelas').val('');
        $('#jenis_kelamin').val('');
        $('#tanggal_lahir').val('');
        $('#no_hp').val('');
        $('#alamat').val('');
        $('#status').val('Aktif');

        $('#formSiswa').show();
    }

    function simpanSiswa() {
        let id = $('#id').val();

        let data = {
            nis: $('#nis').val(),
            nama: $('#nama').val(),
            email: $('#email').val(),
            kelas: $('#kelas').val(),
            jenis_kelamin: $('#jenis_kelamin').val(),
            tanggal_lahir: $('#tanggal_lahir').val(),
            no_hp: $('#no_hp').val(),
            alamat: $('#alamat').val(),
            status: $('#status').val()
        };

        let url = id ? `/api/siswa/${id}` : '/api/siswa';
        let method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            type: method,
            data: data,
            success: function () {
                Swal.fire('Berhasil', 'Data siswa berhasil disimpan', 'success');
                tutupForm();
                ambilDataSiswa();
            },
            error: function () {
                Swal.fire('Gagal', 'Periksa kembali input data', 'error');
            }
        });
    }

    function editSiswa(id) {
        $.ajax({
            url: `/api/siswa/${id}`,
            type: 'GET',
            success: function (response) {
                let siswa = response.data;

                $('#judulForm').text('Edit Siswa');

                $('#id').val(siswa.id);
                $('#nis').val(siswa.nis);
                $('#nama').val(siswa.nama);
                $('#email').val(siswa.email);
                $('#kelas').val(siswa.kelas);
                $('#jenis_kelamin').val(siswa.jenis_kelamin);
                $('#tanggal_lahir').val(siswa.tanggal_lahir);
                $('#no_hp').val(siswa.no_hp);
                $('#alamat').val(siswa.alamat);
                $('#status').val(siswa.status);

                $('#formSiswa').show();
            },
            error: function () {
                Swal.fire('Gagal', 'Data siswa gagal diambil', 'error');
            }
        });
    }

    function detailSiswa(id) {
        $.ajax({
            url: `/api/siswa/${id}`,
            type: 'GET',
            success: function (response) {
                let siswa = response.data;

                Swal.fire({
                    title: 'Detail Siswa',
                    width: 520,
                    html: `
                        <div class="detail-box">
                            <div class="detail-item">
                                <div class="detail-label">Nama</div>
                                <div class="detail-value">${siswa.nama}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">NIS</div>
                                <div class="detail-value">${siswa.nis}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Email</div>
                                <div class="detail-value">${siswa.email}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Kelas</div>
                                <div class="detail-value">${siswa.kelas}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Jenis Kelamin</div>
                                <div class="detail-value">${siswa.jenis_kelamin}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Tanggal Lahir</div>
                                <div class="detail-value">${siswa.tanggal_lahir ?? '-'}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">No HP</div>
                                <div class="detail-value">${siswa.no_hp ?? '-'}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Alamat</div>
                                <div class="detail-value">${siswa.alamat ?? '-'}</div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Status</div>
                                <div class="detail-value">${siswa.status}</div>
                            </div>
                        </div>
                    `,
                    confirmButtonText: 'Tutup',
                    confirmButtonColor: '#1e3a8a'
                });
            },
            error: function () {
                Swal.fire('Gagal', 'Detail siswa gagal diambil', 'error');
            }
        });
    }

    function hapusSiswa(id) {
        Swal.fire({
            title: 'Hapus data?',
            text: 'Data siswa akan dihapus',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1e3a8a',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/api/siswa/${id}`,
                    type: 'DELETE',
                    success: function () {
                        Swal.fire('Berhasil', 'Data siswa berhasil dihapus', 'success');
                        ambilDataSiswa();
                    },
                    error: function () {
                        Swal.fire('Gagal', 'Data siswa gagal dihapus', 'error');
                    }
                });
            }
        });
    }

    function tutupForm() {
        $('#formSiswa').hide();
    }

    function loadKosong(namaModul) {
        $('#content').html(`
            <div class="card">
                <h2>Modul ${namaModul}</h2>
                <p>Modul ini nanti dikerjakan oleh anggota kelompok lain.</p>
                <p>Gunakan pola yang sama seperti Modul Siswa.</p>
            </div>
        `);
    }
</script>