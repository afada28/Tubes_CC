@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-body text-center p-5">
                    @if($subscription->status === 'success')
                        <div class="success-icon mb-4">
                            <i class="fas fa-check-circle fa-5x text-success"></i>
                        </div>
                        <h2 class="fw-bold mb-3">Pembayaran Berhasil!</h2>
                        <p class="text-muted mb-4">
                            Terima kasih atas dukungan Anda. Subscription Anda telah aktif.
                        </p>
                    @elseif($subscription->status === 'pending')
                        <div class="pending-icon mb-4">
                            <i class="fas fa-clock fa-5x text-warning"></i>
                        </div>
                        <h2 class="fw-bold mb-3">Pembayaran Pending</h2>
                        <p class="text-muted mb-4">
                            Pembayaran Anda sedang diproses. Silakan tunggu konfirmasi.
                        </p>
                    @else
                        <div class="error-icon mb-4">
                            <i class="fas fa-times-circle fa-5x text-danger"></i>
                        </div>
                        <h2 class="fw-bold mb-3">Pembayaran Gagal</h2>
                        <p class="text-muted mb-4">
                            Terjadi kesalahan saat memproses pembayaran Anda.
                        </p>
                    @endif

                    <div class="payment-details mb-4">
                        <div class="detail-row">
                            <span class="label">Order ID:</span>
                            <span class="value"><code>{{ $subscription->order_id }}</code></span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Amount:</span>
                            <span class="value fw-bold">Rp {{ number_format($subscription->amount, 0, ',', '.') }}</span>
                        </div>
                        @if($subscription->payment_type)
                        <div class="detail-row">
                            <span class="label">Payment Type:</span>
                            <span class="value">{{ ucfirst($subscription->payment_type) }}</span>
                        </div>
                        @endif
                        @if($subscription->expires_at)
                        <div class="detail-row">
                            <span class="label">Berlaku Hingga:</span>
                            <span class="value">{{ $subscription->expires_at->format('d F Y') }}</span>
                        </div>
                        @endif
                    </div>

                    <div class="d-grid gap-2">
                        @if($subscription->status === 'success')
                            <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-home me-2"></i> Kembali ke Home
                            </a>
                        @elseif($subscription->status === 'pending')
                            <button onclick="checkStatus()" class="btn btn-warning btn-lg">
                                <i class="fas fa-sync-alt me-2"></i> Cek Status Pembayaran
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                Kembali ke Home
                            </a>
                        @else
                            <a href="{{ route('subscription.index') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-redo me-2"></i> Coba Lagi
                            </a>
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                Kembali ke Home
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 16px;
    }

    .payment-details {
        background: #f8fafc;
        border-radius: 12px;
        padding: 20px;
        text-align: left;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-row .label {
        color: #718096;
        font-weight: 500;
    }

    .detail-row .value {
        color: #2d3748;
    }

    .btn {
        border-radius: 12px;
        font-weight: 600;
    }
</style>

<script>
    function checkStatus() {
        const orderId = '{{ $subscription->order_id }}';

        fetch(`{{ url('/payment/status') }}/${orderId}`)
            .then(response => response.json())
            .then(data => {
                if (data.transaction_status === 'settlement' || data.transaction_status === 'capture') {
                    alert('Pembayaran berhasil! Halaman akan di-refresh.');
                    location.reload();
                } else {
                    alert('Status: ' + data.transaction_status);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal mengecek status pembayaran');
            });
    }
</script>
@endsection
