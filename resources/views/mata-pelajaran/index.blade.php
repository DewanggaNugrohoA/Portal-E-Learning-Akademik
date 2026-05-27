@extends('layouts.app')

@section('title', 'Data Mata Pelajaran')

@section('content')
<div class="page">
    <div class="container">
        <div class="header">
            <h1>Data Mata Pelajaran</h1>
            <p>Data mata pelajaran ditampilkan menggunakan API dari endpoint /api/mata-pelajaran.</p>
        </div>

        <div class="stat-grid">
            <div class="stat-card">
                <span>Total Mata Pelajaran</span>
                <h2 id="totalMapel">0</h2>
            </div>

            <div class="stat-card">
                <span>Modul</span>
                <h2>Mata Pelajaran</h2>
            </div>

            <div class="stat-card">
                <span>Penanggung Jawab</span>
                <h2>Meida</h2>
            </div>
        </div>

        <div class="panel">
            <div class="toolbar">
                <div>
                    <h2>Daftar Mata Pelajaran</h2>
                    <p style="margin:6px 0 0; color:#64748b;">
                        Kelola data mata pelajaran menggunakan REST API Laravel.
                    </p>
                </div>

                <a href="{{ url('/mata-pelajaran/create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Mata Pelajaran
                </a>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Mata Pelajaran</th>
                            <th>Guru Pengampu</th>
                            <th>Jam Pelajaran</th>
                            <th>Semester</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="dataMataPelajaran">
                        <tr>
                            <td colspan="8" class="empty">Memuat data mata pelajaran...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="popupOverlay" style="display:none; position:fixed; inset:0; background:rgba(15,23,42,0.45); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:white; width:420px; max-width:90%; border-radius:20px; padding:28px; box-shadow:0 20px 50px rgba(15,23,42,0.25); text-align:center;">
        <div id="popupIcon" style="font-size:42px; color:#1e40af; margin-bottom:14px;">
            <i class="fa-solid fa-circle-info"></i>
        </div>

        <h2 id="popupTitle" style="margin:0 0 10px; color:#0f172a;">Konfirmasi</h2>
        <p id="popupMessage" style="margin:0 0 24px; color:#64748b; line-height:1.6;"></p>

        <div id="popupActions" style="display:flex; gap:12px; justify-content:center;">
            <button type="button" id="popupCancel" class="btn btn-secondary">
                Batal
            </button>

            <button type="button" id="popupConfirm" class="btn btn-primary">
                Ya, Hapus
            </button>
        </div>

        <div id="popupOkWrapper" style="display:none;">
            <button type="button" id="popupOk" class="btn btn-primary">
                Oke
            </button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const dataMataPelajaran = document.getElementById('dataMataPelajaran');
    const totalMapel = document.getElementById('totalMapel');

    const popupOverlay = document.getElementById('popupOverlay');
    const popupIcon = document.getElementById('popupIcon');
    const popupTitle = document.getElementById('popupTitle');
    const popupMessage = document.getElementById('popupMessage');
    const popupActions = document.getElementById('popupActions');
    const popupOkWrapper = document.getElementById('popupOkWrapper');
    const popupCancel = document.getElementById('popupCancel');
    const popupConfirm = document.getElementById('popupConfirm');
    const popupOk = document.getElementById('popupOk');

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

    function showPopup(title, message, type = 'info') {
        popupTitle.textContent = title;
        popupMessage.textContent = message;
        popupActions.style.display = 'none';
        popupOkWrapper.style.display = 'block';

        if (type === 'success') {
            popupIcon.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
            popupIcon.style.color = '#16a34a';
        } else if (type === 'error') {
            popupIcon.innerHTML = '<i class="fa-solid fa-circle-xmark"></i>';
            popupIcon.style.color = '#dc2626';
        } else {
            popupIcon.innerHTML = '<i class="fa-solid fa-circle-info"></i>';
            popupIcon.style.color = '#1e40af';
        }

        popupOverlay.style.display = 'flex';
    }

    function showConfirmPopup(message, onConfirm) {
        popupTitle.textContent = 'Konfirmasi Hapus';
        popupMessage.textContent = message;
        popupIcon.innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i>';
        popupIcon.style.color = '#dc2626';
        popupActions.style.display = 'flex';
        popupOkWrapper.style.display = 'none';
        popupOverlay.style.display = 'flex';

        popupConfirm.onclick = function () {
            popupOverlay.style.display = 'none';
            onConfirm();
        };
    }

    popupCancel.onclick = function () {
        popupOverlay.style.display = 'none';
    };

    popupOk.onclick = function () {
        popupOverlay.style.display = 'none';
    };

    async function loadMataPelajaran() {
        try {
            const response = await fetch('/api/mata-pelajaran', {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();
            const mapelList = result.data ?? [];

            totalMapel.textContent = mapelList.length;
            dataMataPelajaran.innerHTML = '';

            if (mapelList.length === 0) {
                dataMataPelajaran.innerHTML = `
                    <tr>
                        <td colspan="8" class="empty">Belum ada data mata pelajaran.</td>
                    </tr>
                `;
                return;
            }

            mapelList.forEach((mapel, index) => {
                const statusBadge = mapel.status === 'Aktif'
                    ? `<span class="badge badge-blue">Aktif</span>`
                    : `<span class="badge badge-red">Tidak Aktif</span>`;

                dataMataPelajaran.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${safeHtml(mapel.kode_mata_pelajaran)}</td>
                        <td><strong>${safeHtml(mapel.nama_mata_pelajaran)}</strong></td>
                        <td>${safeHtml(mapel.guru_pengampu)}</td>
                        <td>${safeHtml(mapel.jam_pelajaran)}</td>
                        <td>${safeHtml(mapel.semester)}</td>
                        <td>${statusBadge}</td>
                        <td>
                            <div class="action-group">
                                <a href="/mata-pelajaran/${mapel.id}" class="btn btn-detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="/mata-pelajaran/${mapel.id}/edit" class="btn btn-edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <button type="button" onclick="deleteMataPelajaran(${mapel.id})" class="btn btn-delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });
        } catch (error) {
            dataMataPelajaran.innerHTML = `
                <tr>
                    <td colspan="8" class="empty">Gagal memuat data mata pelajaran dari API.</td>
                </tr>
            `;

            showPopup('Gagal', 'Data mata pelajaran gagal dimuat.', 'error');
        }
    }

    async function deleteMataPelajaran(id) {
        showConfirmPopup('Yakin ingin menghapus data mata pelajaran ini?', async function () {
            try {
                const response = await fetch(`/api/mata-pelajaran/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                const result = await response.json();

                if (!response.ok) {
                    showPopup('Gagal', result.message ?? 'Data mata pelajaran gagal dihapus.', 'error');
                    return;
                }

                showPopup('Berhasil', result.message ?? 'Data mata pelajaran berhasil dihapus.', 'success');
                loadMataPelajaran();
            } catch (error) {
                showPopup('Gagal', 'Terjadi kesalahan saat menghapus data mata pelajaran.', 'error');
            }
        });
    }

    loadMataPelajaran();
</script>
@endsection