<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Mata Pelajaran</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

<h1>Detail Mata Pelajaran</h1>

<p><b>Kode Mapel:</b> <span id="kode_mapel"></span></p>
<p><b>Nama Mapel:</b> <span id="nama_mapel"></span></p>
<p><b>Guru Pengampu:</b> <span id="guru_pengampu"></span></p>
<p><b>Jumlah Jam:</b> <span id="jumlah_jam"></span></p>

<a href="/mata-pelajaran">Kembali</a>

<script>
    const id = window.location.pathname.split('/').pop();

    $.get('/api/mata-pelajaran/' + id, function(response) {
        let data = response.data;

        $('#kode_mapel').text(data.kode_mapel);
        $('#nama_mapel').text(data.nama_mapel);
        $('#guru_pengampu').text(data.guru_pengampu ?? '-');
        $('#jumlah_jam').text(data.jumlah_jam);
    });
</script>

</body>
</html>