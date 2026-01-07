@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="volunteer-hero-section">
        <div class="volunteer-hero-overlay"></div>
        <div class="container" style="margin-top: 70px">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <div class="section-badge mb-4 mx-auto section-badge-light" data-aos="fade-down">
                        <span class="badge-dot"></span>
                        <span class="badge-text">Program Volunteer</span>
                    </div>
                    <h1 class="volunteer-hero-title text-white mb-4" data-aos="fade-up">
                        Jadilah Bagian dari <span class="text-gradient-light">Perubahan</span>
                    </h1>
                    <p class="volunteer-hero-subtitle text-white-70 mx-auto" data-aos="fade-up" data-aos-delay="100">
                        Bergabunglah dengan kami untuk memberikan dampak positif bagi masyarakat yang membutuhkan
                    </p>
                </div>
            </div>
        </div>
        <div class="hero-decoration hero-decoration-1"></div>
        <div class="hero-decoration hero-decoration-2"></div>
    </section>

    <!-- Timeline Section -->
    <section class="volunteer-timeline-section">
        <div class="container">
            <div class="timeline-wrapper">
                @forelse($volunteers as $index => $volunteer)
                    @php
                        $totalParticipants = $volunteer->participants->count();
                        $acceptedParticipants = $volunteer->participants->where('status', 'accepted')->count();
                        $pendingParticipants = $volunteer->participants->where('status', 'pending')->count();
                    @endphp

                    <div class="timeline-item {{ $index % 2 == 0 ? 'timeline-left' : 'timeline-right' }}"
                         data-aos="fade-{{ $index % 2 == 0 ? 'right' : 'left' }}">

                        <div class="timeline-marker">
                            <div class="timeline-dot">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            @if($index < $volunteers->count() - 1)
                                <div class="timeline-line"></div>
                            @endif
                        </div>

                        <div class="timeline-card">
                            <div class="row g-0">
                                <div class="col-md-5">
                                    <div class="timeline-image">
                                        <img src="{{ asset('storage/' . $volunteer->photo_1) }}"
                                             alt="{{ $volunteer->title }}">
                                        <div class="timeline-image-overlay"></div>
                                        <div class="timeline-status-badge {{ $volunteer->status }}">
                                            <i class="bi bi-circle-fill me-1"></i>
                                            {{ ucfirst($volunteer->status) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="timeline-content">
                                        <div class="timeline-date">
                                            <i class="bi bi-calendar-event me-2"></i>
                                            {{ \Carbon\Carbon::parse($volunteer->date)->format('d F Y') }}
                                        </div>

                                        <div class="timeline-stats-inline">
                                            <div class="stat-inline-item">
                                                <i class="bi bi-people-fill me-1"></i>
                                                {{ $totalParticipants }} Pendaftar
                                            </div>
                                            <div class="stat-inline-item">
                                                <i class="bi bi-check-circle-fill me-1"></i>
                                                {{ $acceptedParticipants }} Diterima
                                            </div>
                                            <div class="stat-inline-item">
                                                <i class="bi bi-clock-fill me-1"></i>
                                                {{ \Carbon\Carbon::parse($volunteer->date)->diffForHumans() }}
                                            </div>
                                        </div>

                                        <h3 class="timeline-title">{{ $volunteer->title }}</h3>

                                        <p class="timeline-description">
                                            {{ Str::limit($volunteer->content, 150) }}
                                        </p>

                                        <!-- Requirements Preview -->
                                        <div class="requirements-preview">
                                            <h6 class="requirements-title">
                                                <i class="bi bi-list-check me-2"></i>
                                                Persyaratan Utama:
                                            </h6>
                                            <ul class="requirements-list-preview">
                                                @if($volunteer->specification_1)
                                                    <li>{{ Str::limit($volunteer->specification_1, 60) }}</li>
                                                @endif
                                                @if($volunteer->specification_2)
                                                    <li>{{ Str::limit($volunteer->specification_2, 60) }}</li>
                                                @endif
                                                @php
                                                    $totalSpecs = 0;
                                                    for($i = 1; $i <= 10; $i++) {
                                                        if($volunteer->{'specification_'.$i}) $totalSpecs++;
                                                    }
                                                @endphp
                                                @if($totalSpecs > 2)
                                                    <li class="text-muted">+{{ $totalSpecs - 2 }} persyaratan lainnya</li>
                                                @endif
                                            </ul>
                                        </div>

                                        <a href="{{ route('volunteers.show', $volunteer->id) }}"
                                           class="btn-timeline-volunteer">
                                            <span>Daftar Sekarang</span>
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
                            <i class="bi bi-people display-1 text-muted mb-3"></i>
                            <h3 class="text-muted">Belum Ada Program Volunteer</h3>
                            <p class="text-muted">Program volunteer akan segera ditambahkan.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($volunteers->hasPages())
                <div class="pagination-wrapper mt-5" data-aos="fade-up">
                    <div class="d-flex justify-content-center">
                        {{ $volunteers->links() }}
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="volunteer-cta-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center" data-aos="zoom-in">
                    <div class="volunteer-cta-content">
                        <div class="cta-icon mb-4">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h2 class="mb-4">Bergabung dengan <span class="text-white">Komunitas Kami</span></h2>
                        <p class="mb-4">Menjadi volunteer adalah cara terbaik untuk berkontribusi langsung kepada masyarakat</p>
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
        .volunteer-hero-section {
            position: relative;
            padding: 150px 0 100px;
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            overflow: hidden;
        }

        .volunteer-hero-overlay {
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
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .volunteer-hero-title {
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

        .volunteer-hero-subtitle {
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
        .volunteer-timeline-section {
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

        .timeline-left { justify-content: flex-start; }
        .timeline-right { justify-content: flex-end; }

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
            display: flex;
            align-items: center;
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

        /* Requirements Preview */
        .requirements-preview {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .requirements-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .requirements-list-preview {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .requirements-list-preview li {
            padding: 5px 0;
            color: #64748b;
            font-size: 0.85rem;
            display: flex;
            align-items: start;
        }

        .requirements-list-preview li::before {
            content: "✓";
            color: #00a89a;
            font-weight: bold;
            margin-right: 8px;
        }

        .btn-timeline-volunteer {
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

        .btn-timeline-volunteer:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(130, 233, 224, 0.4);
            color: #fff;
        }

        /* CTA Section */
        .volunteer-cta-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            position: relative;
            overflow: hidden;
        }

        .volunteer-cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .volunteer-cta-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .volunteer-cta-content {
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

        .volunteer-cta-content h2 {
            font-size: 2.5rem;
            font-weight: 700;
        }

        .volunteer-cta-content p {
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

        /* Responsive */
        @media (max-width: 768px) {
            .volunteer-hero-title {
                font-size: 2rem;
            }

            .volunteer-hero-subtitle {
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

            .volunteer-cta-content h2 {
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