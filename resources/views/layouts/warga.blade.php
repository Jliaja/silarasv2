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

        /* ========= NAVBAR BIRU GRADASI ========= */
        .navbar {
            background: linear-gradient(135deg, #0f2b4d 0%, #1a4a6f 100%);
            color: white;
            padding: 12px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar-logo {
            width: 45px;
            height: 45px;
            object-fit: contain;
        }

        .navbar-brand {
            display: flex;
            flex-direction: column;
        }

        .navbar-brand h2 {
            font-size: 20px;
            font-weight: 700;
            color: white;
            margin: 0;
            line-height: 1.2;
        }

        .navbar-brand span {
            font-size: 10px;
            color: rgba(255,255,255,0.7);
            letter-spacing: 0.5px;
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
            background: rgba(255,255,255,0.15);
            padding: 6px 12px 6px 8px;
            border-radius: 40px;
            transition: background 0.2s;
        }

        .user-trigger:hover {
            background: rgba(255,255,255,0.25);
        }

        .user-avatar {
            background: #f39c12;
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

        /* ========= RESPONSIVE ========= */
        @media (max-width: 640px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="navbar-left">
            <img src="{{ asset('images/logo-indramayu.png') }}" alt="Logo Indramayu" class="navbar-logo">
            <div class="navbar-brand">
                <h2>SILARAS</h2>
                <span>Sistem Layanan Surat Desa Digital</span>
            </div>
        </div>
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