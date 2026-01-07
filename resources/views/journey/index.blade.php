@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="journey-hero-section">
        <div class="journey-hero-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <div class="section-badge mb-4 mx-auto section-badge-light" data-aos="fade-down">
                        <span class="badge-dot"></span>
                        <span class="badge-text">{{ $pageHeader['badge'] }}</span>
                    </div>
                    <h1 class="journey-hero-title text-white mb-4" data-aos="fade-up">
                        {{ $pageHeader['title'] }}
                        <span class="journey-hero-title">{{ $pageHeader['title_highlight'] }}</span>
                        {{ $pageHeader['title_suffix'] }}
                    </h1>
                    <p class="journey-hero-subtitle text-white-70 mx-auto" data-aos="fade-up" data-aos-delay="100">
                        {{ $pageHeader['subtitle'] }}
                    </p>
                </div>
            </div>
        </div>
        <div class="hero-decoration hero-decoration-1"></div>
        <div class="hero-decoration hero-decoration-2"></div>
    </section>

    <!-- Timeline Section -->
    <section class="journey-timeline-section">
        <div class="container">
            <div class="timeline-wrapper">
                @foreach($journeys as $index => $journey)
                    <div class="timeline-item {{ $index % 2 == 0 ? 'timeline-left' : 'timeline-right' }}"
                         data-aos="fade-{{ $index % 2 == 0 ? 'right' : 'left' }}">

                        <div class="timeline-marker">
                            <div class="timeline-dot"></div>
                            @if($index < count($journeys) - 1)
                                <div class="timeline-line"></div>
                            @endif
                        </div>

                        <div class="timeline-card">
                            {{-- <div class="timeline-year">
                                {{ $journey->date_start->format('Y') }}
                            </div> --}}

                            <div class="row g-0">
                                <div class="col-md-5">
                                    <div class="timeline-image">
                                        <img src="{{ asset('storage/' . $journey->photo_1) }}"
                                             alt="{{ $journey->title }}">
                                        <div class="timeline-image-overlay"></div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="timeline-content">
                                        <div class="timeline-date">
                                            <i class="bi bi-calendar-event me-2"></i>
                                            {{ $journey->date_start->format('d M Y') }}
                                            @if($journey->date_end)
                                                - {{ $journey->date_end->format('d M Y') }}
                                            @endif
                                        </div>

                                        @if($journey->location)
                                            <div class="timeline-location">
                                                <i class="bi bi-geo-alt me-2"></i>
                                                {{ $journey->location }}
                                            </div>
                                        @endif

                                        <h3 class="timeline-title">{{ $journey->title }}</h3>

                                        <p class="timeline-description">
                                            {{ Str::limit($journey->content, 150) }}
                                        </p>

                                        <a href="{{ route('journey.show', $journey->id) }}"
                                           class="btn-timeline-read">
                                            <span>Read More</span>
                                            <i class="bi bi-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($journeys->isEmpty())
                <div class="text-center py-5" data-aos="fade-up">
                    <div class="empty-state">
                        <i class="bi bi-calendar-x display-1 text-muted mb-3"></i>
                        <h3 class="text-muted">Belum Ada Perjalanan</h3>
                        <p class="text-muted">Timeline perjalanan akan segera ditambahkan.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="journey-cta-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center" data-aos="zoom-in">
                    <div class="journey-cta-content">
                        <h2 class="mb-4">Be Part of Our Journey</span></h2>
                        <p class="mb-4">Together we can make an even bigger difference</p>
                        <a href="{{ route('donation.index') }}" class="btn-premium">
                            <span>Donate Now</span>
                            <i class="bi bi-heart-fill ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Hero Section */
        .journey-hero-section {
            position: relative;
            padding: 150px 0 100px;
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            overflow: hidden;
        }

        .journey-hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 50%, rgba(130, 233, 224, 0.3) 0%, transparent 50%);
        }

        .journey-hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
        }

        .journey-hero-subtitle {
            font-size: 1.25rem;
            max-width: 700px;
        }

        /* Timeline Section */
        .journey-timeline-section {
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
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            border: 4px solid #fff;
            box-shadow: 0 4px 15px rgba(130, 233, 224, 0.3);
            position: relative;
            z-index: 2;
        }

        .timeline-line {
            width: 2px;
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

        .timeline-year {
            position: absolute;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            color: #fff;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.9rem;
            z-index: 1;
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

        .timeline-content {
            padding: 30px;
        }

        .timeline-date,
        .timeline-location {
            color: #00a89a;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .timeline-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a202c;
            margin: 15px 0;
        }

        .timeline-description {
            color: #64748b;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .btn-timeline-read {
            display: inline-flex;
            align-items: center;
            color: #00a89a;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-timeline-read:hover {
            color: #008c7f;
            transform: translateX(5px);
        }

        /* CTA Section */
        .journey-cta-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
        }

        .journey-cta-content {
            color: #fff;
        }

        .journey-cta-content h2 {
            font-size: 2.5rem;
            font-weight: 700;
        }

        .journey-cta-content p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        /* Empty State */
        .empty-state {
            padding: 60px 20px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .journey-hero-title {
                font-size: 2rem;
            }

            .journey-hero-subtitle {
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

            .journey-cta-content h2 {
                font-size: 1.8rem;
            }
        }
    </style>
@endsection