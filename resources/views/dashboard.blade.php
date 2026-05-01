<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SILARAS - Warga</title>
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
            color: #1e293b;
        }

        /* ========= NAVBAR ========= */
        .navbar {
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

        .navbar h2 {
            font-size: 20px;
            font-weight: 700;
            color: #1e3a5f;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .nav-links a {
            color: #1e3a5f;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: #2c7cb6;
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

        .logout-btn {
            color: #e74c3c !important;
        }

        /* ========= CONTAINER ========= */
        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* ========= CARD ========= */
        .card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        }

        /* ========= TOMBOL ========= */
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #2c7cb6;
            color: white;
            text-decoration: none;
            border-radius: 40px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn:hover {
            background: #1e5a8a;
            transform: translateY(-2px);
        }

        .btn-outline {
            background: #f1f5f9;
            color: #1e293b;
            border: 1px solid #cbd5e1;
        }

        .btn-outline:hover {
            background: #e2e8f0;
        }

        /* ========= FORM ========= */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #1e3a5f;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: #2c7cb6;
            box-shadow: 0 0 0 3px rgba(44,124,182,0.1);
        }

        /* ========= BADGE ========= */
        .badge {
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
        }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-info { background: #dbeafe; color: #1e40af; }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-danger { background: #fee2e2; color: #991b1b; }

        /* ========= TOMBOL KOTAK DI DASHBOARD ========= */
        .tombol-grid {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        .tombol-kotak {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px 25px;
            text-decoration: none;
            text-align: center;
            min-width: 140px;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .tombol-kotak:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            border-color: #2c7cb6;
        }
        .tombol-icon {
            font-size: 32px;
            margin-bottom: 10px;
        }
        .tombol-text {
            font-size: 14px;
            font-weight: 600;
            color: #1e3a5f;
        }

        /* ========= TABEL ========= */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            text-align: left;
            padding: 12px;
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
        }
        .btn-detail {
            background: #2c7cb6;
            color: white;
            padding: 5px 12px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 12px;
        }

        /* ========= RESPONSIVE ========= */
        @media (max-width: 640px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
            }
            .tombol-grid {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>SILARAS</h2>
        <div class="nav-links">
            <a href="{{ route('warga.dashboard') }}">Dashboard</a>
            <a href="{{ route('warga.pengajuan.create') }}">Ajukan Surat</a>
            <a href="{{ route('warga.riwayat') }}">Riwayat</a>
            <div class="user-dropdown">
                <div class="user-trigger">
                    <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <span>{{ Auth::user()->name }}</span>
                    <span>▼</span>
                </div>
                <div class="dropdown-menu">
                    <a href="{{ route('warga.profile.edit') }}">👤 Edit Profil</a>
                    <hr style="margin: 0;">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">🚪 Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @if(session('success'))
            <div style="background: #d1fae5; color: #065f46; padding: 12px 18px; border-radius: 14px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="background: #fee2e2; color: #991b1b; padding: 12px 18px; border-radius: 14px; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
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