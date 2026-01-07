@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Pilih Paket Subscription</h2>
                <p class="text-muted">Dukung kami dengan berlangganan untuk program Bulan Berkah</p>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="pricing-card">
                        <div class="pricing-header">
                            <h3>Bulan Berkah Basic</h3>
                            <div class="price">
                                <span class="currency">Rp</span>
                                <span class="amount">50.000</span>
                                <span class="period">/bulan</span>
                            </div>
                        </div>
                        <div class="pricing-body">
                            <ul class="features-list">
                                <li><i class="fas fa-check"></i> Program Bagi Bagi Sembako</li>
                                <li><i class="fas fa-check"></i> Support prioritas</li>
                                <li><i class="fas fa-check"></i> Badge eksklusif</li>
                            </ul>
                            <button class="btn-subscribe" onclick="subscribe(50000, 1)">
                                Berlangganan Sekarang
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="pricing-card featured">
                        <div class="badge-popular">Popular</div>
                        <div class="pricing-header">
                            <h3>Bulan Berkah Premium</h3>
                            <div class="price">
                                <span class="currency">Rp</span>
                                <span class="amount">120.000</span>
                                <span class="period">/3 bulan</span>
                            </div>
                        </div>
                        <div class="pricing-body">
                            <ul class="features-list">
                                <li><i class="fas fa-check"></i> Program Bagi Bagi Sembako</li>
                                <li><i class="fas fa-check"></i> Program Peduli Healty</li>
                                <li><i class="fas fa-check"></i> Sertifikat digital</li>
                                <li><i class="fas fa-check"></i> Badge eksklusif</li>
                            </ul>
                            <button class="btn-subscribe" onclick="subscribe(120000, 3)">
                                Berlangganan Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6 mb-4">
                    <div class="pricing-card">
                        <div class="pricing-header">
                            <h3>Bulan Berkah Juragan</h3>
                            <div class="price">
                                <span class="currency">Rp</span>
                                <span class="amount">240.000</span>
                                <span class="period">/6 bulan</span>
                            </div>
                        </div>
                        <div class="pricing-body">
                            <ul class="features-list">
                                <li><i class="fas fa-check"></i> Program Bagi Bagi sembako</li>
                                <li><i class="fas fa-check"></i> Program Peduli Healty</li>
                                <li><i class="fas fa-check"></i> Program Peduli Yatim Piatu</li>
                                <li><i class="fas fa-check"></i> Bonus merchandise</li>
                                <li><i class="fas fa-check"></i> Sertifikat digital</li>
                                <li><i class="fas fa-check"></i> Badge eksklusif</li>
                            </ul>
                            <button class="btn-subscribe" onclick="subscribe(240000, 6)">
                                Berlangganan Sekarang
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="pricing-card">
                        <div class="pricing-header">
                            <h3>Bulan Berkah Sultan</h3>
                            <div class="price">
                                <span class="currency">Rp</span>
                                <span class="amount">480.000</span>
                                <span class="period">/tahun</span>
                            </div>
                        </div>
                        <div class="pricing-body">
                            <ul class="features-list">
                                <li><i class="fas fa-check"></i> Program Bagi Bagi Sembako</li>
                                <li><i class="fas fa-check"></i> Program Peduli Healty</li>
                                <li><i class="fas fa-check"></i> Program Peduli Yatim Piatu</li>
                                <li><i class="fas fa-check"></i> Bonus merchandise</li>
                                <li><i class="fas fa-check"></i> Akses Event Exclusive</li>
                                <li><i class="fas fa-check"></i> Sertifikat digital</li>
                                <li><i class="fas fa-check"></i> Badge eksklusif</li>
                            </ul>
                            <button class="btn-subscribe" onclick="subscribe(480000, 12)">
                                Berlangganan Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            @if(auth()->user()->is_subscribed)
                <div class="alert alert-info mt-4">
                    <i class="fas fa-info-circle me-2"></i>
                    Anda sudah memiliki subscription aktif hingga
                    <strong>{{ auth()->user()->subscription_ends_at->format('d F Y') }}</strong>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .pricing-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .pricing-card.featured {
        border: 3px solid #95ddda;
        transform: scale(1.02);
    }

    .pricing-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
    }

    .badge-popular {
        position: absolute;
        top: 20px;
        right: -35px;
        background: linear-gradient(135deg, #95ddda, #7ec5c2);
        color: white;
        padding: 5px 40px;
        transform: rotate(45deg);
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .pricing-header {
        padding: 30px;
        text-align: center;
        background: linear-gradient(135deg, #d9fffb, #ebf2d5);
    }

    .pricing-header h3 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #2d3748;
    }

    .price {
        display: flex;
        align-items: baseline;
        justify-content: center;
        gap: 5px;
    }

    .currency {
        font-size: 20px;
        font-weight: 600;
        color: #4a5568;
    }

    .amount {
        font-size: 48px;
        font-weight: 700;
        color: #2d3748;
    }

    .period {
        font-size: 16px;
        color: #718096;
    }

    .pricing-body {
        padding: 30px;
    }

    .features-list {
        list-style: none;
        padding: 0;
        margin-bottom: 30px;
    }

    .features-list li {
        padding: 12px 0;
        color: #4a5568;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .features-list i {
        color: #95ddda;
        font-size: 18px;
    }

    .btn-subscribe {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #95ddda, #7ec5c2);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-subscribe:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(149, 221, 218, 0.4);
    }
</style>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    function subscribe(amount, duration) {
        fetch('{{ route("payment.create") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                amount: amount,
                duration: duration
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.snap_token) {
                snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        window.location.href = '{{ route("payment.finish") }}?order_id=' + data.order_id;
                    },
                    onPending: function(result) {
                        window.location.href = '{{ route("payment.finish") }}?order_id=' + data.order_id;
                    },
                    onError: function(result) {
                        alert('Payment failed!');
                    },
                    onClose: function() {
                        console.log('Payment popup closed');
                    }
                });
            } else {
                alert('Gagal membuat transaksi: ' + (data.error || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat membuat transaksi');
        });
    }
</script>
@endsection
