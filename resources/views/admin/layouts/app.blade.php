<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Readora</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Notifications CSS -->
    <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary-color: #710014;
            --secondary-color: #F2F1ED;
            --sidebar-bg: #F2F1ED;
            --sidebar-text: #B38F6F;
            --sidebar-text-active: #710014;
            --sidebar-hover: #F2F1ED;
            --sidebar-active: #f8fafc;
            --background-color: #F2F1ED;
            --text-color: #1f2937;
            --success-color: #10B981;
            --error-color: #EF4444;
            --warning-color: #F59E0B;
            --border-color: #e5e7eb;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }

        .sidebar {
            background-color: var(--sidebar-bg);
            min-height: 100vh;
            width: 280px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            border-right: 2px solid #710014;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid #710014;
            background: #F2F1ED;
        }

        .sidebar .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: #710014 !important;
            font-size: 1.4rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar .navbar-brand i {
            font-size: 1.6rem;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .sidebar .nav-link {
            color: var(--sidebar-text);
            padding: 12px 24px;
            border-radius: 0;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 14px;
            display: flex;
            align-items: center;
            margin: 2px 16px;
            border-radius: 10px;
            position: relative;
        }

        .sidebar .nav-link:hover {
            background-color: var(--sidebar-hover);
            color: var(--sidebar-text-active);
            transform: translateX(2px);
        }

        .sidebar .nav-link.active {
            background-color: var(--sidebar-active);
            color: var(--sidebar-text-active);
            font-weight: 600;
        }

        .sidebar .nav-link.active::before {
            content: '';
            position: absolute;
            left: -16px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 24px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        .sidebar .nav-link i {
            margin-right: 12px;
            width: 20px;
            font-size: 18px;
            text-align: center;
        }

        .sidebar-divider {
            margin: 20px -16px;
            border-top: 1px solid #710014;
        }

        .logout-section {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            padding: 0 16px;
        }

        .logout-btn {
            color: #710014;
            padding: 12px 24px;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
            font-weight: 500;
            font-size: 14px;
            display: flex;
            align-items: center;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .logout-btn:hover {
            background-color: #F2F1ED;
            color: #410510;
        }

        .logout-btn i {
            margin-right: 12px;
            width: 20px;
            font-size: 18px;
            text-align: center;
        }

        .main-content {
            margin-left: 280px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--background-color);
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 50px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:focus,
        .btn-primary:active {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            color: #fff !important;
            box-shadow: none;
        }

        .btn-secondary {
            background-color: var(--background-color);
            color: #6b7280;
            border: 2px solid #6b7280;
            border-radius: 50px;
        }

        .card {
            border: 1px solid var(--border-color);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            border-radius: 12px 12px 0 0 !important;
        }


        /* Main Content Adjustment */
        .main-content {
            padding-top: 30px;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: -280px;
            }

            .sidebar.show {
                margin-left: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Custom scrollbar for sidebar */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-book-fill"></i>
                <span>Readora Admin</span>
            </a>
        </div>

        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-grid-1x2"></i>
                        <span>Dasbor</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}"
                        href="{{ route('admin.books.index') }}">
                        <i class="bi bi-book"></i>
                        <span>Buku</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.authors.*') ? 'active' : '' }}"
                        href="{{ route('admin.authors.index') }}">
                        <i class="bi bi-person-fill"></i>
                        <span>Penulis</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.publishers.*') ? 'active' : '' }}"
                        href="{{ route('admin.publishers.index') }}">
                        <i class="bi bi-building"></i>
                        <span>Penerbit</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                        href="{{ route('admin.categories.index') }}">
                        <i class="bi bi-tags"></i>
                        <span>Kategori</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}"
                        href="{{ route('admin.profile.index') }}">
                        <i class="bi bi-person"></i>
                        <span>Profil</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="logout-section">
            <div class="sidebar-divider"></div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">

        <!-- Page Content -->
        <div class="container-fluid">
            @if(session('success'))
                <div class="toast-notification toast-success show">
                    <div class="toast-content">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button class="toast-close" onclick="hideNotification(this.parentElement)">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <script>
                    setTimeout(() => {
                        hideNotification(document.querySelector('.toast-notification'));
                    }, 3000);
                </script>
            @endif

            @if(session('error'))
                <div class="toast-notification toast-error show">
                    <div class="toast-content">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button class="toast-close" onclick="hideNotification(this.parentElement)">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <script>
                    setTimeout(() => {
                        hideNotification(document.querySelector('.toast-notification'));
                    }, 5000);
                </script>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('show');
        });

        // Function to hide notifications
        function hideNotification(notification) {
            if (notification) {
                notification.classList.add('hide');
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 300);
            }
        }
    </script>

    @stack('scripts')
</body>

</html>