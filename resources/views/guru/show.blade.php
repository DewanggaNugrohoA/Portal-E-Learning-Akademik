<!DOCTYPE html>
<html>
<head>
    <title>Detail Guru</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f6fc;
        }

        .header {
            background: #1f3f93;
            color: white;
            padding: 25px 160px;
        }

        .navbar {
            background: white;
            padding: 20px 160px;
        }

        .navbar a {
            margin-right: 40px;
            text-decoration: none;
            color: #1f3f93;
            font-weight: bold;
        }

        .container {
            width: 75%;
            margin: 40px auto;
        }

        .hero {
            background: #1f3f93;
            color: white;
            padding: 35px;
            border-radius: 16px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            width: 30%;
            background: #1f3f93;
            color: white;
            padding: 15px;
            text-align: left;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
        }

        .back { background: #64748b; }
        .edit { background: #f59e0b; }
    </style>
</head>
<body>

<div class="header">
    <h2>Portal E-Learning Akademik</h2>
    <p>Sistem pengelolaan data akademik berbasis web</p>
</div>

<div class="navbar">
    <a href="/">Beranda</a>
    <a href="/materi">Materi</a>
    <a href="/siswa">Siswa</a>
    <a href="/mata-pelajaran">Mata Pelajaran</a>
    <a href="/guru">Guru</a>
</div>

<div class="container">
    <div class="hero">
        <h1>Detail Data Guru</h1>
        <p>Informasi lengkap data guru Portal E-Learning Akademik.</p>
    </div>

    <div class="card">
        <table>
            <tr>
                <th>Nama</th>
                <td>{{ $guru->nama }}</td>
            </tr>
            <tr>
                <th>NIP</th>
                <td>{{ $guru->nip }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $guru->email }}</td>
            </tr>
            <tr>
                <th>No HP</th>
                <td>{{ $guru->no_hp }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $guru->alamat }}</td>
            </tr>
            <tr>
                <th>Mapel</th>
                <td>{{ $guru->mapel }}</td>
            </tr>
        </table>

        <a href="{{ route('guru.index') }}" class="btn back">Kembali</a>
        <a href="{{ route('guru.edit', $guru->id) }}" class="btn edit">Edit</a>
    </div>
</div>

</body>
</html>