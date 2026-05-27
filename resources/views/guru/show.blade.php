<!DOCTYPE html>
<html>
    <head>
        <title>Detail Guru</title>
    </head>
    <body>

    <h1>Detail Guru</h1>

    <p>Nama : {{ $guru->nama }}</p>

    <p>NIP : {{ $guru->nip }}</p>

    <p>Email : {{ $guru->email }}</p>

    <p>No HP: {{ $guru->no_hp }}</p>

    <p>Alamat : {{ $guru->alamat }}</p>

    <p>Mata Pelajaran : {{ $guru->mata_pelajaran }}</p>

    <a href="{{ route('guru.index') }}">
        Kembali
    </a>


    </body>
</html>