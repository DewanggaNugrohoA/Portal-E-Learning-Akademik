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
            --text: #111827;
            --muted: #64748b;
            --border: #e5eaf3;
            --red-bg: #fee2e2;
            --red-text: #b91c1c;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            font-size: 14px;
        }

        a {
            text-decoration: none;
        }

        .admin-wrapper {
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 270px;
            background: #0f172a;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            padding: 24px 18px;
            overflow-y: auto;
            z-index: 50;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 30px;
            padding: 0 8px;
        }

        .brand-icon {
            width: 46px;
            height: 46px;
            border-radius: 16px;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .sidebar-brand h2 {
            font-size: 17px;
            margin: 0;
            line-height: 1.3;
        }

        .sidebar-brand span {
            font-size: 12px;
            color: #94a3b8;
        }

        .sidebar-section {
            margin-bottom: 24px;
        }

        .sidebar-title {
            font-size: 11px;
            text-transform: uppercase;
            color: #94a3b8;
            letter-spacing: 0.08em;
            margin: 0 8px 10px;
        }

        .sidebar-menu {
            display: grid;
            gap: 7px;
        }

        .sidebar-menu a {
            text-decoration: none;
            color: #cbd5e1;
            padding: 12px 14px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            gap: 11px;
            transition: 0.2s;
            font-size: 14px;
            font-weight: 600;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: var(--primary);
            color: white;
        }

        .main-content {
            flex: 1;
            margin-left: 270px;
            min-width: 0;
        }

        .page {
            padding: 32px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .container-small {
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            background: var(--primary);
            color: white;
            border-radius: 24px;
            padding: 28px;
            margin-bottom: 22px;
            box-shadow: 0 18px 40px rgba(30, 58, 138, 0.20);
        }

        .header h1 {
            margin: 0;
            font-size: 30px;
            font-weight: 700;
        }

        .header p {
            margin: 10px 0 0;
            font-size: 15px;
            opacity: 0.92;
            line-height: 1.6;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 22px;
        }

        .stat-card,
        .panel,
        .card,
        .profile-card,
        .section {
            background: white;
            border: 1px solid var(--border);
            border-radius: 22px;
            padding: 24px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.07);
        }

        .stat-card span {
            display: block;
            color: var(--muted);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .stat-card h2 {
            margin: 0;
            color: var(--primary);
            font-size: 28px;
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

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #334155;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid #d6deec;
            border-radius: 12px;
            padding: 12px 13px;
            font-size: 14px;
            font-family: inherit;
            background: #f8fbff;
            outline: none;
        }

        textarea {
            min-height: 95px;
            resize: vertical;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.10);
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            border-radius: 16px;
            border: 1px solid #eef2f7;
        }

        table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
            background: white;
        }

        th {
            background: var(--primary);
            color: white;
            padding: 13px 14px;
            text-align: left;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        td {
            padding: 13px 14px;
            border: 1px solid #eef2f7;
            font-size: 14px;
            vertical-align: middle;
        }

        .btn,
        .btn-primary,
        .btn-secondary,
        .btn-detail,
        .btn-edit,
        .btn-delete {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-weight: 700;
            transition: 0.2s;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            padding: 11px 16px;
            border-radius: 12px;
            font-size: 14px;
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
            padding: 11px 16px;
            border-radius: 12px;
            font-size: 14px;
        }

        .btn-detail,
        .btn-edit,
        .btn-delete {
            min-width: 38px;
            height: 38px;
            border-radius: 11px;
            padding: 0 12px;
            font-size: 14px;
        }

        .btn-detail {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .btn-edit {
            background: #dbeafe;
            color: var(--primary);
        }

        .btn-delete {
            background: var(--red-bg);
            color: var(--red-text);
        }

        .actions,
        .form-actions {
            margin-top: 18px;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        .action-group {
            display: flex;
            gap: 7px;
            align-items: center;
            flex-wrap: wrap;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-blue {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .badge-red {
            background: var(--red-bg);
            color: var(--red-text);
        }

        .empty {
            text-align: center;
            color: var(--muted);
            padding: 28px;
        }

        .info-box {
            background: var(--primary-soft);
            color: var(--primary);
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 18px;
            font-weight: 600;
        }

        .profile-top {
            display: flex;
            gap: 18px;
            align-items: center;
        }

        .detail-avatar {
            width: 72px;
            height: 72px;
            border-radius: 18px;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .profile-info h2 {
            margin: 0;
            color: #111827;
            font-size: 24px;
        }

        .profile-info p {
            margin: 6px 0 0;
            color: var(--muted);
        }

        .badge-row {
            margin-top: 10px;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .content-grid {
            margin-top: 22px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .section h3 {
            margin-top: 0;
        }

        .data-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }

        .data-item {
            background: #f8fbff;
            border: 1px solid #e5eaf3;
            border-radius: 12px;
            padding: 12px;
        }

        .data-item.full {
            grid-column: 1 / -1;
        }

        .label {
            font-size: 12px;
            color: var(--muted);
            font-weight: 700;
            margin-bottom: 4px;
        }

        .value {
            color: #111827;
            line-height: 1.6;
        }

        @media (max-width: 1000px) {
            .admin-wrapper {
                display: block;
            }

            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .main-content {
                margin-left: 0;
            }

            .page {
                padding: 20px 14px;
            }

            .form-grid,
            .stat-grid,
            .data-grid {
                grid-template-columns: 1fr;
            }

            .header {
                padding: 22px;
            }

            .header h1 {
                font-size: 25px;
            }

            .profile-top {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<div class="admin-wrapper">
    @include('layouts.sidebar')

    <main class="main-content">
        @yield('content')
    </main>
</div>

@yield('scripts')

</body>
</html>