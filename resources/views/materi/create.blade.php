@extends('layouts.app')

@section('title', 'Tambah Materi')

@section('content')
<div class="page">
    <div class="container-small">
        <div class="header">
            <h1>Tambah Materi Pembelajaran</h1>
            <p>Data materi akan disimpan menggunakan API endpoint <b>/api/materi</b>.</p>
        </div>

        <div class="panel">
            <form id="createMateriForm" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Judul Materi</label>
                        <input type="text" name="judul_materi" placeholder="Masukkan judul materi" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Mata Pelajaran</label>
                        <input type="text" name="nama_mata_pelajaran" placeholder="Contoh: Pemrograman Web">
                    </div>

                    <div class="form-group">
                        <label>Nama Guru</label>
                        <input type="text" name="nama_guru" placeholder="Masukkan nama guru">
                    </div>

                    <div class="form-group full">
                        <label>Deskripsi Materi</label>
                        <textarea name="deskripsi" placeholder="Tuliskan deskripsi materi"></textarea>
                    </div>

                    <div class="form-group full">
                        <label>Upload File Materi</label>
                        <input type="file" name="file_materi">
                        <small style="color:#64748b;">Format: PDF, DOC, DOCX, PPT, PPTX, MP4, ZIP, RAR. Maksimal 20 MB.</small>
                    </div>
                </div>

                <div class="actions">
                    <a href="{{ url('/materi') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i>
                        Simpan Materi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('createMateriForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        try {
            const response = await fetch('/api/materi', {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            if (!response.ok) {
                let errorMessage = 'Gagal menyimpan data materi.';

                if (result.errors) {
                    errorMessage = Object.values(result.errors).flat().join('\n');
                } else if (result.message) {
                    errorMessage = result.message;
                }

                alert(errorMessage);
                return;
            }

            alert(result.message);
            window.location.href = '/materi';
        } catch (error) {
            alert('Terjadi kesalahan saat menyimpan data materi.');
        }
    });
</script>
@endsection