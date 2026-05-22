<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal E-Learning Akademik</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background: #1e3a8a;
            color: white;
            padding: 15px 30px;
        }

        .navbar h2 {
            margin: 0;
            font-size: 22px;
        }

        .menu {
            background: white;
            padding: 12px 30px;
            border-bottom: 1px solid #ddd;
        }

        .menu a {
            margin-right: 15px;
            text-decoration: none;
            color: #1e3a8a;
            font-weight: bold;
        }

        .container {
            width: 90%;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            background: #1e3a8a;
            color: white;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        input, textarea, select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background: #1e3a8a;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 4px;
            cursor: pointer;
        }

        a {
            color: #1e40af;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h2>Portal E-Learning Akademik</h2>
    </div>

    <div class="menu">
        <a href="{{ url('/') }}">Beranda</a>
        <a href="{{ route('materi.index') }}">Materi</a>
    </div>

    @yield('content')

</body>
</html>