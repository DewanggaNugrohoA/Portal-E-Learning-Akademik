@extends('layouts.app')

@section('title', 'Tambah Mata Pelajaran')

@section('content')
<div class="page">
    <div class="container-small">
        <div class="header">
            <h1>Tambah Data Mata Pelajaran</h1>
            <p>Data mata pelajaran akan disimpan menggunakan API endpoint /api/mata-pelajaran.</p>
        </div>

        <div class="panel">
            <form id="createMataPelajaranForm">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Kode Mata Pelajaran</label>
                        <input type="text" name="kode_mata_pelajaran" id="kode_mata_pelajaran" placeholder="Masukkan kode mata pelajaran" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Mata Pelajaran</label>
                        <input type="text" name="nama_mata_pelajaran" id="nama_mata_pelajaran" placeholder="Masukkan nama mata pelajaran" required>
                    </div>

                    <div class="form-group">
                        <label>Guru Pengampu</label>
                        <input type="text" name="guru_pengampu" id="guru_pengampu" placeholder="Masukkan nama guru" required>
                    </div>

                    <div class="form-group">
                        <label>Jam Pelajaran</label>
                        <input type="number" name="jam_pelajaran" id="jam_pelajaran" placeholder="Contoh: 4" required>
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester" id="semester" required>
                            <option value="">Pilih semester</option>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                <div class="actions">
                    <a href="{{ url('/mata-pelajaran') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i>
                        Simpan Mata Pelajaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="popupOverlay" style="display:none; position:fixed; inset:0; background:rgba(15,23,42,0.45); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:white; width:420px; max-width:90%; border-radius:20px; padding:28px; text-align:center; box-shadow:0 20px 50px rgba(15,23,42,0.25);">
        <div id="popupIcon" style="font-size:42px; margin-bottom:14px;">
            <i class="fa-solid fa-circle-info"></i>
        </div>

        <h2 id="popupTitle" style="margin:0 0 10px; color:#0f172a;"></h2>
        <p id="popupMessage" style="margin:0 0 24px; color:#64748b; line-height:1.6;"></p>

        <button type="button" id="popupOk" class="btn btn-primary">Oke</button>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let popupRedirect = null;

    function inputValue(id) {
        const element = document.getElementById(id);

        if (!element) {
            return '';
        }

        return element.value;
    }

    function showPopup(title, message, type, redirect) {
        const popupOverlay = document.getElementById('popupOverlay');
        const popupIcon = document.getElementById('popupIcon');
        const popupTitle = document.getElementById('popupTitle');
        const popupMessage = document.getElementById('popupMessage');

        popupRedirect = redirect || null;
        popupTitle.textContent = title;
        popupMessage.textContent = message;

        if (type === 'success') {
            popupIcon.innerHTML = '<i class="fa-solid fa-circle-check"></i>';
            popupIcon.style.color = '#16a34a';
        } else {
            popupIcon.innerHTML = '<i class="fa-solid fa-circle-xmark"></i>';
            popupIcon.style.color = '#dc2626';
        }

        popupOverlay.style.display = 'flex';
    }

    document.getElementById('popupOk').onclick = function () {
        document.getElementById('popupOverlay').style.display = 'none';

        if (popupRedirect) {
            window.location.href = popupRedirect;
        }
    };

    document.getElementById('createMataPelajaranForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new window.FormData();

        formData.append('kode_mata_pelajaran', inputValue('kode_mata_pelajaran'));
        formData.append('nama_mata_pelajaran', inputValue('nama_mata_pelajaran'));
        formData.append('guru_pengampu', inputValue('guru_pengampu'));
        formData.append('jam_pelajaran', inputValue('jam_pelajaran'));
        formData.append('semester', inputValue('semester'));
        formData.append('status', inputValue('status'));

        try {
            const response = await fetch('/api/mata-pelajaran', {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            if (!response.ok) {
                let message = 'Gagal menyimpan data mata pelajaran.';

                if (result.errors) {
                    message = Object.values(result.errors).flat().join('\n');
                } else if (result.message) {
                    message = result.message;
                }

                showPopup('Gagal', message, 'error');
                return;
            }

            showPopup('Berhasil', result.message ?? 'Data mata pelajaran berhasil ditambahkan.', 'success', '/mata-pelajaran');
        } catch (error) {
            showPopup('Gagal', 'Terjadi kesalahan saat menyimpan data mata pelajaran.', 'error');
        }
    });
</script>
@endsection