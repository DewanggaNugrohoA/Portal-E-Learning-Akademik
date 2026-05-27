<!DOCTYPE html>
<html>
<head>
    <title>Edit Guru</title>

    <style>

        body{
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f6fc;
        }

        .header{
            background: #1f3f93;
            color: white;
            padding: 25px 160px;
        }

        .navbar{
            background: white;
            padding: 20px 160px;
        }

        .navbar a{
            margin-right: 40px;
            text-decoration: none;
            color: #1f3f93;
            font-weight: bold;
        }

        .container{
            width: 75%;
            margin: 40px auto;
        }

        .hero{
            background: #1f3f93;
            color: white;
            padding: 35px;
            border-radius: 16px;
            margin-bottom: 30px;
        }

        .card{
            background: white;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        label{
            display: block;
            margin-top: 15px;
            margin-bottom: 8px;
            font-weight: bold;
            color: #1f3f93;
        }

        input{
            width: 100%;
            padding: 12px;
            border: 1px solid #dbeafe;
            border-radius: 10px;
            box-sizing: border-box;
        }

        input:focus{
            outline: none;
            border-color: #2563eb;
        }

        .btn{
            display: inline-block;
            margin-top: 25px;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }

        .update{
            background: #2563eb;
        }

        .back{
            background: #64748b;
        }

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
        <h1>Edit Data Guru</h1>
        <p>Ubah data guru Portal E-Learning Akademik.</p>
    </div>

    <div class="card">

        <form action="{{ route('guru.update', $guru->id) }}" method="POST">

            @csrf
            @method('PUT')

            <label>Nama</label>
            <input type="text" name="nama" value="{{ $guru->nama }}">

            <label>NIP</label>
            <input type="text" name="nip" value="{{ $guru->nip }}">

            <label>Email</label>
            <input type="email" name="email" value="{{ $guru->email }}">

            <label>No HP</label>
            <input type="text" name="no_hp" value="{{ $guru->no_hp }}">

            <label>Alamat</label>
            <input type="text" name="alamat" value="{{ $guru->alamat }}">

            <label>Mapel</label>
            <input type="text" name="mapel" value="{{ $guru->mapel }}">

            <button type="submit" class="btn update">
                Update
            </button>

            <a href="{{ route('guru.index') }}" class="btn back">
                Kembali
            </a>

        </form>

    </div>

</div>

</body>
</html>