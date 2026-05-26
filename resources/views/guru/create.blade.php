<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Guru</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            background: #eef2ff;
            margin: 0;
            padding: 0;
        }

        .container{
            width: 500px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        h1{
            text-align: center;
            color: #1e3a8a;
            margin-bottom: 30px;
        }

        label{
            font-weight: bold;
            color: #1e3a8a;
        }

        input{
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            margin-bottom: 20px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            box-sizing: border-box;
        }

        input:focus{
            outline: none;
            border-color: #2563eb;
        }

        button{
            width: 100%;
            padding: 12px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover{
            background: #1d4ed8;
        }

        .back{
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #2563eb;
            font-weight: bold;
        }

    </style>
</head>
<body>

    <div class="container">

        <h1>Tambah Data Guru</h1>

        <form action="{{ route('guru.store') }}" method="POST">
            @csrf

            <label>Nama</label>
            <input type="text" name="nama">

            <label>NIP</label>
            <input type="text" name="nip">

            <label>Email</label>
            <input type="email" name="email">

            <label>No HP</label>
            <input type="text" name="no_hp">

            <label>Alamat</label>
            <input type="text" name="alamat">

            <label>Mapel</label>
            <input type="text" name="mapel">

            <button type="submit">Simpan</button>
        </form>

        <a href="{{ route('guru.index') }}" class="back">
            Kembali
        </a>

    </div>

</body>
</html>