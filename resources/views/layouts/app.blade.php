<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Graha Alfa Amertha Indonesia - Social • Humanitarian • Spiritual">
    <title>@yield('title', 'Graha Alfa Amertha Indonesia - Social • Humanitarian • Spiritual')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    @vite(['resources/css/app.css', 'public/assets/css/admin.css'])

</head>
<body>
    <!-- Premium Navigation -->
    <nav class="navbar-premium" id="mainNavbar">
        <div class="container">
            <div class="navbar-inner">
                <a href="{{ route('welcome') }}" class="navbar-brand-premium">
                    <div class="navbar-brand-icon">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <div class="navbar-brand-text">
                        <span class="brand-title">Graha Alfa Amertha Indonesia</span>
                        <span class="brand-tagline"> Social • Humanitarian • Spiritual</span>
                    </div>
                </a>

                <button class="navbar-toggler-premium d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <i class="bi bi-list"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="mobile-menu-wrapper d-lg-none">
                        <div class="navbar-menu">
                            <a href="{{ route('welcome') }}#about" class="nav-link-premium">About</a>
                            <a href="{{ route('welcome') }}#beliefs" class="nav-link-premium">Foundation</a>
                            <a href="{{ route('welcome') }}#journey" class="nav-link-premium">Journey</a>
                            <a href="{{ route('welcome') }}" class="nav-link-premium">Volunteer</a>
                            <a href="{{ route('welcome') }}#active-donations" class="btn-nav-donate">
                                <i class="bi bi-heart-fill"></i>
                                <span>Donate Now</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="navbar-menu d-none d-lg-flex">
                    <a href="{{ route('welcome') }}#introduction" class="nav-link-premium">About</a>
                    <a href="{{ route('welcome') }}#beliefs" class="nav-link-premium">Foundation</a>
                    <a href="{{ route('welcome') }}#journey" class="nav-link-premium">Journey</a>
                    <a href="{{ route('welcome') }}" class="nav-link-premium">Volunteer</a>
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('dashboard') }}" class="nav-link-premium">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('subscription.index') }}" class="nav-link-premium">
                                <i class="bi bi-star-fill"></i> Subscription
                            </a>
                        @endif

                        <div class="dropdown">
                            <a href="#" class="nav-link-premium dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                @if(auth()->user()->avatar)
                                    <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover; margin-right: 5px;">
                                @else
                                    <i class="bi bi-person-circle"></i>
                                @endif
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="#"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="nav-link-premium">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    @endauth
                    <a href="{{ route('welcome') }}#active-donations" class="btn-nav-donate">
                        <i class="bi bi-heart-fill"></i>
                        <span>Donate Now</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Premium Footer -->
    <footer>
        <div class="container">
            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <div class="navbar-brand-icon">
                            <i class="bi bi-heart-fill"></i>
                        </div>
                        <h4 class="mb-0">Graha Alfa Amertha Indonesia</h4>
                    </div>
                    <p class="mb-4">
                        Together building a better future through caring and kindness for others.
                    </p>
                    <div class="social-links">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6>Menu</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#about">About Us</a></li>
                        <li class="mb-2"><a href="#beliefs">Visi & Mision</a></li>
                        <li class="mb-2"><a href="#journey">Journey</a></li>
                        <li class="mb-2"><a href="{{route ('welcome')}}#active-donations"">Donation</a></li>
                        <li class="mb-2"><a href="{{route ('welcome')}}#active-volunteers">Volunteer</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6>Program</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{route ('welcome')}}#active-donations">Donation</a></li>
                        <li class="mb-2"><a href="{{route ('welcome')}}#active-volunteers">Volunteer</a></li>
                    </ul>
                </div>

                <div class="col-lg-4">
                    <h6>Contact Us</h6>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="bi bi-geo-alt-fill me-2" style="color: var(--primary);"></i>
                            Jl. Kebaikan No. 123, Surabaya, Indonesia
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-envelope-fill me-2" style="color: var(--primary);"></i>
                            info@cahayaharapan.org
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-telephone-fill me-2" style="color: var(--primary);"></i>
                            +62 31 1234 5678
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-clock-fill me-2" style="color: var(--primary);"></i>
                            Senin - Jumat: 08:00 - 17:00
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-4 border-top" style="border-color: rgba(255, 255, 255, 0.1) !important;">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <p class="mb-0">&copy; 2025 Graha Alfa Amertha Indonesia.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Dropdown Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize dropdown manually
            const dropdownToggle = document.getElementById('userDropdown');
            if (dropdownToggle) {
                dropdownToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const dropdownMenu = this.nextElementSibling;
                    const isExpanded = this.getAttribute('aria-expanded') === 'true';

                    // Toggle dropdown
                    if (isExpanded) {
                        dropdownMenu.classList.remove('show');
                        this.setAttribute('aria-expanded', 'false');
                    } else {
                        dropdownMenu.classList.add('show');
                        this.setAttribute('aria-expanded', 'true');
                    }
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!dropdownToggle.contains(e.target)) {
                        const dropdownMenu = dropdownToggle.nextElementSibling;
                        dropdownMenu.classList.remove('show');
                        dropdownToggle.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        });
    </script>

    <!-- Custom JS -->
    @vite(['resources/js/app.js', 'public/assets/js/admin.js'])
</body>
</html>
