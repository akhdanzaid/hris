<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS - Bantu HRD</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    @stack('styles')

    <style>
        body {
            background: #f3f4f6;
            margin: 0;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #1f2937;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            color: #fff;
        }

        .sidebar h4 {
            font-weight: 700;
            margin-bottom: 30px;
        }

        .sidebar a {
            color: #d1d5db;
            text-decoration: none;
            padding: 12px 24px;
            display: block;
            font-size: 15px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #374151;
            color: #fff;
        }

        /* Navbar */
        .navbar-custom {
            margin-left: 250px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            height: 60px;
        }

        /* Navbar link base */
        .navbar-custom a {
            position: relative;
            padding-bottom: 4px;
            color: #374151;
            transition: color 0.2s ease;
        }

        /* Underline */
        .navbar-custom a::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 2px;
            background-color: #1f2937;
            transition: width 0.25s ease;
        }

        /* Hover effect */
        .navbar-custom a:hover {
            color: #111827;
        }

        .navbar-custom a:hover::after {
            width: 100%;
        }

        /* Active (halaman sedang dibuka) */
        .navbar-custom a.active {
            color: #111827;
            font-weight: 500;
        }

        .navbar-custom a.active::after {
            width: 100%;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
        }

        .nav-link-custom {
            text-decoration: none;
            color: #000000ff;
            position: relative;
        }

        .nav-divider {
            width: 3px;
            height: 18px;
            background-color: #d1d5db;
        }

        /* Content */
        .content {
            margin-left: 250px;
            padding: 24px;
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4 class="text-center">HRIS</h4>

    <a href="#">Dashboard</a>
    <a href="#">Absensi</a>
    <a href="#">Cuti</a>
</div>

<!-- NAVBAR -->
<nav class="navbar navbar-expand navbar-custom px-4">
    <div class="container-fluid">
        <span class="fw-semibold">
            @yield('page-title', 'Dashboard')
        </span>

        <div class="d-flex align-items-center gap-4">
            <a href="{{ route('pengumuman.index') }}" class="text-decoration-none text-dark">
                Pengumuman
            </a>

            <div class="nav-divider"></div>

            <a href="{{ route('akun.edit') }}" class="text-decoration-none text-dark">
                <span>Hi,@if(Auth::check())
                {{ Auth::user()->username }}
                @endif
            </span>
            </a>

            <form action="{{ route('logout') }}" method="POST" class="d-inline-flex m-0 px-0">
            @csrf
            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin mau logout?')">Logout</button>
            </form>
            
        </div>
    </div>
</nav>


<!-- MAIN CONTENT -->
<div class="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
