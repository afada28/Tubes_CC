@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary mb-3">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
            <h2 class="fw-bold mb-2">Detail User</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    @if($user->avatar)
                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                             class="rounded-circle mb-3" width="120" height="120">
                    @else
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width: 120px; height: 120px; font-size: 48px;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif

                    <h4 class="mb-2">{{ $user->name }}</h4>
                    <p class="text-muted mb-3">{{ $user->email }}</p>

                    @if($user->is_admin)
                        <span class="badge bg-danger mb-2">
                            <i class="fas fa-crown me-1"></i> Administrator
                        </span>
                    @else
                        <span class="badge bg-success mb-2">
                            <i class="fas fa-user me-1"></i> Regular User
                        </span>
                    @endif

                    @if($user->google_id)
                        <div class="mt-2">
                            <span class="badge bg-info">
                                <i class="fab fa-google me-1"></i> Linked with Google
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Informasi Akun</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="200">User ID:</th>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Google ID:</th>
                            <td>{{ $user->google_id ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Status Subscription:</th>
                            <td>
                                @if($user->is_subscribed)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        @if($user->subscribed_at)
                        <tr>
                            <th>Mulai Subscription:</th>
                            <td>{{ $user->subscribed_at->format('d F Y, H:i') }}</td>
                        </tr>
                        @endif
                        @if($user->subscription_ends_at)
                        <tr>
                            <th>Berakhir Subscription:</th>
                            <td>{{ $user->subscription_ends_at->format('d F Y, H:i') }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Terdaftar:</th>
                            <td>{{ $user->created_at->format('d F Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Terakhir Update:</th>
                            <td>{{ $user->updated_at->format('d F Y, H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Riwayat Subscription</h5>
                </div>
                <div class="card-body">
                    @if($user->subscriptions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Payment Type</th>
                                        <th>Tanggal</th>
                                        <th>Berakhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->subscriptions as $subscription)
                                        <tr>
                                            <td><code>{{ $subscription->order_id }}</code></td>
                                            <td>Rp {{ number_format($subscription->amount, 0, ',', '.') }}</td>
                                            <td>
                                                @if($subscription->status === 'success')
                                                    <span class="badge bg-success">Success</span>
                                                @elseif($subscription->status === 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @else
                                                    <span class="badge bg-danger">Failed</span>
                                                @endif
                                            </td>
                                            <td>{{ $subscription->payment_type ?? '-' }}</td>
                                            <td>{{ $subscription->created_at->format('d M Y') }}</td>
                                            <td>
                                                @if($subscription->expires_at)
                                                    {{ $subscription->expires_at->format('d M Y') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada riwayat subscription</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 12px;
        border: none;
    }

    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
</style>
@endsection
