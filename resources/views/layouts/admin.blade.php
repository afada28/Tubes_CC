<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
            --primary-color: #d9fffb;
            --secondary-color: #ebf2d5;
            --accent-color: #95ddda;
            --accent-hover: #7ec5c2;
            --sidebar-bg: #d9fffb;
            --sidebar-hover: rgba(255, 255, 255, 0.5);
            --sidebar-active: rgba(255, 255, 255, 0.7);
            --text-dark: #333;
            --text-muted: #777;
            --danger-color: #dc3545;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: var(--text-dark);
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #c5f9f5 100%);
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.05);
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 80px;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-dark);
            text-decoration: none;
            transition: all 0.3s ease;
            overflow: hidden;
            width: 100%;
        }

        .sidebar-logo-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            background: linear-gradient(135deg, var(--accent-color) 0%, #7ec5c2 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(149, 221, 218, 0.4);
            color: var(--text-dark);
        }

        .sidebar-logo-text {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: -0.02em;
            white-space: nowrap;
            transition: opacity 0.3s ease, margin 0.3s ease;
            color: var(--text-dark);
        }

        .sidebar.collapsed .sidebar-logo-text {
            opacity: 0;
            margin-left: -100px;
        }

        .sidebar-toggler {
            width: 36px;
            height: 36px;
            min-width: 36px;
            background: rgba(255, 255, 255, 0.5);
            border: none;
            border-radius: 8px;
            color: var(--text-dark);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .sidebar-toggler:hover {
            background: rgba(255, 255, 255, 0.8);
        }

        /* Navigation */
        .sidebar-menu {
            flex: 1;
            overflow-y: auto;
            padding: 20px 12px;
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-menu::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 2px;
        }

        .nav-section-title {
            color: var(--text-muted);
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 16px 16px 8px;
            white-space: nowrap;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .nav-section-title {
            opacity: 0;
        }

        .nav {
            gap: 4px;
        }

        .nav-item {
            margin-bottom: 4px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--text-dark);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .nav-link i {
            width: 20px;
            font-size: 18px;
            text-align: center;
            flex-shrink: 0;
        }

        .nav-link span {
            white-space: nowrap;
            transition: opacity 0.3s ease, margin 0.3s ease;
        }

        .sidebar.collapsed .nav-link span {
            opacity: 0;
            margin-left: -100px;
        }

        .nav-link:hover {
            background: var(--sidebar-hover);
            color: var(--text-dark);
            transform: translateX(4px);
        }

        .sidebar.collapsed .nav-link:hover {
            transform: translateX(0px);
        }

        .nav-link.active {
            background: var(--sidebar-active);
            color: var(--text-dark);
            box-shadow: 0 4px 12px rgba(149, 221, 218, 0.2);
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 24px;
            background: var(--accent-color);
            border-radius: 0 4px 4px 0;
        }

        /* Sidebar Footer */
        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .logout-link {
            color: var(--danger-color) !important;
        }

        .logout-link:hover {
            background: rgba(220, 53, 69, 0.1) !important;
        }

        /* Main Content */
        .main-content {
            padding-left: var(--sidebar-width);
            min-height: 100vh;
            transition: padding-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .main-content.expanded {
            padding-left: var(--sidebar-collapsed-width);
        }

        /* Top Navbar */
        .top-navbar {
            background: white;
            padding: 16px 32px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            background: #f8fafc;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .user-dropdown:hover {
            background: #f1f5f9;
            border-color: #e2e8f0;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--accent-color) 0%, #7ec5c2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 14px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
            line-height: 1.2;
        }

        .user-role {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* Content Area */
        .content-wrapper {
            flex: 1;
            padding: 32px;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                padding-left: 0;
            }

            .main-content.expanded {
                padding-left: 0;
            }

            .mobile-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .mobile-overlay.active {
                display: block;
            }

            .top-navbar {
                padding: 16px 20px;
            }

            .content-wrapper {
                padding: 20px;
            }

            .user-info {
                display: none;
            }
        }

        /* Custom Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 16px 20px;
        }

        /* Button Styling */
        .btn {
            font-weight: 500;
            border-radius: 8px;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: var(--text-dark);
        }

        .btn-primary:hover {
            background-color: var(--accent-hover);
            border-color: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(149, 221, 218, 0.3);
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <!-- Mobile Overlay -->
    <div class="mobile-overlay" id="mobileOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('dashboard') }}" class="sidebar-logo">
                <div class="sidebar-logo-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <span class="sidebar-logo-text">Graha Alfa</span>
            </a>
            <button class="sidebar-toggler d-none d-md-flex" id="sidebarToggler">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <div class="sidebar-menu">
            <div class="nav-section-title">Main Menu</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('carousel.index') }}"
                        class="nav-link {{ request()->routeIs('carousel.*') ? 'active' : '' }}">
                        <i class="fas fa-images"></i>
                        <span>Hero Carousel</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('about.index') }}"
                        class="nav-link {{ request()->routeIs('about.*') ? 'active' : '' }}">
                        <i class="fas fa-info-circle"></i>
                        <span>About Us</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('milestone.index') }}"
                        class="nav-link {{ request()->routeIs('milestone.*') ? 'active' : '' }}">
                        <i class="fas fa-flag-checkered"></i>
                        <span>Milestones</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('journey-founder.index') }}"
                        class="nav-link {{ request()->routeIs('journey-founder.*') ? 'active' : '' }}">
                        <i class="fas fa-route"></i>
                        <span>Founder Journey</span>
                    </a>
                </li>
            </ul>

            <div class="nav-section-title">Programs</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('donate.index') }}"
                        class="nav-link {{ request()->routeIs('donate.*') ? 'active' : '' }}">
                        <i class="fas fa-hand-holding-heart"></i>
                        <span>Donations</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('volunteer.index') }}"
                        class="nav-link {{ request()->routeIs('volunteer.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Volunteers</span>
                    </a>
                </li>
            </ul>

            <div class="nav-section-title">Management</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}"
                        class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-user-cog"></i>
                        <span>User Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.analytics.index') }}"
                        class="nav-link {{ request()->routeIs('admin.analytics.*') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar"></i>
                        <span>Analytics</span>
                    </a>
                </li>
            </ul>

            <div class="nav-section-title">Quick Links</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('welcome') }}" class="nav-link" target="_blank">
                        <i class="fas fa-globe"></i>
                        <span>Visit Website</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-footer">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link logout-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <div class="navbar-left">
                <button class="sidebar-toggler d-md-none" id="mobileSidebarToggler">
                    <i class="fas fa-bars"></i>
                </button>
                <h4 class="page-title">@yield('page-title', 'Dashboard')</h4>
            </div>

            <div class="navbar-right">
                <div class="dropdown">
                    <div class="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="user-info">
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <span class="user-role">Administrator</span>
                        </div>
                        <i class="fas fa-chevron-down" style="font-size: 12px; color: #777;"></i>
                    </div>

                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2"
                        style="min-width: 200px; border-radius: 10px;">
                        <li>
                            <a class="dropdown-item py-2" href="#">
                                <i class="fas fa-user-circle me-2 text-muted"></i>Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="#">
                                <i class="fas fa-cog me-2 text-muted"></i>Settings
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item py-2 text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}
                            </a>
                        </li>
                    </ul>
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const sidebarToggler = document.getElementById('sidebarToggler');
            const mobileSidebarToggler = document.getElementById('mobileSidebarToggler');
            const mobileOverlay = document.getElementById('mobileOverlay');

            // Desktop sidebar toggle
            if (sidebarToggler) {
                sidebarToggler.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    mainContent.classList.toggle('expanded');

                    // Save state to localStorage
                    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
                });
            }

            // Mobile sidebar toggle
            if (mobileSidebarToggler) {
                mobileSidebarToggler.addEventListener('click', function() {
                    sidebar.classList.add('active');
                    mobileOverlay.classList.add('active');
                });
            }

            // Close mobile sidebar when clicking overlay
            if (mobileOverlay) {
                mobileOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    mobileOverlay.classList.remove('active');
                });
            }

            // Remember sidebar state
            const sidebarCollapsed = localStorage.getItem('sidebarCollapsed');
            if (sidebarCollapsed === 'true') {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('expanded');
            }

            // Initialize tooltips if they exist
            if (typeof bootstrap !== 'undefined' && typeof bootstrap.Tooltip !== 'undefined') {
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                });
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
