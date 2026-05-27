<!DOCTYPE html>
<html>
<head>
    <title>Data Guru</title>
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #eef3fb;
            color: #111827;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: #0f172a;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            padding: 30px 25px;
        }

        .brand {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .subtitle {
            color: #94a3b8;
            margin-bottom: 40px;
        }

        .menu-title {
            color: #94a3b8;
            font-size: 14px;
            margin: 25px 0 15px;
        }

        .menu a {
            display: block;
            padding: 14px 18px;
            margin-bottom: 10px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 12px;
            font-weight: bold;
        }

        .menu a.active,
        .menu a:hover {
            background: #1f3f93;
            color: white;
        }

        .content {
            margin-left: 260px;
            padding: 50px;
        }

        .hero {
            background: #1f3f93;
            color: white;
            padding: 40px;
            border-radius: 25px;
            margin-bottom: 30px;
        }

        .hero h1 {
            font-size: 38px;
            margin: 0 0 15px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 28px;
            border-radius: 22px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        .stat-card p {
            color: #64748b;
            margin: 0 0 15px;
            font-weight: bold;
        }

        .stat-card h2 {
            color: #1f3f93;
            font-size: 34px;
            margin: 0;
        }

        .table-card {
            background: white;
            padding: 30px;
            border-radius: 22px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        .table-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .table-top h2 {
            margin: 0;
            font-size: 30px;
        }

        .table-top p {
            color: #64748b;
            margin-top: 8px;
        }

        .btn-add {
            background: #1f3f93;
            color: white;
            padding: 14px 22px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #1f3f93;
            color: white;
            padding: 18px;
            text-align: left;
        }

        td {
            padding: 18px;
            border-bottom: 1px solid #e5e7eb;
        }

        .btn {
            padding: 10px 14px;
            border-radius: 12px;
            text-decoration: none;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            margin-right: 5px;
        }

        .detail { background: #2563eb; }
        .edit { background: #60a5fa; color: #0f172a; }
        .hapus { background: #ef4444; }

    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">Portal E-Learning</div>
    <div class="subtitle">Akademik Web System</div>

    <div class="menu">
        <div class="menu-title">MENU UTAMA</div>
        <a href="/">Dashboard</a>
        <a href="/materi">Materi</a>

        <div class="menu-title">MODUL ANGGOTA</div>
        <a href="/siswa">Siswa</a>
        <a href="/guru" class="active">Guru</a>
        <a href="/mata-pelajaran">Mata Pelajaran</a>
        <a href="/nilai">Nilai</a>
    </div>
</div>

<div class="content">
    <div class="hero">
        <h1>Data Guru</h1>
        <p>Data guru ditampilkan menggunakan API dari endpoint /api/guru.</p>
    </div>

    <div class="cards">
        <div class="stat-card">
            <p>Total Guru</p>
            <h2>{{ $gurus->count() }}</h2>
        </div>

        <div class="stat-card">
            <p>Modul</p>
            <h2>Guru</h2>
        </div>

        <div class="stat-card">
            <p>Penanggung Jawab</p>
            <h2>Adel</h2>
        </div>
    </div>

    <div class="table-card">
        <div class="table-top">
            <div>
                <h2>Daftar Guru</h2>
                <p>Kelola data guru menggunakan API.</p>
            </div>

            <a href="{{ route('guru.create') }}" class="btn-add">+ Tambah Guru</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIP</th>
                    <th>NAMA</th>
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
                    <td><b>{{ $guru->nama }}</b></td>
                    <td>{{ $guru->email }}</td>
                    <td>{{ $guru->no_hp }}</td>
                    <td>{{ $guru->mapel }}</td>
                    <td>
                        <a href="{{ route('guru.show', $guru->id) }}" class="btn detail">Detail</a>
                        <a href="{{ route('guru.edit', $guru->id) }}" class="btn edit">Edit</a>

                        <form action="{{ route('guru.destroy', $guru->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus data?')" class="btn hapus">Hapus</button>
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