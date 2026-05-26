<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal E-Learning Akademik</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f3f6fc;
            color: #111827;
            font-size: 14px;
        }

        .navbar {
            background: #1e3a8a;
            color: white;
            padding: 20px 36px;
        }

        .navbar h2 {
            margin: 0;
            font-size: 24px;
        }

        .navbar span {
            display: block;
            margin-top: 6px;
            font-size: 14px;
            opacity: 0.9;
        }

        .menu {
            background: white;
            padding: 14px 36px;
            display: flex;
            gap: 16px;
            align-items: center;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.05);
        }

        .menu-btn {
            border: none;
            background: transparent;
            color: #1e3a8a;
            font-size: 15px;
            font-weight: 700;
            padding: 10px 16px;
            border-radius: 12px;
            cursor: pointer;
        }

        .menu-btn i { margin-right: 6px; }

        .menu-btn.active {
            background: #eff6ff;
            box-shadow: inset 0 -3px 0 #1e3a8a;
        }

        .page { padding: 28px 36px; }

        .card {
            background: white;
            padding: 24px;
            border-radius: 18px;
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.07);
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
            gap: 12px;
            flex-wrap: wrap;
        }

        .toolbar h2 {
            font-size: 24px;
            margin: 0;
        }

        .form-box {
            display: none;
            background: white;
            padding: 24px;
            border-radius: 18px;
            margin-bottom: 22px;
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.07);
        }

        .form-box h2 {
            margin-top: 0;
            font-size: 22px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }

        .full { grid-column: 1 / -1; }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #334155;
        }

        input, select, textarea {
            width: 100%;
            border: 1px solid #d6deec;
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 14px;
            font-family: inherit;
            background: #f8fbff;
            outline: none;
        }

        textarea {
            min-height: 80px;
            resize: vertical;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #1e3a8a;
            background: white;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th {
            background: #1e3a8a;
            color: white;
            padding: 12px 14px;
            text-align: left;
            font-size: 14px;
        }

        td {
            padding: 12px 14px;
            border: 1px solid #eef2f7;
            font-size: 14px;
        }

        button {
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-weight: 700;
            transition: 0.2s;
        }

        .btn-primary {
            background: #1e3a8a;
            color: white;
            padding: 11px 16px;
            border-radius: 11px;
            font-size: 14px;
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
            padding: 11px 16px;
            border-radius: 11px;
            font-size: 14px;
        }

        .btn-detail, .btn-edit, .btn-delete {
            width: 38px;
            height: 38px;
            border-radius: 11px;
            margin-right: 5px;
            font-size: 14px;
        }

        .btn-detail {
            background: #eff6ff;
            color: #1e3a8a;
        }

        .btn-edit {
            background: #dbeafe;
            color: #1e3a8a;
        }

        .btn-delete {
            background: #fee2e2;
            color: #b91c1c;
        }

        .form-actions {
            margin-top: 18px;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .detail-box {
            text-align: left;
            display: grid;
            gap: 10px;
        }

        .detail-item {
            background: #f8fbff;
            border: 1px solid #e5eaf3;
            border-radius: 12px;
            padding: 10px 12px;
        }

        .detail-label {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 3px;
            font-weight: 700;
        }

        .detail-value {
            font-size: 14px;
            color: #111827;
        }

        @media (max-width: 900px) {
            .navbar, .menu, .page {
                padding-left: 18px;
                padding-right: 18px;
            }

            .menu { flex-wrap: wrap; }

            .form-grid { grid-template-columns: 1fr; }

            table { min-width: 900px; }

            .card { overflow-x: auto; }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h2>Portal E-Learning Akademik</h2>
        <span>Sistem pengelolaan data akademik berbasis RESTful API</span>
    </div>

    <div class="menu">
        <button class="menu-btn active" onclick="loadSiswa()">
            <i class="fa-solid fa-user-graduate"></i> Siswa
        </button>

        <button class="menu-btn" onclick="loadKosong('Guru')">
            <i class="fa-solid fa-chalkboard-user"></i> Guru
        </button>

        <button class="menu-btn" onclick="loadKosong('Mata Pelajaran')">
            <i class="fa-solid fa-book"></i> Mata Pelajaran
        </button>

        <button class="menu-btn" onclick="loadKosong('Materi')">
            <i class="fa-solid fa-file-lines"></i> Materi
        </button>

        <button class="menu-btn" onclick="loadKosong('Nilai')">
            <i class="fa-solid fa-chart-simple"></i> Nilai
        </button>
    </div>

    <div class="page" id="content"></div>

</body>
</html>