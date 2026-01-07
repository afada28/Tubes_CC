@extends('layouts.app')

@section('content')
    <!-- Section 1: Enhanced Hero Carousel -->
    <section id="hero-carousel" class="hero-section">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
            <div class="carousel-indicators">
                @foreach ($sliders as $index => $slider)
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}"
                        class="{{ $index === 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>

            <div class="carousel-inner">
                @foreach ($sliders as $index => $slider)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="hero-overlay"></div>
                        <img src="{{ asset($slider['image']) }}" class="d-block w-100" alt="{{ $slider['title'] }}"
                            loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                        <div class="hero-content">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-10 text-center">
                                        <div class="hero-badge mb-4">
                                            <i class="bi bi-heart-fill me-2"></i>Graha Alfa Amertha Indonesia
                                        </div>
                                        <h1 class="hero-title mb-4">
                                            {{ $slider['title'] }}
                                        </h1>
                                        <p class="hero-subtitle mb-5">
                                            {{ $slider['subtitle'] }}
                                        </p>
                                        <div class="hero-buttons">
                                            <a href="#introduction" class="btn btn-hero-primary">
                                                <span>Learn More</span>
                                                <i class="bi bi-arrow-down ms-2"></i>
                                            </a>
                                            <a href="{{ route('donation.index') }}" class="btn btn-hero-secondary">
                                                <span>Donate now</span>
                                                <i class="bi bi-heart-fill ms-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Decorative Elements -->
                        <div class="hero-decoration hero-decoration-1"></div>
                        <div class="hero-decoration hero-decoration-2"></div>
                        <div class="hero-decoration hero-decoration-3"></div>
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <div class="carousel-control-icon">
                    <i class="bi bi-chevron-left"></i>
                </div>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <div class="carousel-control-icon">
                    <i class="bi bi-chevron-right"></i>
                </div>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Scroll Indicator -->
        <div class="scroll-indicator">
            <div class="mouse-icon">
                <div class="wheel"></div>
            </div>
        </div>
    </section>

    <!-- Section 2: Introduction & Core Values -->
    <section id="introduction" class="introduction-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <!-- Left Content -->
                <div class="col-lg-6">
                    <div class="intro-content">
                        <h2 class="section-title mb-4">
                            {{ $introduction['title'] }}
                        </h2>

                        <div class="intro-description mb-4">
                            @foreach ($introduction['paragraphs'] as $paragraph)
                                <p class="body-text mb-4">
                                    {{ $paragraph }}
                                </p>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right Content - Core Values -->
                <div class="col-lg-6">
                    <div class="values-wrapper">
                        <div class="values-header mb-4">
                            <h3 class="values-title">Well-being Begins With</h3>
                        </div>

                        @foreach ($values as $index => $value)
                            <div class="value-card-premium">
                                <div class="value-card-inner">
                                    <div class="value-icon-wrapper">
                                        <div class="value-icon">
                                            <i class="{{ $value['icon'] }}"></i>
                                        </div>
                                        <div class="value-number">{{ sprintf('%02d', $index + 1) }}</div>
                                    </div>
                                    <div class="value-content">
                                        <h4 class="value-title">{{ $value['title'] }}</h4>
                                        <p class="value-description">{{ $value['description'] }}</p>
                                    </div>
                                    <div class="value-arrow d-none d-lg-block">

                                    </div>
                                </div>
                                <div class="value-card-glow"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Background Pattern -->
        <div class="section-pattern"></div>
    </section>

    <!-- Section 3: About Us Gallery -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <div class="section-badge mb-3 mx-auto">
                    <span class="badge-dot"></span>
                    <span class="badge-text">{{ $about['badge'] }}</span>
                </div>
                <h2 class="section-title mb-4">
                    {{ $about['title'] }}
                </h2>
                <p class="section-subtitle mx-auto">
                    {{ $about['subtitle'] }}
                </p>
            </div>

            <div class="about-gallery">
                <div class="row g-4 mb-5">
                    @foreach ($about['gallery'] as $index => $gallery)
                        <div class="col-lg-{{ $gallery['size'] === 'large' ? '8' : '4' }} col-md-6">
                            <div class="gallery-card gallery-card-{{ $gallery['size'] }}">
                                <div class="gallery-image">
                                    <img src="{{ asset($gallery['image']) }}" alt="{{ $gallery['title'] }}"
                                        loading="lazy">
                                    <div class="gallery-overlay">
                                        <div class="gallery-content">
                                            <h3>{{ $gallery['title'] }}</h3>
                                            <p>{{ $gallery['description'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Section 4: Beliefs, Vision, Mission -->
    <section id="beliefs" class="beliefs-section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <div class="section-badge mb-3 mx-auto">
                    <span class="badge-dot"></span>
                    <span class="badge-text">{{ $beliefs['section_badge'] }}</span>
                </div>
                <h2 class="section-title mb-4">
                    {{ $beliefs['section_title'] }} <span
                        class="text-gradient">{{ $beliefs['section_title_highlight'] }}</span>
                </h2>
                <p class="section-subtitle mx-auto">
                    {{ $beliefs['section_subtitle'] }}
                </p>
            </div>

            <div class="beliefs-grid">
                <div class="row g-4 mb-4">
                    <!-- Our Beliefs -->
                    <div class="col-lg-6">
                        <div class="belief-card-modern">
                            <div class="belief-icon-box">
                                <i class="{{ $beliefs['our_beliefs']['icon'] }}"></i>
                            </div>
                            <div class="belief-content">
                                <h3 class="belief-title">{{ $beliefs['our_beliefs']['title'] }}</h3>
                                @foreach ($beliefs['our_beliefs']['content'] as $content)
                                    <p class="belief-text">{{ $content }}</p>
                                @endforeach
                            </div>
                            <div class="belief-decoration"></div>
                        </div>
                    </div>

                    <!-- Our Vision -->
                    <div class="col-lg-6">
                        <div class="belief-card-modern">
                            <div class="belief-icon-box">
                                <i class="{{ $beliefs['our_vision']['icon'] }}"></i>
                            </div>
                            <div class="belief-content">
                                <h3 class="belief-title">{{ $beliefs['our_vision']['title'] }}</h3>
                                <p class="belief-text">{{ $beliefs['our_vision']['content'] }}</p>
                            </div>
                            <div class="belief-decoration"></div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <!-- Our Mission -->
                    <div class="col-lg-6">
                        <div class="belief-card-modern belief-card-accent">
                            <div class="belief-icon-box">
                                <i class="{{ $beliefs['our_mission']['icon'] }}"></i>
                            </div>
                            <div class="belief-content">
                                <h3 class="belief-title">{{ $beliefs['our_mission']['title'] }}</h3>
                                <div class="mission-list">
                                    @foreach ($beliefs['our_mission']['items'] as $item)
                                        <div class="mission-item">
                                            <i class="bi bi-check-circle-fill"></i>
                                            <span>{{ $item }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="belief-decoration"></div>
                        </div>
                    </div>

                    <!-- Our Goals -->
                    <div class="col-lg-6">
                        <div class="belief-card-modern belief-card-accent">
                            <div class="belief-icon-box">
                                <i class="{{ $beliefs['our_goals']['icon'] }}"></i>
                            </div>
                            <div class="belief-content">
                                <h3 class="belief-title">{{ $beliefs['our_goals']['title'] }}</h3>
                                <div class="mission-list">
                                    @foreach ($beliefs['our_goals']['items'] as $item)
                                        <div class="mission-item">
                                            <i class="bi bi-check-circle-fill"></i>
                                            <span>{{ $item }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="belief-decoration"></div>
                        </div>
                    </div>
                </div>

                <!-- Philosophy & Motto -->
                <div class="row">
                    <div class="col-12">
                        <div class="philosophy-card">
                            <div class="philosophy-pattern"></div>
                            <div class="row align-items-center g-5">
                                <div class="col-lg-4 text-center">
                                    <div class="philosophy-icon">
                                        <i class="{{ $beliefs['philosophy']['icon'] }}"></i>
                                    </div>
                                    <h3 class="philosophy-title">{{ $beliefs['philosophy']['title'] }}</h3>
                                </div>
                                <div class="col-lg-8">
                                    <div class="philosophy-content">
                                        <blockquote class="philosophy-quote">
                                            <p class="quote-text">"{{ $beliefs['philosophy']['quote'] }}"</p>
                                        </blockquote>
                                        <p class="philosophy-description">
                                            {{ $beliefs['philosophy']['description'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: Background Story -->
    <section id="background" class="background-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="background-image-wrapper">
                        <div class="background-image-frame">
                            <img src="{{ asset($background['image']) }}" alt="Background Story" loading="lazy">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="background-content">
                        <div class="section-badge mb-3">
                            <span class="badge-dot"></span>
                            <span class="badge-text">{{ $background['badge'] }}</span>
                        </div>

                        <h2 class="section-title mb-4">
                            {{ $background['title'] }} <span
                                class="text-gradient">{{ $background['title_highlight'] }}</span>
                            {{ $background['title_suffix'] }}
                        </h2>

                        <div class="story-timeline">
                            @foreach ($background['timeline'] as $index => $story)
                                <div class="story-timeline-item">
                                    <div class="timeline-marker">
                                        <div class="timeline-dot"></div>
                                        @if ($index < count($background['timeline']) - 1)
                                            <div class="timeline-line"></div>
                                        @endif
                                    </div>
                                    <div class="timeline-content">
                                        <h4 class="timeline-title">{{ $story['title'] }}</h4>
                                        <p class="timeline-text">{{ $story['text'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <a href="#journey" class="btn-premium mt-4">
                            <span>See our journey</span>
                            <i class="bi bi-arrow-down-circle ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 6: Journey -->
    <section id="journey" class="journey-section">
        <div class="journey-background"></div>

        <div class="container">
            <div class="section-header text-center mb-5">
                <div class="section-badge mb-3 mx-auto section-badge-light">
                    <span class="badge-dot"></span>
                    <span class="badge-text">{{ $journeySection['badge'] }}</span>
                </div>
                <h2 class="section-title text-white mb-4">
                    {{ $journeySection['title'] }} <span
                        class="text-gradient-light">{{ $journeySection['title_highlight'] }}</span>
                </h2>
                <p class="section-subtitle text-white-70 mx-auto">
                    {{ $journeySection['subtitle'] }}
                </p>
            </div>

            <div id="journeyCarousel" class="journey-carousel">
                <div class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                    <div class="carousel-inner">
                        @foreach ($journeySection['items'] as $index => $journey)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <div class="journey-slide">
                                    <div class="row align-items-center g-4">
                                        <div class="col-lg-6">
                                            <div class="journey-image-wrapper">
                                                <div class="journey-image-bg"></div>
                                                <img src="{{ asset($journey['image']) }}" alt="{{ $journey['title'] }}"
                                                    class="journey-image" loading="lazy">
                                                <div class="journey-year-badge">{{ $journey['year'] }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="journey-content">
                                                <div class="journey-number">{{ sprintf('%02d', $index + 1) }}</div>
                                                <h3 class="journey-title">{{ $journey['title'] }}</h3>
                                                <p class="journey-description">{{ $journey['description'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="carousel-controls">
                        <button class="carousel-control-custom carousel-control-prev" type="button"
                            data-bs-target="#journeyCarousel .carousel" data-bs-slide="prev">
                            <i class="bi bi-arrow-left"></i>
                        </button>
                        <div class="carousel-indicators-custom">
                            @foreach ($journeySection['items'] as $index => $journey)
                                <button type="button" data-bs-target="#journeyCarousel .carousel"
                                    data-bs-slide-to="{{ $index }}"
                                    class="{{ $index === 0 ? 'active' : '' }}"></button>
                            @endforeach
                        </div>
                        <button class="carousel-control-custom carousel-control-next" type="button"
                            data-bs-target="#journeyCarousel .carousel" data-bs-slide="next">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('journey.index') }}" class="btn-premium-outline">
                    <span>View Entire Journey</span>
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Section 7: Active Donations -->
    <section id="active-donations" class="donations-section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <div class="section-badge mb-3 mx-auto">
                    <span class="badge-dot"></span>
                    <span class="badge-text">
                        Active Donation Program</span>
                </div>
                <h2 class="section-title mb-4">
                    Current <span class="text-gradient">donation program</span>
                </h2>
                <p class="section-subtitle mx-auto">
                    accomplishing our humanitarian mission. Every donation you make brings hope and change.
                </p>
            </div>

            <div class="donations-grid">
                <div class="row g-4">
                    @forelse ($donations as $donation)
                        <div class="col-lg-4 col-md-6">
                            <div class="donation-card-modern">
                                <div class="donation-card-image">
                                    <img src="{{ asset('storage/' . $donation->photo_1) }}" alt="{{ $donation->title }}"
                                        loading="lazy">
                                    <div class="donation-card-overlay">
                                        <div class="donation-card-badge">
                                            <i class="bi bi-clock"></i>
                                            {{ \Carbon\Carbon::parse($donation->start_date)->format('d M') }} -
                                            {{ \Carbon\Carbon::parse($donation->end_date)->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="donation-card-content">
                                    <h3 class="donation-card-title">{{ Str::limit($donation->title, 50) }}</h3>

                                    <div class="donation-card-description">
                                        {{ Str::limit($donation->content, 100) }}
                                    </div>

                                    @php
                                        $totalDonations = $donation->donations->sum('donate');
                                        $targetDonation = $donation->target;
                                        $progressPercentage = min(($totalDonations / $targetDonation) * 100, 100);
                                    @endphp

                                    <div class="donation-card-progress">
                                        <div class="progress-wrapper">
                                            <div class="progress-bar" style="width: {{ $progressPercentage }}%"></div>
                                        </div>
                                        <div class="progress-info">
                                            <span class="progress-raised">
                                                Collected: Rp {{ number_format($totalDonations, 0, ',', '.') }}
                                            </span>
                                            <span class="progress-target">
                                                Targets: Rp {{ number_format($targetDonation, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="donation-card-actions">
                                        <a href="{{ route('donation.show', $donation->id) }}" class="btn-donation-cta" style="color:white">
                                            Donate now
                                            <i class="bi bi-heart-fill"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="no-donations-placeholder">
                                <div class="placeholder-icon">
                                    <i class="bi bi-heart-pulse"></i>
                                </div>
                                <h4>There is no active donation program yet</h4>
                                <p>Keep an eye on our page for the latest donation programs.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('donation.index') }}" class="btn-premium-outline">
                    <span style="color: #00b8a9">View all donation programs</span>
                    <i class="bi bi-arrow-right ms-2" style="color: #00b8a9"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Section 8: Active Volunteers -->
    <section id="active-volunteers" class="volunteer-section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <div class="section-badge mb-3 mx-auto">
                    <span class="badge-dot"></span>
                    <span class="badge-text">Active Volunteer Program</span>
                </div>
                <h2 class="section-title mb-4">
                    Join Our <span class="text-gradient">Volunteer</span> Team
                </h2>
                <p class="section-subtitle mx-auto">
                    Be part of positive change. Your contribution as a volunteer will make a real impact on communities in
                    need.
                </p>
            </div>

            <div class="volunteer-grid">
                <div class="row g-4">
                    @forelse ($volunteers as $volunteer)
                        <div class="col-lg-4 col-md-6">
                            <div class="volunteer-card-modern">
                                <div class="volunteer-card-image">
                                    <img src="{{ asset('storage/' . $volunteer->photo_1) }}"
                                        alt="{{ $volunteer->title }}" loading="lazy">
                                    <div class="volunteer-card-overlay">
                                        <div class="volunteer-card-badge">
                                            <i class="bi bi-calendar3"></i>
                                            {{ \Carbon\Carbon::parse($volunteer->date)->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="volunteer-card-content">
                                    <h3 class="volunteer-card-title">{{ Str::limit($volunteer->title, 50) }}</h3>

                                    <div class="volunteer-card-description">
                                        {{ Str::limit($volunteer->content, 100) }}
                                    </div>

                                    @php
                                        $totalParticipants = $volunteer->participants->count();
                                        $acceptedParticipants = $volunteer->participants
                                            ->where('status', 'accepted')
                                            ->count();
                                        $pendingParticipants = $volunteer->participants
                                            ->where('status', 'pending')
                                            ->count();
                                    @endphp

                                    <div class="volunteer-card-stats">
                                        <div class="stat-item">
                                            <div class="stat-icon">
                                                <i class="bi bi-people-fill"></i>
                                            </div>
                                            <div class="stat-content">
                                                <div class="stat-number">{{ $totalParticipants }}</div>
                                                <div class="stat-label">Total Pendaftar</div>
                                            </div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-icon">
                                                <i class="bi bi-check-circle-fill"></i>
                                            </div>
                                            <div class="stat-content">
                                                <div class="stat-number">{{ $acceptedParticipants }}</div>
                                                <div class="stat-label">Diterima</div>
                                            </div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-icon">
                                                <i class="bi bi-clock-fill"></i>
                                            </div>
                                            <div class="stat-content">
                                                <div class="stat-number">{{ $pendingParticipants }}</div>
                                                <div class="stat-label">Pending</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="volunteer-requirements-preview">
                                        <h6 class="requirements-title">Persyaratan Utama:</h6>
                                        <ul class="requirements-list">
                                            @if ($volunteer->specification_1)
                                                <li><i class="bi bi-check2"></i>
                                                    {{ Str::limit($volunteer->specification_1, 40) }}</li>
                                            @endif
                                            @if ($volunteer->specification_2)
                                                <li><i class="bi bi-check2"></i>
                                                    {{ Str::limit($volunteer->specification_2, 40) }}</li>
                                            @endif
                                            @if ($volunteer->specification_3)
                                                <li><i class="bi bi-check2"></i>
                                                    {{ Str::limit($volunteer->specification_3, 40) }}</li>
                                            @endif
                                        </ul>
                                        @php
                                            $totalSpecs = 0;
                                            for ($i = 1; $i <= 10; $i++) {
                                                if ($volunteer->{'specification_' . $i}) {
                                                    $totalSpecs++;
                                                }
                                            }
                                        @endphp
                                        @if ($totalSpecs > 3)
                                            <small class="text-muted">+{{ $totalSpecs - 3 }} persyaratan lainnya</small>
                                        @endif
                                    </div>

                                    <div class="volunteer-card-actions">
                                        <a href="{{ route('volunteers.show', $volunteer->id) }}"
                                            class="btn-donation-cta">
                                            Register Now
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="volunteer-card-footer">
                                    <div class="contact-info">
                                        <div class="contact-item">
                                            <i class="bi bi-person-fill"></i>
                                            <span>{{ $volunteer->pic_1 }}</span>
                                        </div>
                                        <div class="contact-item">
                                            <i class="bi bi-telephone-fill"></i>
                                            <span>{{ $volunteer->phonenumber_1 }}</span>
                                        </div>
                                    </div>
                                    <div class="volunteer-status">
                                        <span class="status-badge status-{{ $volunteer->status }}">
                                            <i class="bi bi-circle-fill"></i>
                                            {{ ucfirst($volunteer->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="no-volunteers-placeholder">
                                <div class="placeholder-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <h4>There is no active volunteer program yet.</h4>
                                <p>A new volunteer program is coming soon. Stay tuned for opportunities to join.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('volunteers.index') }}" class="btn-premium-outline">
                    <span style="color: #00b8a9">View All Volunteer Programs</span>
                    <i class="bi bi-arrow-right ms-2" style="color: #00b8a9"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section">
        <div class="cta-decoration cta-decoration-1"></div>
        <div class="cta-decoration cta-decoration-2"></div>
        <div class="cta-decoration cta-decoration-3"></div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="cta-content text-center">
                        <div class="cta-icon mb-4">
                            <i class="{{ $cta['icon'] }}"></i>
                        </div>
                        <h2 class="cta-title mb-4">
                            {{ $cta['title'] }} <span class="text-gradient-light">{{ $cta['title_highlight'] }}</span>
                        </h2>
                        <p class="cta-description mb-5">
                            {{ $cta['description'] }}
                        </p>


                        <div class="cta-buttons">
                            <a href="{{ route('donation.index') }}" class="btn-cta-primary">
                                <span>Donate now</span>
                                <i class="bi bi-heart-fill ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
