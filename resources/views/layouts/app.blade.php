<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal E-Learning Akademik')</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --primary: #1e3a8a;
            --primary-dark: #172554;
            --primary-soft: #eff6ff;
            --bg: #f3f6fc;
            --card: #ffffff;
            --text: #1f2937;
            --muted: #64748b;
            --border: #e5eaf3;
            --green-bg: #dcfce7;
            --green-text: #166534;
            --red-bg: #fee2e2;
            --red-text: #b91c1c;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: var(--bg);
            margin: 0;
            color: var(--text);
        }

        .navbar {
            background: var(--primary);
            color: white;
            padding: 18px 36px;
            box-shadow: 0 10px 28px rgba(30, 58, 138, 0.25);
        }

        .navbar-content {
            max-width: 1200px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            flex-wrap: wrap;
        }

        .navbar h2 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
            letter-spacing: 0.2px;
        }

        .navbar span {
            font-size: 13px;
            opacity: 0.85;
        }

        .menu {
            background: white;
            border-bottom: 1px solid var(--border);
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
        }

        .menu-content {
            max-width: 1200px;
            margin: auto;
            padding: 12px 36px;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .menu a {
            text-decoration: none;
            color: var(--primary);
            font-size: 14px;
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 12px;
            transition: 0.2s;
        }

        .menu a:hover {
            background: var(--primary-soft);
        }

        .page {
            min-height: calc(100vh - 120px);
            padding: 32px 18px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .container-small {
            max-width: 950px;
            margin: auto;
        }

        .header {
            background: var(--primary);
            color: white;
            border-radius: 26px;
            padding: 30px;
            margin-bottom: 22px;
            box-shadow: 0 18px 40px rgba(30, 58, 138, 0.22);
        }

        .header h1 {
            margin: 0;
            font-size: 31px;
            font-weight: 600;
        }

        .header p {
            margin: 10px 0 0;
            line-height: 1.6;
            opacity: 0.9;
            max-width: 760px;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 22px;
        }

        .stat-card,
        .panel,
        .card,
        .section,
        .profile-card,
        .loading-box {
            background: var(--card);
            border: 1px solid var(--border);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.07);
        }

        .stat-card {
            border-radius: 22px;
            padding: 20px;
        }

        .stat-card span {
            display: block;
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 8px;
        }

        .stat-card h2 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
            color: #111827;
        }

        .panel,
        .card,
        .section,
        .profile-card {
            border-radius: 26px;
            padding: 24px;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .search-box {
            flex: 1;
            min-width: 260px;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid #d6deec;
            border-radius: 14px;
            padding: 13px 14px;
            outline: none;
            font-size: 14px;
            font-family: inherit;
            background: #f8fbff;
            color: var(--text);
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.11);
        }

        textarea {
            min-height: 105px;
            resize: vertical;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-size: 14px;
            color: #334155;
            font-weight: 500;
        }

        .btn,
        button {
            border: none;
            border-radius: 13px;
            padding: 11px 15px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            transition: 0.2s;
            font-weight: 500;
        }

        .btn-primary,
        button {
            background: var(--primary);
            color: white;
            box-shadow: 0 8px 18px rgba(30, 58, 138, 0.18);
        }

        .btn-primary:hover,
        button:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
            box-shadow: none;
        }

        .btn-detail {
            background: var(--primary-soft);
            color: var(--primary);
            box-shadow: none;
        }

        .btn-edit {
            background: #dbeafe;
            color: var(--primary);
            box-shadow: none;
        }

        .btn-delete {
            background: var(--red-bg);
            color: var(--red-text);
            box-shadow: none;
        }

        .btn-detail:hover {
            background: #dbeafe;
            color: var(--primary);
        }

        .btn-edit:hover {
            background: #bfdbfe;
            color: var(--primary);
        }

        .btn-delete:hover {
            background: #fecaca;
            color: var(--red-text);
        }

        .btn-icon {
            width: 48px;
            height: 48px;
            padding: 0;
            border-radius: 16px;
            font-size: 17px;
        }

        .btn-icon i {
            pointer-events: none;
        }

        .btn:disabled,
        button:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .table-wrapper {
            overflow-x: auto;
            border: 1px solid #eef2f7;
            border-radius: 18px;
        }

        table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
            background: white;
        }

        th {
            text-align: left;
            background: var(--primary);
            color: white;
            padding: 14px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            border: 1px solid var(--primary);
        }

        td {
            padding: 14px;
            border: 1px solid #eef2f7;
            font-size: 14px;
            vertical-align: middle;
        }

        tr:hover td {
            background: #f8fbff;
        }

        a {
            color: var(--primary);
        }

        .student-info {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .avatar,
        .detail-avatar {
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            flex-shrink: 0;
        }

        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 14px;
        }

        .detail-avatar {
            width: 96px;
            height: 96px;
            border-radius: 24px;
            font-size: 40px;
        }

        .student-name {
            color: #111827;
            font-weight: 500;
        }

        .student-email {
            color: var(--muted);
            font-size: 13px;
            margin-top: 3px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 7px 11px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-blue {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .badge-green {
            background: var(--green-bg);
            color: var(--green-text);
        }

        .badge-red {
            background: var(--red-bg);
            color: var(--red-text);
        }

        .action-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        .empty {
            text-align: center;
            color: var(--muted);
            padding: 35px;
        }

        .info-box {
            background: var(--primary-soft);
            border: 1px solid #bfdbfe;
            color: var(--primary);
            padding: 14px 16px;
            border-radius: 17px;
            margin-bottom: 22px;
            font-size: 14px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .actions {
            margin-top: 22px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }

        .profile-top {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .profile-info h2 {
            margin: 0;
            font-size: 27px;
            font-weight: 600;
            color: #111827;
        }

        .profile-info p {
            margin: 7px 0 0;
            color: var(--muted);
            font-size: 15px;
        }

        .badge-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 14px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1.4fr 0.8fr;
            gap: 22px;
            margin-top: 22px;
        }

        .section h3 {
            margin: 0 0 20px;
            font-size: 20px;
            font-weight: 600;
            color: #111827;
        }

        .data-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .data-item,
        .summary-item {
            background: #f8fbff;
            border: 1px solid #edf2f7;
            border-radius: 18px;
            padding: 17px;
        }

        .data-item.full {
            grid-column: 1 / -1;
        }

        .label {
            font-size: 12px;
            color: var(--muted);
            font-weight: 500;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .value {
            color: #111827;
            font-size: 16px;
            font-weight: 400;
            line-height: 1.5;
            word-break: break-word;
        }

        .summary-list {
            display: grid;
            gap: 14px;
        }

        .summary-item span {
            display: block;
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 7px;
        }

        .summary-item strong {
            display: block;
            color: #111827;
            font-size: 17px;
            font-weight: 500;
        }

        .loading-box {
            border-radius: 26px;
            padding: 45px;
            text-align: center;
            color: var(--muted);
        }

        @media (max-width: 850px) {
            .navbar {
                padding: 16px 18px;
            }

            .menu-content {
                padding: 12px 18px;
            }

            .page {
                padding: 20px 12px;
            }

            .header {
                padding: 24px;
            }

            .header h1 {
                font-size: 26px;
            }

            .stat-grid,
            .form-grid,
            .content-grid,
            .data-grid {
                grid-template-columns: 1fr;
            }

            .toolbar {
                align-items: stretch;
            }

            .btn-primary,
            .actions .btn,
            .actions button {
                width: 100%;
            }

            .profile-top {
                flex-direction: column;
                align-items: flex-start;
            }

            .actions {
                justify-content: stretch;
            }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="navbar-content">
            <div>
                <h2>Portal E-Learning Akademik</h2>
                <span>Sistem pengelolaan data akademik berbasis web</span>
            </div>
        </div>
    </div>

    <div class="menu">
        <div class="menu-content">
            <a href="{{ url('/') }}">Beranda</a>
            <a href="{{ route('materi.index') }}">Materi</a>
            <a href="{{ route('siswa.index') }}">Siswa</a>
            <a href="{{ route('mata-pelajaran.index') }}">Mata Pelajaran</a>
        </div>
    </div>

    @yield('content')

    @yield('scripts')

</body>
</html>