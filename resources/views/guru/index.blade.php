<!DOCTYPE html>
<html>
<head>
    <title>Data Guru</title>
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

        .header h2 {
            margin: 0;
        }

        .navbar {
            background: white;
            padding: 20px 160px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .navbar a {
            margin-right: 40px;
            text-decoration: none;
            color: #1f3f93;
            font-weight: bold;
        }

        .container {
            width: 75%;
            margin: 0 auto;
            padding-top: 40px;
        }

        .hero {
            background: #1f3f93;
            color: white;
            padding: 35px;
            border-radius: 16px;
            margin-bottom: 30px;
        }

        .hero h1 {
            margin: 0;
            font-size: 32px;
        }

        .btn-add {
            background: #2563eb;
            color: white;
            padding: 14px 22px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 25px;
            font-weight: bold;
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
            background: #1f3f93;
            color: white;
            padding: 15px;
        }

        td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .btn {
            padding: 8px 14px;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .detail {
            background: #22c55e;
        }

        .edit {
            background: #f59e0b;
        }

        .hapus {
            background: #dc2626;
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
            <h1>Data Guru</h1>
            <p>Kelola data guru Portal E-Learning Akademik.</p>
        </div>

        <a href="{{ route('guru.create') }}" class="btn-add">+ Tambah Guru</a>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NIP</th>
                        <th>NAMA GURU</th>
                        <th>EMAIL</th>
                        <th>NO HP</th>
                        <th>MAPEL</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gurus as $guru)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $guru->nip }}</td>
                        <td>{{ $guru->nama }}</td>
                        <td>{{ $guru->email }}</td>
                        <td>{{ $guru->no_hp }}</td>
                        <td>{{ $guru->mapel }}</td>
                        <td>
                            <a href="{{ route('guru.show', $guru->id) }}" class="btn detail">Detail</a>
                            <a href="{{ route('guru.edit', $guru->id) }}" class="btn edit">Edit</a>

                            <form action="{{ route('guru.destroy', $guru->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn hapus" onclick="return confirm('Yakin hapus data?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>