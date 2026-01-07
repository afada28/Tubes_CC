@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="donation-detail-hero">
        <div class="donation-detail-overlay"></div>
        <div class="container" style="margin-top: 70px">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" data-aos="fade-down">
                        <ol class="breadcrumb-custom">
                            <li><a href="{{ route('home') }}">Beranda</a></li>
                            <li><a href="{{ route('donate.index') }}">Program Donasi</a></li>
                            <li class="active">{{ $infoDonation->title }}</li>
                        </ol>
                    </nav>

                    <!-- Hero Content -->
                    <div class="detail-hero-content" data-aos="fade-up">
                        <div class="status-badge mb-3">
                            <i class="bi bi-clock-fill me-2"></i>
                            Aktif hingga {{ \Carbon\Carbon::parse($infoDonation->end_date)->format('d F Y') }}
                        </div>
                        <h1 class="detail-hero-title text-white mb-4">
                            {{ $infoDonation->title }}
                        </h1>

                        <div class="hero-stats">
                            <div class="stat-box">
                                <div class="stat-icon">
                                    <i class="bi bi-cash-coin"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-value">Rp {{ number_format($totalDonations, 0, ',', '.') }}</div>
                                    <div class="stat-label">Terkumpul</div>
                                </div>
                            </div>
                            <div class="stat-box">
                                <div class="stat-icon">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-value">{{ $donorCount }}</div>
                                    <div class="stat-label">Donatur</div>
                                </div>
                            </div>
                            <div class="stat-box">
                                <div class="stat-icon">
                                    <i class="bi bi-calendar-check"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-value">
                                        {{ \Carbon\Carbon::parse($infoDonation->end_date)->diffInDays(now()) }}</div>
                                    <div class="stat-label">Hari Tersisa</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="donation-detail-content">
        <div class="container">
            <div class="row g-5">
                <!-- Left Column: Content -->
                <div class="col-lg-8">
                    <!-- Featured Image -->
                    <div class="featured-image-wrapper" data-aos="fade-up">
                        <img src="{{ asset('storage/' . $infoDonation->photo_1) }}" alt="{{ $infoDonation->title }}"
                            class="featured-image">
                    </div>

                    <!-- Progress Bar -->
                    <div class="progress-section" data-aos="fade-up">
                        <div class="progress-header">
                            <h3>Progress Donasi</h3>
                            <span class="progress-percentage-lg">{{ number_format($progressPercentage, 0) }}%</span>
                        </div>
                        <div class="progress-bar-large">
                            <div class="progress-bar-fill-large" style="width: {{ $progressPercentage }}%"></div>
                        </div>
                        <div class="progress-info-large">
                            <div>
                                <strong>Rp {{ number_format($totalDonations, 0, ',', '.') }}</strong>
                                <span>terkumpul</span>
                            </div>
                            <div class="text-end">
                                <strong>Rp {{ number_format($targetDonation, 0, ',', '.') }}</strong>
                                <span>target</span>
                            </div>
                        </div>
                    </div>

                    <!-- Content Description -->
                    <div class="content-description" data-aos="fade-up">
                        <h3 class="section-title-sm mb-4">Tentang Program Ini</h3>
                        <div class="description-text">
                            {!! nl2br(e($infoDonation->content)) !!}
                        </div>
                    </div>

                    <!-- Gallery -->
                    @if ($infoDonation->photo_2 || $infoDonation->photo_3)
                        <div class="gallery-section" data-aos="fade-up">
                            <h3 class="section-title-sm mb-4">Galeri Foto</h3>
                            <div class="photo-gallery">
                                @if ($infoDonation->photo_2)
                                    <div class="gallery-item"
                                        onclick="openLightbox('{{ asset('storage/' . $infoDonation->photo_2) }}')">
                                        <img src="{{ asset('storage/' . $infoDonation->photo_2) }}" alt="Gallery 1">
                                        <div class="gallery-overlay">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                @endif
                                @if ($infoDonation->photo_3)
                                    <div class="gallery-item"
                                        onclick="openLightbox('{{ asset('storage/' . $infoDonation->photo_3) }}')">
                                        <img src="{{ asset('storage/' . $infoDonation->photo_3) }}" alt="Gallery 2">
                                        <div class="gallery-overlay">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Recent Donors -->
                    @if ($recentDonors->count() > 0)
                        <div class="donors-section" data-aos="fade-up">
                            <h3 class="section-title-sm mb-4">Donatur Terbaru</h3>
                            <div class="donors-list">
                                @foreach ($recentDonors as $donor)
                                    <div class="donor-item">
                                        <div class="donor-avatar">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                        <div class="donor-info">
                                            <div class="donor-name">{{ $donor->name }}</div>
                                            <div class="donor-amount">Rp {{ number_format($donor->donate, 0, ',', '.') }}
                                            </div>
                                        </div>
                                        <div class="donor-time">
                                            {{ $donor->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Column: Donation Form -->
                <div class="col-lg-4">
                    <div class="donation-form-sticky">
                        <!-- Donation Form Card -->
                        <div class="donation-form-card" data-aos="fade-left">
                            <h3 class="form-title">
                                <i class="bi bi-heart-fill me-2"></i>
                                Berikan Donasi
                            </h3>

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-2"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('donation.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="info_donation_id" value="{{ $infoDonation->id }}">

                                <!-- Name -->
                                <div class="form-group">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Amount -->
                                <div class="form-group">
                                    <label class="form-label">Jumlah Donasi <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="donate"
                                            class="form-control @error('donate') is-invalid @enderror"
                                            value="{{ old('donate') }}"
                                            required>
                                        @error('donate')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Phone -->
                                <div class="form-group">
                                    <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
                                    <input type="text" name="phonenumber"
                                        class="form-control @error('phonenumber') is-invalid @enderror"
                                        value="{{ old('phonenumber') }}" required>
                                    @error('phonenumber')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="form-group">
                                    <label class="form-label">Alamat <span class="text-danger">*</span></label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3" required>{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Payment Proof -->
                                <div class="form-group">
                                    <label class="form-label">Bukti Transfer (Opsional)</label>
                                    <input type="file" name="photo"
                                        class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text">Format: JPG, PNG. Max 2MB</small>
                                </div>

                                <button type="submit" class="btn-submit-donation">
                                    <i class="bi bi-heart-fill me-2"></i>
                                    Kirim Donasi Sekarang
                                </button>
                            </form>
                        </div>

                        <!-- Payment Methods -->
                        <div class="payment-methods-card" data-aos="fade-left" data-aos-delay="100">
                            <h4 class="payment-title">Metode Pembayaran</h4>
                            <div class="payment-list">
                                @if ($infoDonation->payment_method_1)
                                    <div class="payment-item">
                                        <i class="bi bi-bank"></i>
                                        <div>
                                            <div class="payment-bank">{{ $infoDonation->payment_method_1 }}</div>
                                            <div class="payment-number">{{ $infoDonation->pic_payment_method_1 }}</div>
                                        </div>
                                    </div>
                                @endif
                                @if ($infoDonation->payment_method_2)
                                    <div class="payment-item">
                                        <i class="bi bi-bank"></i>
                                        <div>
                                            <div class="payment-bank">{{ $infoDonation->payment_method_2 }}</div>
                                            <div class="payment-number">{{ $infoDonation->pic_payment_method_2 }}</div>
                                        </div>
                                    </div>
                                @endif
                                @if ($infoDonation->payment_method_3)
                                    <div class="payment-item">
                                        <i class="bi bi-bank"></i>
                                        <div>
                                            <div class="payment-bank">{{ $infoDonation->payment_method_3 }}</div>
                                            <div class="payment-number">{{ $infoDonation->pic_payment_method_3 }}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Contact Person -->
                        <div class="contact-card" data-aos="fade-left" data-aos-delay="200">
                            <h4 class="contact-title">
                                <i class="bi bi-headset me-2"></i>
                                Butuh Bantuan?
                            </h4>
                            <p class="contact-desc">Hubungi kami untuk informasi lebih lanjut</p>
                            <div class="contact-list">
                                @if ($infoDonation->contact_person_1)
                                    <div class="contact-btn" target="_blank">
                                        <i class="bi bi-whatsapp"></i>
                                        {{ $infoDonation->contact_person_1 }}
                                    </div>
                                @endif
                                @if ($infoDonation->contact_person_2)
                                    <div href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $infoDonation->contact_person_2) }}"
                                        class="contact-btn" target="_blank">
                                        <i class="bi bi-whatsapp"></i>
                                        {{ $infoDonation->contact_person_2 }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Donations -->
    @if ($relatedDonations->count() > 0)
        <section class="related-donations-section">
            <div class="container">
                <div class="section-header text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title">Program <span class="text-gradient">Lainnya</span></h2>
                </div>

                <div class="row g-4">
                    @foreach ($relatedDonations as $related)
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <a href="{{ route('donate.show', $related->id) }}" class="related-card">
                                <div class="related-image">
                                    <img src="{{ asset('storage/' . $related->photo_1) }}" alt="{{ $related->title }}">
                                </div>
                                <div class="related-content">
                                    <h4 class="related-title">{{ Str::limit($related->title, 60) }}</h4>
                                    <p class="related-desc">{{ Str::limit($related->content, 100) }}</p>
                                    <span class="related-link">
                                        Lihat Detail <i class="bi bi-arrow-right ms-2"></i>
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
        <img id="lightbox-img" src="" alt="Lightbox">
    </div>

    <style>
        /* Hero Section */
        .donation-detail-hero {
            position: relative;
            padding: 150px 0 80px;
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            overflow: hidden;
        }

        .donation-detail-overlay {
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

        .breadcrumb-custom li:not(:last-child)::after {
            content: "/";
            margin-left: 10px;
            color: rgba(255, 255, 255, 0.5);
        }

        .status-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: #fff;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .detail-hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.2;
        }

        .hero-stats {
            display: flex;
            gap: 20px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .stat-box {
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 20px 30px;
            border-radius: 15px;
            flex: 1;
            min-width: 200px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #fff;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
        }

        .stat-label {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.8);
        }

        /* Main Content */
        .donation-detail-content {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .featured-image-wrapper {
            margin-bottom: 40px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }

        .featured-image {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Progress Section */
        .progress-section {
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .progress-header h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1a202c;
            margin: 0;
        }

        .progress-percentage-lg {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .progress-bar-large {
            height: 12px;
            background: #e2e8f0;
            border-radius: 50px;
            overflow: hidden;
            margin-bottom: 15px;
        }

        .progress-bar-fill-large {
            height: 100%;
            background: linear-gradient(90deg, #82e9e0 0%, #00a89a 100%);
            transition: width 1s ease;
        }

        .progress-info-large {
            display: flex;
            justify-content: space-between;
        }

        .progress-info-large strong {
            display: block;
            color: #00a89a;
            font-size: 1.1rem;
            margin-bottom: 3px;
        }

        .progress-info-large span {
            color: #64748b;
            font-size: 0.9rem;
        }

        /* Content Description */
        .content-description {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .section-title-sm {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a202c;
        }

        .description-text {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #4a5568;
        }

        /* Gallery */
        .gallery-section {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .photo-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
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

        /* Donors Section */
        .donors-section {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .donors-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .donor-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 12px;
            transition: all 0.3s;
        }

        .donor-item:hover {
            background: #e2e8f0;
        }

        .donor-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.2rem;
        }

        .donor-info {
            flex: 1;
        }

        .donor-name {
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 3px;
        }

        .donor-amount {
            color: #00a89a;
            font-weight: 700;
            font-size: 0.95rem;
        }

        .donor-time {
            color: #64748b;
            font-size: 0.85rem;
        }

        /* Donation Form */
        .donation-form-sticky {
            position: sticky;
            top: 100px;
        }

        .donation-form-card {
            background: #fff;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }

        .form-title i {
            color: #00a89a;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #00a89a;
            box-shadow: 0 0 0 3px rgba(130, 233, 224, 0.1);
        }

        .form-text {
            display: block;
            margin-top: 5px;
            color: #64748b;
            font-size: 0.85rem;
        }

        .input-group {
            display: flex;
        }

        .input-group-text {
            background: #f8f9fa;
            border: 2px solid #e2e8f0;
            border-right: none;
            border-radius: 10px 0 0 10px;
            padding: 12px 16px;
            font-weight: 600;
            color: #4a5568;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }

        .quick-amounts {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }

        .quick-amount-btn {
            padding: 10px;
            background: #f8f9fa;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-weight: 600;
            color: #4a5568;
            cursor: pointer;
            transition: all 0.3s;
        }

        .quick-amount-btn:hover {
            background: #00a89a;
            border-color: #00a89a;
            color: #fff;
        }

        .btn-submit-donation {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(130, 233, 224, 0.3);
        }

        .btn-submit-donation:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(130, 233, 224, 0.4);
        }

        /* Payment Methods Card */
        .payment-methods-card {
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
        }

        .payment-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 20px;
        }

        .payment-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .payment-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 12px;
        }

        .payment-item i {
            font-size: 1.5rem;
            color: #00a89a;
        }

        .payment-bank {
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 3px;
        }

        .payment-number {
            color: #64748b;
            font-size: 0.9rem;
            font-family: monospace;
        }

        /* Contact Card */
        .contact-card {
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .contact-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 10px;
        }

        .contact-desc {
            color: #1a202c;
            margin-bottom: 20px;
        }

        .contact-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .contact-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            background: #f7f9fa;
            backdrop-filter: blur(10px);
            color: #1a202c;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
        }


        .contact-btn i {
            font-size: 1.3rem;
        }

        /* Related Donations */
        .related-donations-section {
            padding: 80px 0;
            background: #fff;
        }

        .related-card {
            display: block;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            transition: all 0.4s;
            height: 100%;
        }

        .related-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(130, 233, 224, 0.2);
        }

        .related-image {
            height: 200px;
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

        .related-content {
            padding: 25px;
        }

        .related-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 10px;
        }

        .related-desc {
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .related-link {
            color: #00a89a;
            font-weight: 600;
        }

        .text-gradient {
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
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

        /* Responsive */
        @media (max-width: 992px) {
            .donation-form-sticky {
                position: static;
            }

            .hero-stats {
                flex-direction: column;
            }

            .stat-box {
                min-width: 100%;
            }
        }

        @media (max-width: 768px) {
            .detail-hero-title {
                font-size: 1.8rem;
            }

            .quick-amounts {
                grid-template-columns: repeat(2, 1fr);
            }

            .photo-gallery {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }
    </style>

    <script>
        // Set amount from quick buttons
        function setAmount(amount) {
            document.querySelector('input[name="amount"]').value = amount;
        }

        // Lightbox functions
        function openLightbox(imageSrc) {
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            lightboxImg.src = imageSrc;
            lightbox.classList.add('active');
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('active');
        }

        // Close lightbox on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });

        // Format currency input
        document.querySelector('input[name="amount"]')?.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            e.target.value = value;
        });
    </script>
@endsection
