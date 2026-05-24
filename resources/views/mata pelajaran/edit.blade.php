<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mata Pelajaran</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

<h1>Edit Mata Pelajaran</h1>

<form id="form-edit">
    <label>Kode Mapel</label><br>
    <input type="text" id="kode_mapel"><br><br>

    <label>Nama Mapel</label><br>
    <input type="text" id="nama_mapel"><br><br>

    <label>Guru Pengampu</label><br>
    <input type="text" id="guru_pengampu"><br><br>

    <label>Jumlah Jam</label><br>
    <input type="number" id="jumlah_jam"><br><br>

    <button type="submit">Update</button>
    <a href="/mata-pelajaran">Kembali</a>
</form>

<script>
    const id = window.location.pathname.split('/').pop();

    function loadDetail() {
        $.get('/api/mata-pelajaran/' + id, function(response) {
            let data = response.data;

            $('#kode_mapel').val(data.kode_mapel);
            $('#nama_mapel').val(data.nama_mapel);
            $('#guru_pengampu').val(data.guru_pengampu);
            $('#jumlah_jam').val(data.jumlah_jam);
        });
    }

    $('#form-edit').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: '/api/mata-pelajaran/' + id,
            type: 'PUT',
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
                alert('Gagal memperbarui data.');
            }
        });
    });

    $(document).ready(function() {
        loadDetail();
    });
</script>

</body>
</html>