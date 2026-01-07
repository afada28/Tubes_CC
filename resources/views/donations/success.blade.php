@extends('layouts.app')

@section('content')
    <section class="success-section">
        <div class="success-overlay"></div>
        <div class="container" style="margin-top: 100px; min-height: 80vh; display: flex; align-items: center;">
            <div class="row justify-content-center w-100">
                <div class="col-lg-6">
                    <div class="success-card" data-aos="zoom-in">
                        <!-- Success Icon -->
                        <div class="success-icon-wrapper">
                            <div class="success-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="success-particles">
                                <div class="particle"></div>
                                <div class="particle"></div>
                                <div class="particle"></div>
                                <div class="particle"></div>
                            </div>
                        </div>

                        <!-- Success Message -->
                        <h1 class="success-title">Donasi Berhasil!</h1>
                        <p class="success-subtitle">
                            Terima kasih atas kebaikan Anda, <strong>{{ $donation->name }}</strong>
                        </p>

                        <!-- Donation Details -->
                        <div class="donation-summary">
                            <div class="summary-row">
                                <span class="summary-label">Nominal Donasi</span>
                                <span class="summary-value">{{ $donation->formatted_amount }}</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Program</span>
                                <span class="summary-value">{{ $donation->infoDonation->title }}</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Tanggal</span>
                                <span class="summary-value">{{ $donation->created_at->format('d F Y, H:i') }}</span>
                            </div>
                        </div>

                        <!-- Message -->
                        @if($donation->message)
                            <div class="donation-message">
                                <i class="bi bi-quote"></i>
                                <p>{{ $donation->message }}</p>
                            </div>
                        @endif

                        <!-- Info Box -->
                        <div class="info-box">
                            <i class="bi bi-info-circle me-2"></i>
                            <p>Donasi Anda akan segera diverifikasi oleh tim kami. Kami akan menghubungi Anda melalui nomor telepon yang terdaftar jika diperlukan informasi tambahan.</p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <a href="{{ route('home') }}" class="btn-primary-custom">
                                <i class="bi bi-house-fill me-2"></i>
                                Kembali ke Beranda
                            </a>
                            <a href="{{ route('donate.index') }}" class="btn-secondary-custom">
                                <i class="bi bi-heart-fill me-2"></i>
                                Lihat Program Lain
                            </a>
                        </div>

                        <!-- Share Section -->
                        <div class="share-section">
                            <p class="share-text">Bagikan kebaikan Anda</p>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('donate.show', $donation->infoDonation->id)) }}"
                                   target="_blank"
                                   class="share-btn share-facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?text=Saya%20baru%20saja%20berdonasi%20untuk%20{{ urlencode($donation->infoDonation->title) }}&url={{ urlencode(route('donate.show', $donation->infoDonation->id)) }}"
                                   target="_blank"
                                   class="share-btn share-twitter">
                                    <i class="bi bi-twitter"></i>
                                </a>
                                <a href="https://wa.me/?text=Saya%20baru%20saja%20berdonasi%20untuk%20{{ urlencode($donation->infoDonation->title) }}%20di%20{{ urlencode(route('donate.show', $donation->infoDonation->id)) }}"
                                   target="_blank"
                                   class="share-btn share-whatsapp">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .success-section {
            position: relative;
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            overflow: hidden;
        }

        .success-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 50% 50%, rgba(130, 233, 224, 0.3) 0%, transparent 70%);
        }

        .success-card {
            background: #fff;
            border-radius: 30px;
            padding: 50px 40px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.15);
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .success-icon-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 30px;
        }

        .success-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: #fff;
            animation: scaleIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 0 10px 30px rgba(34, 197, 94, 0.3);
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .success-particles {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 150px;
            height: 150px;
        }

        .particle {
            position: absolute;
            width: 8px;
            height: 8px;
            background: #22c55e;
            border-radius: 50%;
            animation: particleFloat 2s infinite;
        }

        .particle:nth-child(1) {
            top: 0;
            left: 50%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            top: 50%;
            right: 0;
            animation-delay: 0.5s;
        }

        .particle:nth-child(3) {
            bottom: 0;
            left: 50%;
            animation-delay: 1s;
        }

        .particle:nth-child(4) {
            top: 50%;
            left: 0;
            animation-delay: 1.5s;
        }

        @keyframes particleFloat {
            0%, 100% {
                transform: translateY(0);
                opacity: 1;
            }
            50% {
                transform: translateY(-20px);
                opacity: 0.5;
            }
        }

        .success-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1a202c;
            margin-bottom: 15px;
        }

        .success-subtitle {
            font-size: 1.1rem;
            color: #64748b;
            margin-bottom: 40px;
        }

        .success-subtitle strong {
            color: #00a89a;
        }

        .donation-summary {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .summary-row:last-child {
            border-bottom: none;
        }

        .summary-label {
            color: #64748b;
            font-weight: 500;
        }

        .summary-value {
            color: #1a202c;
            font-weight: 700;
            text-align: right;
        }

        .donation-message {
            background: linear-gradient(135deg, rgba(130, 233, 224, 0.1) 0%, rgba(0, 168, 154, 0.1) 100%);
            border-left: 4px solid #00a89a;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: left;
            position: relative;
        }

        .donation-message i {
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 1.5rem;
            color: #00a89a;
            opacity: 0.3;
        }

        .donation-message p {
            margin: 0;
            padding-left: 25px;
            color: #4a5568;
            font-style: italic;
            line-height: 1.6;
        }

        .info-box {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 30px;
            text-align: left;
        }

        .info-box i {
            color: #ff9800;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .info-box p {
            margin: 0;
            color: #856404;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .btn-primary-custom, .btn-secondary-custom {
            flex: 1;
            min-width: 200px;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #82e9e0 0%, #00a89a 100%);
            color: #fff;
            box-shadow: 0 4px 15px rgba(130, 233, 224, 0.3);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(130, 233, 224, 0.4);
            color: #fff;
        }

        .btn-secondary-custom {
            background: #fff;
            color: #00a89a;
            border: 2px solid #00a89a;
        }

        .btn-secondary-custom:hover {
            background: #00a89a;
            color: #fff;
            transform: translateY(-2px);
        }

        .share-section {
            padding-top: 30px;
            border-top: 1px solid #e2e8f0;
        }

        .share-text {
            color: #64748b;
            margin-bottom: 15px;
            font-weight: 500;
        }

        .share-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .share-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: #fff;
            text-decoration: none;
            transition: all 0.3s;
        }

        .share-facebook {
            background: #1877f2;
        }

        .share-twitter {
            background: #1da1f2;
        }

        .share-whatsapp {
            background: #25d366;
        }

        .share-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .success-card {
                padding: 40px 25px;
            }

            .success-title {
                font-size: 2rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-primary-custom, .btn-secondary-custom {
                min-width: 100%;
            }
        }
    </style>
@endsection