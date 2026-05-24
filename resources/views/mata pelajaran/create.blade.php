<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mata Pelajaran</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

<h1>Tambah Mata Pelajaran</h1>

<form id="form-create">
    <label>Kode Mapel</label><br>
    <input type="text" name="kode_mapel" id="kode_mapel"><br><br>

    <label>Nama Mapel</label><br>
    <input type="text" name="nama_mapel" id="nama_mapel"><br><br>

    <label>Guru Pengampu</label><br>
    <input type="text" name="guru_pengampu" id="guru_pengampu"><br><br>

    <label>Jumlah Jam</label><br>
    <input type="number" name="jumlah_jam" id="jumlah_jam"><br><br>

    <button type="submit">Simpan</button>
    <a href="/mata-pelajaran">Kembali</a>
</form>

<script>
    $('#form-create').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: '/api/mata-pelajaran',
            type: 'POST',
            data: {
                kode_mapel: $('#kode_mapel').val(),
                nama_mapel: $('#nama_mapel').val(),
                guru_pengampu: $('#guru_pengampu').val(),
                jumlah_jam: $('#jumlah_jam').val()
            },
            success: function(response) {
                alert(response.message);
                window.location.href = '/mata-pelajaran';
            },
            error: function() {
                alert('Gagal menambahkan data. Periksa input.');
            }
        });
    });
</script>

</body>
</html>