<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mata Pelajaran</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

<h1>Data Mata Pelajaran</h1>

<a href="/mata-pelajaran/create">Tambah Mata Pelajaran</a>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Mapel</th>
            <th>Nama Mapel</th>
            <th>Guru Pengampu</th>
            <th>Jumlah Jam</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="data-mapel"></tbody>
</table>

<script>
    function loadData() {
        $.get('/api/mata-pelajaran', function(response) {
            let html = '';

            response.data.forEach(function(item, index) {
                html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.kode_mapel}</td>
                        <td>${item.nama_mapel}</td>
                        <td>${item.guru_pengampu ?? '-'}</td>
                        <td>${item.jumlah_jam}</td>
                        <td>
                            <a href="/mata-pelajaran/show/${item.id}">Detail</a>
                            <a href="/mata-pelajaran/edit/${item.id}">Edit</a>
                            <button onclick="hapusData(${item.id})">Hapus</button>
                        </td>
                    </tr>
                `;
            });

            $('#data-mapel').html(html);
        });
    }

    function hapusData(id) {
        if (confirm('Yakin ingin menghapus data ini?')) {
            $.ajax({
                url: '/api/mata-pelajaran/' + id,
                type: 'DELETE',
                success: function(response) {
                    alert(response.message);
                    loadData();
                },
                error: function() {
                    alert('Gagal menghapus data');
                }
            });
        }
    }

    $(document).ready(function() {
        loadData();
    });
</script>

</body>
</html>