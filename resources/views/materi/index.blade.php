<div class="page">
    <div class="container">
        <div class="header">
            <h1>Data Materi Pembelajaran</h1>
            <p>Data materi ditampilkan menggunakan API dari endpoint /api/materi.</p>
        </div>

        <div class="stat-grid">
            <div class="stat-card">
                <span>Total Materi</span>
                <h2 id="totalMateri">0</h2>
            </div>

            <div class="stat-card">
                <span>Modul</span>
                <h2>Materi</h2>
            </div>

            <div class="stat-card">
                <span>Penanggung Jawab</span>
                <h2>Dewangga</h2>
            </div>
        </div>

        <div class="panel">
            <div class="toolbar">
                <div>
                    <h2 style="margin:0;">Daftar Materi</h2>
                    <p style="margin:6px 0 0; color:#64748b;">
                        Kelola data materi, mata pelajaran, guru, dan file pembelajaran.
                    </p>
                </div>

                <a href="{{ url('/materi/create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Materi
                </a>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Materi</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru</th>
                            <th>File</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="materiTable">
                        <tr>
                            <td colspan="7" class="empty">Memuat data materi...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    const materiTable = document.getElementById('materiTable');
    const totalMateri = document.getElementById('totalMateri');

    async function loadMateri() {
        try {
            const response = await fetch('/api/materi', {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();
            const data = result.data ?? [];

            materiTable.innerHTML = '';
            totalMateri.textContent = data.length;

            if (data.length === 0) {
                materiTable.innerHTML = `
                    <tr>
                        <td colspan="7" class="empty">Belum ada data materi.</td>
                    </tr>
                `;
                return;
            }

            data.forEach((materi, index) => {
                const deskripsi = materi.deskripsi
                    ? materi.deskripsi.substring(0, 70)
                    : '-';

                const tanggal = materi.created_at
                    ? new Date(materi.created_at).toLocaleString('id-ID')
                    : '-';

                const fileMateri = materi.file_materi
                    ? `<a href="/assets/uploads/materi/${materi.file_materi}" target="_blank" class="btn btn-detail">
                            <i class="fa-solid fa-file"></i>
                            Lihat File
                            </a>`
                    : `<span class="badge badge-red">Tidak ada file</span>`;

                materiTable.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>

                        <td>
                            <strong>${materi.judul_materi}</strong>
                            <div style="color:#64748b; font-size:13px; margin-top:4px;">
                                ${deskripsi}
                            </div>
                        </td>

                        <td>
                            <span class="badge badge-blue">
                                ${materi.nama_mata_pelajaran ?? '-'}
                            </span>
                        </td>

                        <td>${materi.nama_guru ?? '-'}</td>

                        <td>${fileMateri}</td>

                        <td>${tanggal}</td>

                        <td>
                            <div class="action-group">
                                <a href="/materi/${materi.id}" class="btn btn-detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="/materi/${materi.id}/edit" class="btn btn-edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <button type="button" onclick="deleteMateri(${materi.id})" class="btn btn-delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });
        } catch (error) {
            materiTable.innerHTML = `
                <tr>
                    <td colspan="7" class="empty">Gagal memuat data materi.</td>
                </tr>
            `;
        }
    }

    async function deleteMateri(id) {
        const konfirmasi = confirm('Yakin ingin menghapus data materi ini?');

        if (!konfirmasi) {
            return;
        }

        try {
            const response = await fetch(`/api/materi/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            alert(result.message);
            loadMateri();
        } catch (error) {
            alert('Gagal menghapus data materi.');
        }
    }

    loadMateri();
</script>