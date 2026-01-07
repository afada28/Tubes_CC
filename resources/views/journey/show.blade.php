@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="journey-detail-hero">
        <div class="journey-detail-overlay"></div>
        <div class="container" style="margin-top: 70px">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" data-aos="fade-down">
                        <ol class="breadcrumb-custom">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('journey.index') }}">Founder Journey</a></li>
                            <li class="active">{{ $journey->title }}</li>
                        </ol>
                    </nav>

                    <!-- Hero Content -->
                    <div class="detail-hero-content text-center" data-aos="fade-up">
                        <div class="detail-year-badge mb-3">
                            {{ $journey->date_start->format('Y') }}
                        </div>
                        <h1 class="detail-hero-title text-white mb-4">
                            {{ $journey->title }}
                        </h1>
                        <div class="detail-meta">
                            <span class="meta-item">
                                <i class="bi bi-calendar-event me-2"></i>
                                {{ $journey->date_start->format('d F Y') }}
                                @if($journey->date_end)
                                    - {{ $journey->date_end->format('d F Y') }}
                                @endif
                            </span>
                            @if($journey->location)
                                <span class="meta-divider">•</span>
                                <span class="meta-item">
                                    <i class="bi bi-geo-alt me-2"></i>
                                    {{ $journey->location }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="journey-detail-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Featured Image -->
                    <div class="featured-image-wrapper" data-aos="fade-up">
                        <img src="{{ asset('storage/' . $journey->photo_1) }}"
                             alt="{{ $journey->title }}"
                             class="featured-image">
                    </div>

                    <!-- Content Text -->
                    <div class="content-text" data-aos="fade-up" data-aos-delay="100">
                        <div class="content-text-inner">
                            {!! nl2br(e($journey->content)) !!}
                        </div>
                    </div>

                    <!-- Photo Gallery -->
                    @if(count($photos) > 1)
                        <div class="photo-gallery-section" data-aos="fade-up">
                            <h3 class="gallery-title">Galeri Foto</h3>
                            <div class="photo-gallery-grid">
                                @foreach($photos as $index => $photo)
                                    @if($index > 0) {{-- Skip photo_1 karena sudah ditampilkan sebagai featured --}}
                                        <div class="gallery-item" data-aos="zoom-in" data-aos-delay="{{ $index * 50 }}">
                                            <img src="{{ asset('storage/' . $photo) }}"
                                                 alt="Gallery {{ $index }}"
                                                 onclick="openLightbox({{ $index }})">
                                            <div class="gallery-overlay">
                                                <i class="bi bi-zoom-in"></i>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Navigation -->
                    <div class="journey-navigation" data-aos="fade-up">
                        <div class="row g-4">
                            @if($previousJourney)
                                <div class="col-md-6">
                                    <a href="{{ route('journey.show', $previousJourney->id) }}"
                                       class="nav-card nav-prev">
                                        <div class="nav-direction">
                                            <i class="bi bi-arrow-left me-2"></i>
                                            previously
                                        </div>
                                        <div class="nav-title">{{ $previousJourney->title }}</div>
                                        <div class="nav-year">{{ $previousJourney->date_start->format('Y') }}</div>
                                    </a>
                                </div>
                            @else
                                <div class="col-md-6"></div>
                            @endif

                            @if($nextJourney)
                                <div class="col-md-6">
                                    <a href="{{ route('journey.show', $nextJourney->id) }}"
                                       class="nav-card nav-next">
                                        <div class="nav-direction">
                                            Next
                                            <i class="bi bi-arrow-right ms-2"></i>
                                        </div>
                                        <div class="nav-title">{{ $nextJourney->title }}</div>
                                        <div class="nav-year">{{ $nextJourney->date_start->format('Y') }}</div>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Journeys -->
    @if($relatedJourneys->count() > 0)
        <section class="related-journeys-section">
            <div class="container">
                <div class="section-header text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title">Others <span class="text-gradient">Journey</span></h2>
                </div>

                <div class="row g-4">
                    @foreach($relatedJourneys as $related)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <a href="{{ route('journey.show', $related->id) }}" class="related-card">
                                <div class="related-image">
                                    <img src="{{ asset('storage/' . $related->photo_1) }}"
                                         alt="{{ $related->title }}">
                                    <div class="related-year">{{ $related->date_start->format('Y') }}</div>
                                </div>
                                <div class="related-content">
                                    <h4 class="related-title">{{ $related->title }}</h4>
                                    <p class="related-description">
                                        {{ Str::limit($related->content, 100) }}
                                    </p>
                                    <span class="related-link">
                                        Baca Selengkapnya
                                        <i class="bi bi-arrow-right ms-2"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Lightbox -->
    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <span class="lightbox-close">&times;</span>
        <img id="lightbox-img" src="" alt="Lightbox Image">
        <button class="lightbox-nav lightbox-prev" onclick="event.stopPropagation(); changeLightboxImage(-1)">
            <i class="bi bi-chevron-left"></i>
        </button>
        <button class="lightbox-nav lightbox-next" onclick="event.stopPropagation(); changeLightboxImage(1)">
            <i class="bi bi-chevron-right"></i>
        </button>
    </div>

    <style>
        /* Hero Section */
        .journey-detail-hero {
            position: relative;
            padding: 150px 0 100px;
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            overflow: hidden;
        }

        .journey-detail-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 70% 30%, rgba(130, 233, 224, 0.3) 0%, transparent 70%);
        }

        .breadcrumb-custom {
            display: flex;
            list-style: none;
            padding: 0;
            margin-bottom: 30px;
            gap: 10px;
        }

        .breadcrumb-custom li {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        .breadcrumb-custom li a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumb-custom li a:hover {
            color: #fff;
        }

        .breadcrumb-custom li:not(:last-child)::after {
            content: "/";
            margin-left: 10px;
            color: rgba(255, 255, 255, 0.5);
        }

        .detail-year-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: #fff;
            padding: 8px 24px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .detail-hero-title {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.2;
        }

        .detail-meta {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
        }

        .meta-divider {
            opacity: 0.5;
        }

        /* Content Section */
        .journey-detail-content {
            padding: 80px 0;
            background: #fff;
        }

        .featured-image-wrapper {
            margin-bottom: 60px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }

        .featured-image {
            width: 100%;
            height: auto;
            display: block;
        }

        .content-text {
            margin-bottom: 60px;
        }

        .content-text-inner {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #4a5568;
        }

        /* Photo Gallery */
        .photo-gallery-section {
            margin-bottom: 60px;
        }

        .gallery-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 30px;
            text-align: center;
        }

        .photo-gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .gallery-item {
            position: relative;
            aspect-ratio: 1;
            border-radius: 15px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .gallery-item:hover {
            transform: scale(1.05);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 168, 154, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-overlay i {
            color: #fff;
            font-size: 2rem;
        }

        /* Navigation */
        .journey-navigation {
            margin-bottom: 60px;
        }

        .nav-card {
            display: block;
            padding: 30px;
            background: #f8f9fa;
            border-radius: 15px;
            text-decoration: none;
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .nav-card:hover {
            background: #fff;
            border-color: #00a89a;
            box-shadow: 0 10px 30px rgba(130, 233, 224, 0.1);
            transform: translateY(-5px);
        }

        .nav-prev {
            text-align: left;
        }

        .nav-next {
            text-align: right;
        }

        .nav-direction {
            color: #00a89a;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .nav-title {
            color: #1a202c;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .nav-year {
            color: #64748b;
            font-size: 0.9rem;
        }

        /* Related Journeys */
        .related-journeys-section {
            padding: 80px 0;
            background: linear-gradient(180deg, #f8f9fa 0%, #fff 100%);
        }

        .related-card {
            display: block;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            transition: all 0.4s;
        }

        .related-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(130, 233, 224, 0.2);
        }

        .related-image {
            position: relative;
            height: 250px;
            overflow: hidden;
        }

        .related-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s;
        }

        .related-card:hover .related-image img {
            transform: scale(1.1);
        }

        .related-year {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            color: #fff;
            padding: 6px 16px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .related-content {
            padding: 25px;
        }

        .related-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 15px;
        }

        .related-description {
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .related-link {
            color: #00a89a;
            font-weight: 600;
            font-size: 0.95rem;
        }

        /* Lightbox */
        .lightbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .lightbox.active {
            display: flex;
        }

        .lightbox-close {
            position: absolute;
            top: 30px;
            right: 40px;
            color: #fff;
            font-size: 3rem;
            cursor: pointer;
            transition: color 0.3s;
        }

        .lightbox-close:hover {
            color: #82e9e0;
        }

        #lightbox-img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
        }

        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: none;
            color: #fff;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .lightbox-nav:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .lightbox-prev {
            left: 30px;
        }

        .lightbox-next {
            right: 30px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .detail-hero-title {
                font-size: 2rem;
            }

            .detail-meta {
                flex-direction: column;
                gap: 10px;
            }

            .photo-gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }
    </style>

    <script>
        let currentLightboxIndex = 0;
        const photos = @json($photos);

        function openLightbox(index) {
            currentLightboxIndex = index;
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            lightboxImg.src = "{{ asset('storage') }}/" + photos[index];
            lightbox.classList.add('active');
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('active');
        }

        function changeLightboxImage(direction) {
            currentLightboxIndex += direction;
            if (currentLightboxIndex < 0) currentLightboxIndex = photos.length - 1;
            if (currentLightboxIndex >= photos.length) currentLightboxIndex = 0;

            const lightboxImg = document.getElementById('lightbox-img');
            lightboxImg.src = "{{ asset('storage') }}/" + photos[currentLightboxIndex];
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            const lightbox = document.getElementById('lightbox');
            if (lightbox.classList.contains('active')) {
                if (e.key === 'Escape') closeLightbox();
                if (e.key === 'ArrowLeft') changeLightboxImage(-1);
                if (e.key === 'ArrowRight') changeLightboxImage(1);
            }
        });
    </script>