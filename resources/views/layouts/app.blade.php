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
        * { box-sizing: border-box; }

        :root {
            --primary: #1e3a8a;
            --primary-soft: #eff6ff;
            --bg: #f3f6fc;
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

        a { text-decoration: none; }

        .admin-wrapper {
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 270px;
            background: #0f172a;
            color: white;
            position: fixed;
            inset: 0 auto 0 0;
            padding: 24px 18px;
            overflow-y: auto;
            z-index: 50;
        }

        .main-content {
            flex: 1;
            margin-left: 270px;
            min-width: 0;
        }

        .navbar {
            height: 72px;
            background: white;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .navbar-left h1 {
            margin: 0;
            font-size: 20px;
        }

        .navbar-left p {
            margin: 4px 0 0;
            color: var(--muted);
            font-size: 13px;
        }

        .admin-badge {
            background: var(--primary-soft);
            color: var(--primary);
            padding: 9px 13px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
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

        .page {
            padding: 32px;
        }

        .container {
            max-width: 1200px;
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

        .stat-grid,
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 22px;
        }

        .panel,
        .card,
        .stat-card,
        .dashboard-card {
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
            gap: 14px;
            flex-wrap: wrap;
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
        }

        label {
            display: block;
            font-weight: 600;
            margin: 12px 0 7px;
            color: #334155;
        }

        .btn,
        button,
        .btn-primary,
        .btn-secondary,
        .btn-detail,
        .btn-edit,
        .btn-delete {
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
            font-weight: 500;
        }

        .btn-primary,
        button {
            background: var(--primary);
            color: white;
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
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

        .action-group {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .table-wrapper {
            width: 100%;
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
            background: var(--primary);
            color: white;
            padding: 14px;
            text-align: left;
            font-size: 12px;
            text-transform: uppercase;
        }

        td {
            padding: 14px;
            border: 1px solid #eef2f7;
            font-size: 14px;
            vertical-align: middle;
        }

        .empty {
            text-align: center;
            color: var(--muted);
            padding: 35px;
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

            .navbar {
                position: static;
                padding: 14px 20px;
                height: auto;
            }

            .page {
                padding: 20px 14px;
            }

            .stat-grid,
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="admin-wrapper">
    @include('layouts.sidebar')

    <main class="main-content">
        @include('layouts.navbar')

        <div id="main-container">
            @yield('content')
        </div>
    </main>
</div>

@yield('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {
    const menuLinks = document.querySelectorAll('.menu-link');

    menuLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const url = this.getAttribute('href');

            if (url) {
                window.location.href = url;
            }
        });
    });
});
</script>

</body>
</html>