@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold mb-2">User Management</h2>
            <p class="text-muted">Kelola daftar pengguna dan status subscription</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Avatar</th>
                            <th>Status</th>
                            <th>Subscription</th>
                            <th>Terdaftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($user->avatar)
                                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                                                 class="rounded-circle me-2" width="32" height="32">
                                        @else
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2"
                                                 style="width: 32px; height: 32px;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <span class="fw-medium">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->google_id)
                                        <span class="badge bg-info">
                                            <i class="fab fa-google me-1"></i> Google
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-envelope me-1"></i> Email
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->is_admin)
                                        <span class="badge bg-danger">
                                            <i class="fas fa-crown me-1"></i> Admin
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            <i class="fas fa-user me-1"></i> User
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->is_subscribed)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i> Active
                                        </span>
                                        @if($user->subscription_ends_at)
                                            <div class="small text-muted">
                                                s/d {{ $user->subscription_ends_at->format('d M Y') }}
                                            </div>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-times-circle me-1"></i> Inactive
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.users.show', $user->id) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Tidak ada user yang terdaftar</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 12px;
        border: none;
    }

    .table th {
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
</style>
@endsection
