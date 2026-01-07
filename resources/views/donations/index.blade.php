@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="donation-hero-section">
        <div class="donation-hero-overlay"></div>
        <div class="container" style="margin-top: 70px">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <div class="section-badge mb-4 mx-auto section-badge-light" data-aos="fade-down">
                        <span class="badge-dot"></span>
                        <span class="badge-text">Program Donasi</span>
                    </div>
                    <h1 class="donation-hero-title text-white mb-4" data-aos="fade-up">
                        Mari Berbagi <span class="text-gradient-light">Kebaikan</span>
                    </h1>
                    <p class="donation-hero-subtitle text-white-70 mx-auto" data-aos="fade-up" data-aos-delay="100">
                        Setiap donasi Anda membawa harapan dan perubahan bagi mereka yang membutuhkan
                    </p>
                </div>
            </div>
        </div>
        <div class="hero-decoration hero-decoration-1"></div>
        <div class="hero-decoration hero-decoration-2"></div>
    </section>

    <!-- Timeline Section -->
    <section class="donation-timeline-section">
        <div class="container">
            <div class="timeline-wrapper">
                @forelse($donations as $index => $donation)
                    @php
                        $totalDonations = $donation->donations->sum('donate');
                        $targetDonation = $donation->target;
                        $progressPercentage = min(($totalDonations / $targetDonation) * 100, 100);
                    @endphp

                    <div class="timeline-item {{ $index % 2 == 0 ? 'timeline-left' : 'timeline-right' }}"
                         data-aos="fade-{{ $index % 2 == 0 ? 'right' : 'left' }}">

                        <div class="timeline-marker">
                            <div class="timeline-dot">
                                <i class="bi bi-heart-fill"></i>
                            </div>
                            @if($index < $donations->count() - 1)
                                <div class="timeline-line"></div>
                            @endif
                        </div>

                        <div class="timeline-card">


                            <div class="row g-0">
                                <div class="col-md-5">
                                    <div class="timeline-image">
                                        <img src="{{ asset('storage/' . $donation->photo_1) }}"
                                             alt="{{ $donation->title }}">
                                        <div class="timeline-image-overlay"></div>
                                        <div class="timeline-progress-badge">
                                            {{ number_format($progressPercentage, 0) }}%
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="timeline-content">
                                        <div class="timeline-date">
                                            <i class="bi bi-calendar-event me-2"></i>
                                            {{ \Carbon\Carbon::parse($donation->start_date)->format('d M Y') }}
                                            - {{ \Carbon\Carbon::parse($donation->end_date)->format('d M Y') }}
                                        </div>

                                        <div class="timeline-stats-inline">
                                            <div class="stat-inline-item">
                                                <i class="bi bi-people-fill me-1"></i>
                                                {{ $donation->donations->count() }} Donatur
                                            </div>
                                            <div class="stat-inline-item">
                                                <i class="bi bi-clock-fill me-1"></i>
                                                {{ \Carbon\Carbon::parse($donation->end_date)->diffForHumans() }}
                                            </div>
                                        </div>

                                        <h3 class="timeline-title">{{ $donation->title }}</h3>

                                        <p class="timeline-description">
                                            {{ Str::limit($donation->content, 150) }}
                                        </p>

                                        <!-- Progress Section -->
                                        <div class="timeline-progress-section">
                                            <div class="progress-info-top">
                                                <span class="progress-collected">
                                                    <strong>Rp {{ number_format($totalDonations, 0, ',', '.') }}</strong>
                                                    terkumpul
                                                </span>
                                                <span class="progress-target">
                                                    dari Rp {{ number_format($targetDonation, 0, ',', '.') }}
                                                </span>
                                            </div>
                                            <div class="progress-bar-timeline">
                                                <div class="progress-bar-fill-timeline" style="width: {{ $progressPercentage }}%"></div>
                                            </div>
                                        </div>

                                        <a href="{{ route('donation.show', $donation->id) }}"
                                           class="btn-timeline-donate">
                                            <span>Donasi Sekarang</span>
                                            <i class="bi bi-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5" data-aos="fade-up">
                        <div class="empty-state">
                            <i class="bi bi-heart-pulse display-1 text-muted mb-3"></i>
                            <h3 class="text-muted">Belum Ada Program Donasi</h3>
                            <p class="text-muted">Program donasi akan segera ditambahkan.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($donations->hasPages())
                <div class="pagination-wrapper mt-5" data-aos="fade-up">
                    <div class="d-flex justify-content-center">
                        {{ $donations->links() }}
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="donation-cta-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center" data-aos="zoom-in">
                    <div class="donation-cta-content">
                        <div class="cta-icon mb-4">
                            <i class="bi bi-heart-fill"></i>
                        </div>
                        <h2 class="mb-4">Jadilah Bagian dari <span class="text-white">Perubahan</span></h2>
                        <p class="mb-4">Setiap kontribusi Anda memiliki kekuatan untuk mengubah kehidupan</p>
                        <a href="{{ route('contact') }}" class="btn-premium-outline">
                            <span>Hubungi Kami</span>
                            <i class="bi bi-telephone-fill ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Hero Section */
        .donation-hero-section {
            position: relative;
            padding: 150px 0 100px;
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            overflow: hidden;
        }

        .donation-hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 50%, rgba(130, 233, 224, 0.3) 0%, transparent 50%);
        }

        .section-badge-light {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: #fff;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .badge-dot {
            width: 8px;
            height: 8px;
            background: #fff;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        .donation-hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
        }

        .text-gradient-light {
            background: linear-gradient(135deg, #fff 0%, rgba(255, 255, 255, 0.7) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .donation-hero-subtitle {
            font-size: 1.25rem;
            max-width: 700px;
        }

        .text-white-70 {
            color: rgba(255, 255, 255, 0.85);
        }

        .hero-decoration {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(40px);
        }

        .hero-decoration-1 {
            width: 400px;
            height: 400px;
            top: -100px;
            right: -100px;
        }

        .hero-decoration-2 {
            width: 300px;
            height: 300px;
            bottom: -50px;
            left: -50px;
        }

        /* Timeline Section */
        .donation-timeline-section {
            padding: 100px 0;
            background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
        }

        .timeline-wrapper {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 80px;
            display: flex;
            align-items: center;
        }

        .timeline-left {
            justify-content: flex-start;
        }

        .timeline-right {
            justify-content: flex-end;
        }

        .timeline-marker {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 2;
        }

        .timeline-dot {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            border: 4px solid #fff;
            box-shadow: 0 4px 20px rgba(130, 233, 224, 0.4);
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.2rem;
        }

        .timeline-line {
            width: 3px;
            height: 80px;
            background: linear-gradient(180deg, #82e9e0 0%, #00a89a 100%);
            margin-top: -4px;
        }

        .timeline-card {
            position: relative;
            width: 48%;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
        }

        .timeline-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(130, 233, 224, 0.2);
        }

        .timeline-status-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            color: #fff;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            z-index: 1;
            box-shadow: 0 4px 15px rgba(74, 222, 128, 0.3);
        }

        .timeline-image {
            position: relative;
            height: 300px;
            overflow: hidden;
        }

        .timeline-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .timeline-card:hover .timeline-image img {
            transform: scale(1.1);
        }

        .timeline-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.3) 100%);
        }

        .timeline-progress-badge {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            color: #00a89a;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 1.1rem;
            z-index: 1;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .timeline-content {
            padding: 30px;
        }

        .timeline-date {
            color: #00a89a;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .timeline-stats-inline {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .stat-inline-item {
            display: flex;
            align-items: center;
            color: #64748b;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .stat-inline-item i {
            color: #00a89a;
        }

        .timeline-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a202c;
            margin: 15px 0;
            line-height: 1.3;
        }

        .timeline-description {
            color: #64748b;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        /* Progress Section */
        .timeline-progress-section {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .progress-info-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .progress-collected {
            color: #1a202c;
            font-size: 0.9rem;
        }

        .progress-collected strong {
            color: #00a89a;
            font-weight: 700;
            font-size: 1rem;
        }

        .progress-target {
            color: #64748b;
            font-size: 0.85rem;
        }

        .progress-bar-timeline {
            height: 8px;
            background: #e2e8f0;
            border-radius: 50px;
            overflow: hidden;
        }

        .progress-bar-fill-timeline {
            height: 100%;
            background: linear-gradient(90deg, #82e9e0 0%, #00a89a 100%);
            border-radius: 50px;
            transition: width 1s ease;
        }

        .btn-timeline-donate {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            color: #fff;
            padding: 12px 28px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(130, 233, 224, 0.3);
        }

        .btn-timeline-donate:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(130, 233, 224, 0.4);
            color: #fff;
        }

        /* CTA Section */
        .donation-cta-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            position: relative;
            overflow: hidden;
        }

        .donation-cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .donation-cta-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .donation-cta-content {
            position: relative;
            z-index: 1;
            color: #fff;
        }

        .cta-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .donation-cta-content h2 {
            font-size: 2.5rem;
            font-weight: 700;
        }

        .donation-cta-content p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .btn-premium-outline {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: transparent;
            color: #fff;
            border: 2px solid #fff;
            padding: 15px 35px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-premium-outline:hover {
            background: #fff;
            color: #00a89a;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
        }

        /* Empty State */
        .empty-state {
            padding: 60px 20px;
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .donation-hero-title {
                font-size: 2rem;
            }

            .donation-hero-subtitle {
                font-size: 1rem;
            }

            .timeline-marker {
                left: 30px;
            }

            .timeline-card {
                width: calc(100% - 80px);
                margin-left: 80px;
            }

            .timeline-left,
            .timeline-right {
                justify-content: flex-start;
            }

            .timeline-image {
                height: 200px;
            }

            .donation-cta-content h2 {
                font-size: 1.8rem;
            }

            .timeline-stats-inline {
                flex-direction: column;
                gap: 8px;
            }

            .timeline-dot {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
        }
    </style>
@endsection