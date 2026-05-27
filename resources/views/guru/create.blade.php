<!DOCTYPE html>
<html>
<head>
    <title>Tambah Guru</title>

</head>
<body>

<h1>Tambah Guru</h1>

<form action="{{ route('guru.store') }}" method="POST">
    @csrf

    <label>Nama</label>
    <br>
    <input type="text" name="nama">
    <br><br>

    <label>NIP</label>
    <br>
    <input type="text" name="nip">
    <br><br>

    <label>Email</label>
    <br>
    <input type="email" name="email">
    <br><br>

    <label>No HP</label>
    <br>
    <input type="text" name="no_hp">
    <br><br>

    <label>Alamat</label>
    <br>
    <textarea name="alamat"></textarea>
    <br><br>

    <label>Mata Pelajaran</label>
    <br>
    <input type="text" name="mata_pelajaran">
    <br><br>

    <button type="submiit">
        Simpan
    </button>
</form>

</body>
</html>