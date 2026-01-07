@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="volunteer-detail-hero">
        <div class="volunteer-detail-overlay"></div>
        <div class="container" style="margin-top: 70px">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" data-aos="fade-down">
                        <ol class="breadcrumb-custom">
                            <li><a href="{{ route('home') }}">Beranda</a></li>
                            <li><a href="{{ route('volunteers.index') }}">Program Volunteer</a></li>
                            <li class="active">{{ $volunteer->title }}</li>
                        </ol>
                    </nav>

                    <!-- Hero Content -->
                    <div class="detail-hero-content" data-aos="fade-up">
                        <div class="status-badge mb-3">
                            <i class="bi bi-calendar-check me-2"></i>
                            {{ \Carbon\Carbon::parse($volunteer->date)->format('d F Y') }}
                        </div>
                        <h1 class="detail-hero-title text-white mb-4">
                            {{ $volunteer->title }}
                        </h1>

                        <div class="hero-stats">
                            <div class="stat-box">
                                <div class="stat-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-value">{{ $totalParticipants }}</div>
                                    <div class="stat-label">Total Pendaftar</div>
                                </div>
                            </div>
                            <div class="stat-box">
                                <div class="stat-icon">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-value">{{ $acceptedParticipants }}</div>
                                    <div class="stat-label">Diterima</div>
                                </div>
                            </div>
                            <div class="stat-box">
                                <div class="stat-icon">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-value">{{ \Carbon\Carbon::parse($volunteer->date)->diffInDays(now()) }}</div>
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
    <section class="volunteer-detail-content">
        <div class="container">
            <div class="row g-5">
                <!-- Left Column: Content -->
                <div class="col-lg-8">
                    <!-- Featured Image -->
                    <div class="featured-image-wrapper" data-aos="fade-up">
                        <img src="{{ asset('storage/' . $volunteer->photo_1) }}" alt="{{ $volunteer->title }}" class="featured-image">
                    </div>

                    <!-- Content Description -->
                    <div class="content-description" data-aos="fade-up">
                        <h3 class="section-title-sm mb-4">Tentang Program Ini</h3>
                        <div class="description-text">
                            {!! nl2br(e($volunteer->content)) !!}
                        </div>
                    </div>

                    <!-- Specifications -->
                    @if(count($specifications) > 0)
                        <div class="specifications-section" data-aos="fade-up">
                            <h3 class="section-title-sm mb-4">
                                <i class="bi bi-list-check me-2"></i>
                                Persyaratan Volunteer
                            </h3>
                            <div class="specifications-list">
                                @foreach($specifications as $index => $spec)
                                    <div class="spec-item">
                                        <div class="spec-number">{{ $index + 1 }}</div>
                                        <div class="spec-text">{{ $spec }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Gallery -->
                    @if($volunteer->photo_2 || $volunteer->photo_3)
                        <div class="gallery-section" data-aos="fade-up">
                            <h3 class="section-title-sm mb-4">Galeri Foto</h3>
                            <div class="photo-gallery">
                                @if($volunteer->photo_2)
                                    <div class="gallery-item" onclick="openLightbox('{{ asset('storage/' . $volunteer->photo_2) }}')">
                                        <img src="{{ asset('storage/' . $volunteer->photo_2) }}" alt="Gallery 1">
                                        <div class="gallery-overlay">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                @endif
                                @if($volunteer->photo_3)
                                    <div class="gallery-item" onclick="openLightbox('{{ asset('storage/' . $volunteer->photo_3) }}')">
                                        <img src="{{ asset('storage/' . $volunteer->photo_3) }}" alt="Gallery 2">
                                        <div class="gallery-overlay">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Recent Participants -->
                    @if($recentParticipants->count() > 0)
                        <div class="participants-section" data-aos="fade-up">
                            <h3 class="section-title-sm mb-4">Pendaftar Terbaru</h3>
                            <div class="participants-list">
                                @foreach($recentParticipants as $participant)
                                    <div class="participant-item">
                                        <div class="participant-avatar">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                        <div class="participant-info">
                                            <div class="participant-name">{{ $participant->name }}</div>
                                            <div class="participant-education">{{ $participant->last_education }}</div>
                                        </div>
                                        <div class="participant-status">
                                            <span class="status-badge status-{{ $participant->status }}">
                                                {{ ucfirst($participant->status) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Column: Registration Form -->
                <div class="col-lg-4">
                    <div class="registration-form-sticky">
                        <!-- Registration Form Card -->
                        <div class="registration-form-card" data-aos="fade-left">
                            <h3 class="form-title">
                                <i class="bi bi-person-plus-fill me-2"></i>
                                Daftar Volunteer
                            </h3>

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-2"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('volunteers.participant.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="volunteer_id" value="{{ $volunteer->id }}">

                                <!-- Name -->
                                <div class="form-group">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div class="form-group">
                                    <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
                                    <input type="text" name="phonenumber" class="form-control @error('phonenumber') is-invalid @enderror"
                                           value="{{ old('phonenumber') }}" required>
                                    @error('phonenumber')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="form-group">
                                    <label class="form-label">Alamat <span class="text-danger">*</span></label>
                                    <textarea name="adress" class="form-control @error('adress') is-invalid @enderror"
                                              rows="3" required>{{ old('adress') }}</textarea>
                                    @error('adress')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Last Education -->
                                <div class="form-group">
                                    <label class="form-label">Pendidikan Terakhir <span class="text-danger">*</span></label>
                                    <select name="last_education" class="form-control @error('last_education') is-invalid @enderror" required>
                                        <option value="">Pilih Pendidikan</option>
                                        <option value="SD" {{ old('last_education') == 'SD' ? 'selected' : '' }}>SD</option>
                                        <option value="SMP" {{ old('last_education') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                        <option value="SMA/SMK" {{ old('last_education') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                        <option value="D3" {{ old('last_education') == 'D3' ? 'selected' : '' }}>D3</option>
                                        <option value="S1" {{ old('last_education') == 'S1' ? 'selected' : '' }}>S1</option>
                                        <option value="S2" {{ old('last_education') == 'S2' ? 'selected' : '' }}>S2</option>
                                        <option value="S3" {{ old('last_education') == 'S3' ? 'selected' : '' }}>S3</option>
                                    </select>
                                    @error('last_education')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Reason -->
                                <div class="form-group">
                                    <label class="form-label">Alasan Bergabung <span class="text-danger">*</span></label>
                                    <textarea name="reason" class="form-control @error('reason') is-invalid @enderror"
                                              rows="4" required placeholder="Ceritakan mengapa Anda ingin bergabung...">{{ old('reason') }}</textarea>
                                    @error('reason')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Experience -->
                                <div class="form-group">
                                    <label class="form-label">Pengalaman Volunteer (Opsional)</label>
                                    <textarea name="experience" class="form-control @error('experience') is-invalid @enderror"
                                              rows="3" placeholder="Ceritakan pengalaman volunteer Anda...">{{ old('experience') }}</textarea>
                                    @error('experience')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- File Uploads -->
                                <div class="form-group">
                                    <label class="form-label">CV/Resume (Opsional)</label>
                                    <input type="file" name="file_1" class="form-control @error('file_1') is-invalid @enderror"
                                           accept=".pdf,.jpg,.jpeg,.png">
                                    @error('file_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text">Format: PDF, JPG, PNG. Max 2MB</small>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Foto KTP (Opsional)</label>
                                    <input type="file" name="file_2" class="form-control @error('file_2') is-invalid @enderror"
                                           accept=".pdf,.jpg,.jpeg,.png">
                                    @error('file_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text">Format: PDF, JPG, PNG. Max 2MB</small>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Dokumen Pendukung (Opsional)</label>
                                    <input type="file" name="file_3" class="form-control @error('file_3') is-invalid @enderror"
                                           accept=".pdf,.jpg,.jpeg,.png">
                                    @error('file_3')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text">Format: PDF, JPG, PNG. Max 2MB</small>
                                </div>

                                <button type="submit" class="btn-submit-registration">
                                    <i class="bi bi-send-fill me-2"></i>
                                    Kirim Pendaftaran
                                </button>
                            </form>
                        </div>

                        <!-- Contact Person -->
                        <div class="contact-card" data-aos="fade-left" data-aos-delay="100">
                            <h4 class="contact-title">
                                <i class="bi bi-headset me-2"></i>
                                Butuh Bantuan?
                            </h4>
                            <p class="contact-desc">Hubungi kami untuk informasi lebih lanjut</p>
                            <div class="contact-list">
                                @if($volunteer->pic_1 && $volunteer->phonenumber_1)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $volunteer->phonenumber_1) }}"
                                       class="contact-btn" target="_blank">
                                        <i class="bi bi-whatsapp"></i>
                                        <div>
                                            <div class="contact-name">{{ $volunteer->pic_1 }}</div>
                                            <div class="contact-number">{{ $volunteer->phonenumber_1 }}</div>
                                        </div>
                                    </a>
                                @endif
                                @if($volunteer->pic_2 && $volunteer->phonenumber_2)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $volunteer->phonenumber_2) }}"
                                       class="contact-btn" target="_blank">
                                        <i class="bi bi-whatsapp"></i>
                                        <div>
                                            <div class="contact-name">{{ $volunteer->pic_2 }}</div>
                                            <div class="contact-number">{{ $volunteer->phonenumber_2 }}</div>
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Volunteers -->
    @if($relatedVolunteers->count() > 0)
        <section class="related-volunteers-section">
            <div class="container">
                <div class="section-header text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title">Program <span class="text-gradient">Lainnya</span></h2>
                </div>

                <div class="row g-4">
                    @foreach($relatedVolunteers as $related)
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <a href="{{ route('volunteers.show', $related->id) }}" class="related-card">
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
        /* Import styles from donation detail (sama persis structure nya, hanya ganti warna accent) */
        /* Hero Section */
        .volunteer-detail-hero {
            position: relative;
            padding: 150px 0 80px;
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            overflow: hidden;
        }

        .volunteer-detail-overlay {
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
        .volunteer-detail-content {
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

        /* Specifications Section */
        .specifications-section {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .specifications-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .spec-item {
            display: flex;
            align-items: start;
            gap: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 12px;
            transition: all 0.3s;
        }

        .spec-item:hover {
            background: #e2e8f0;
            transform: translateX(5px);
        }

        .spec-number {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            flex-shrink: 0;
        }

        .spec-text {
            flex: 1;
            color: #4a5568;
            line-height: 1.6;
            padding-top: 5px;
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

        /* Participants Section */
        .participants-section {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .participants-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .participant-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 12px;
            transition: all 0.3s;
        }

        .participant-item:hover {
            background: #e2e8f0;
        }

        .participant-avatar {
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

        .participant-info {
            flex: 1;
        }

        .participant-name {
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 3px;
        }

        .participant-education {
            color: #64748b;
            font-size: 0.85rem;
        }

        .participant-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-accepted {
            background: #d1fae5;
            color: #065f46;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Registration Form */
        .registration-form-sticky {
            position: sticky;
            top: 100px;
        }

        .registration-form-card {
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

        .btn-submit-registration {
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

        .btn-submit-registration:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(130, 233, 224, 0.4);
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
            color: #64748b;
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
            gap: 15px;
            padding: 15px 20px;
            background: linear-gradient(135deg, rgba(130, 233, 224, 0.1) 0%, rgba(0, 168, 154, 0.1) 100%);
            color: #1a202c;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .contact-btn:hover {
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(130, 233, 224, 0.3);
        }

        .contact-btn i {
            font-size: 1.5rem;
            color: #00a89a;
        }

        .contact-btn:hover i {
            color: #fff;
        }

        .contact-name {
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 3px;
        }

        .contact-number {
            font-size: 0.85rem;
            color: #64748b;
            font-family: monospace;
        }

        .contact-btn:hover .contact-number {
            color: rgba(255, 255, 255, 0.9);
        }

        /* Related Volunteers */
        .related-volunteers-section {
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

        .section-header {
            margin-bottom: 50px;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a202c;
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
            .registration-form-sticky {
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

            .photo-gallery {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }

            .specifications-list {
                gap: 10px;
            }

            .spec-item {
                padding: 12px;
            }
        }
    </style>

    <script>
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
    </script>
@endsection