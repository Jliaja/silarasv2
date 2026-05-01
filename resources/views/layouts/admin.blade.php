<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SILARAS - Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f0f4f8;
        }

        /* ========= SIDEBAR BIRU ========= */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100%;
            background: #0073ff;
            color: #1e3a5f;
            padding: 25px 20px;
            box-shadow: 2px 0 15px rgba(0,0,0,0.05);
            z-index: 100;
            overflow-y: auto;
        }

        .sidebar-header {
            margin-bottom: 35px;
            padding-bottom: 20px;
            border-bottom: 1px solid #0080ff;
        }

        .sidebar-header h2 {
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
        }

        .sidebar-header p {
            font-size: 11px;
            color: #ffffff;
            margin: 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #ffffff;
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .sidebar-menu a:hover {
            background: #b8d4f0;
            color: #0f2b4d;
        }

        /* ========= KONTEN UTAMA ========= */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            background: #f0f4f8;
        }

        /* ========= TOPBAR ========= */
        .topbar {
            background: white;
            padding: 14px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .page-title {
            font-size: 20px;
            font-weight: 700;
            color: #1e3a5f;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* Dropdown Profile */
        .user-dropdown {
            position: relative;
        }

        .user-trigger {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            background: #f1f5f9;
            padding: 6px 12px 6px 8px;
            border-radius: 40px;
            transition: background 0.2s;
        }

        .user-trigger:hover {
            background: #e2e8f0;
        }

        .user-avatar {
            background: #2c7cb6;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 50px;
            background: white;
            border-radius: 14px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
            min-width: 200px;
            display: none;
            z-index: 1000;
            overflow: hidden;
        }

        .dropdown-menu a, .dropdown-menu button {
            display: block;
            width: 100%;
            text-align: left;
            padding: 12px 18px;
            color: #1e3a5f;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.2s;
        }

        .dropdown-menu a:hover, .dropdown-menu button:hover {
            background: #f1f5f9;
        }

        .dropdown-menu hr {
            margin: 0;
            border: none;
            border-top: 1px solid #e2e8f0;
        }

        /* ========= CARD & TABEL ========= */
        .content-container {
            padding: 25px 30px;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 20px 25px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        }

        .stats-row {
            display: flex;
            gap: 25px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 22px 25px;
            flex: 1;
            min-width: 200px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
            border-left: 5px solid #2c7cb6;
        }

        .stat-number {
            font-size: 34px;
            font-weight: 800;
            color: #1e3a5f;
        }

        .stat-label {
            color: #5a7d9a;
            font-size: 14px;
            margin-top: 6px;
        }

        .stat-sub {
            font-size: 12px;
            color: #8ba3bc;
            margin-top: 4px;
        }

        .chart-card {
            background: white;
            border-radius: 20px;
            padding: 20px 24px;
            margin-bottom: 28px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        }

        .chart-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #1e3a5f;
        }

        .btn {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #2c7cb6;
            color: white;
        }

        .btn-primary:hover {
            background: #1e5a8a;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #cbd5e1;
            color: #334155;
        }

        .btn-outline:hover {
            background: #f8fafc;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            padding: 12px 18px;
            border-radius: 14px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
            }
            .sidebar-header p, .sidebar-menu a span:last-child {
                display: none;
            }
            .main-content {
                margin-left: 80px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <div style="display: flex; align-items: center; gap: 12px;">
                <img src="{{ asset('images/logo-indramayu.png') }}" alt="Logo" style="width: 45px;">
                <div>
                    <h2>SILARAS</h2>
                    <p>Sistem Layanan Surat Desa Digital</p>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
            <a href="{{ route('admin.kategori.index') }}">📁 Kategori Surat</a>
            <a href="{{ route('admin.pejabat.index') }}">👥 Data Pejabat</a>
            <a href="{{ route('admin.penomoran.index') }}">🔢 Penomoran Surat</a>
            <a href="{{ route('admin.pengajuan.index') }}">📨 Permohonan Surat</a>
            <a href="{{ route('admin.surat-keluar.index') }}">📑 Surat Keluar</a>
        </div>
    </div>

    <div class="main-content">
        <div class="topbar">
            <div class="page-title">@yield('title')</div>
            <div class="user-info">
                <div class="user-dropdown">
                    <div class="user-trigger">
                        <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                        <span>{{ Auth::user()->name }}</span>
                        <span>▼</span>
                    </div>
                    <div class="dropdown-menu">
                        <a href="{{ route('admin.profile.edit') }}">👤 Edit Profil</a>
                        <hr>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">🚪 Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-container">
            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @yield('content')
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const trigger = document.querySelector('.user-trigger');
            const dropdown = document.querySelector('.dropdown-menu');
            
            if (trigger && dropdown) {
                trigger.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                });
                
                document.addEventListener('click', function() {
                    dropdown.style.display = 'none';
                });
                
                dropdown.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
        });
    </script>
</body>
</html>