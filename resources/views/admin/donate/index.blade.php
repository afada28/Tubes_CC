@extends('layouts.admin')

@section('page-title', 'Donation Management')

@section('content')
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="mb-2 fw-bold">Donation Management</h2>
                    <p class="text-muted mb-0">
                        <i class="fas fa-hand-holding-heart me-1"></i>
                        Create and manage donation information displayed on your website
                    </p>
                </div>
                <div>
                    <a href="{{ route('donate.create') }}" class="btn btn-primary px-4 py-2 shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i>Add New Donation Info
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2 fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row mb-4 g-3">
        <div class="col-md-6 col-lg-3">
            <div class="card bg-primary text-white border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="mb-0">Total Programs</h6>
                            <h3 class="mb-0">{{ $infoDonations->total() }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-heart fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card bg-success text-white border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="mb-0">Total Donatur</h6>
                            <h3 class="mb-0">{{ $totalDonors }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card bg-info text-white border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="mb-0">Total Terkumpul</h6>
                            <h3 class="mb-0 fs-6 fs-md-4">Rp {{ number_format($totalCollected, 0, ',', '.') }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-coins fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card bg-warning text-white border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="mb-0">Target Total</h6>
                            <h3 class="mb-0 fs-6 fs-md-4">Rp {{ number_format($totalTarget, 0, ',', '.') }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-bullseye fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-table me-2 text-primary"></i>Donation Information List
                </h5>
                <span class="badge bg-primary">{{ $infoDonations->total() }} Items</span>
            </div>
        </div>
        <div class="card-body p-0">
            @forelse($infoDonations as $item)
                <div class="donation-item-card border-bottom p-3 p-md-4 hover-effect">
                    <div class="row align-items-center g-3">
                        <!-- Main Info -->
                        <div class="col-12 col-lg-3">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 45px; height: 45px;">
                                        <i class="fas fa-donate text-primary"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 fw-semibold">{{ Str::limit($item->title, 40) }}</h6>
                                    <p class="text-muted mb-2 small">
                                        <i class="fas fa-align-left me-1"></i>
                                        {{ Str::limit($item->content, 60) }}
                                    </p>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <span class="badge bg-success">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $item->start_date->format('d M Y') }}
                                        </span>
                                        <span class="badge bg-danger">
                                            <i class="fas fa-calendar-times me-1"></i>
                                            {{ $item->end_date->format('d M Y') }}
                                        </span>
                                    </div>
                                    <div class="mt-2">
                                        <span class="badge {{ $item->status == 'active' ? 'bg-success' : ($item->status == 'completed' ? 'bg-secondary' : 'bg-warning') }}">
                                            <i class="fas fa-circle me-1"></i>{{ ucfirst($item->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Donation Statistics -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <small class="text-muted d-block mb-2 fw-semibold">Donation Statistics:</small>
                            <div class="d-flex flex-column gap-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Target:</small>
                                    <span class="badge bg-primary">
                                        Rp {{ number_format($item->target, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Terkumpul:</small>
                                    <span class="badge bg-success">
                                        Rp {{ number_format($item->total_donations, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Donatur:</small>
                                    <a href="{{ route('donate.participants', $item->id) }}" class="badge bg-info text-decoration-none">
                                        <i class="fas fa-users me-1"></i>{{ $item->donor_count }} Orang
                                    </a>
                                </div>
                                @php
                                    $progress = $item->target > 0 ? min(($item->total_donations / $item->target) * 100, 100) : 0;
                                @endphp
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-success"
                                         role="progressbar"
                                         style="width: {{ $progress }}%"
                                         aria-valuenow="{{ $progress }}"
                                         aria-valuemin="0"
                                         aria-valuemax="100">
                                    </div>
                                </div>
                                <small class="text-muted">{{ number_format($progress, 1) }}% tercapai</small>
                            </div>
                        </div>

                        <!-- Photos Preview -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <small class="text-muted d-block mb-2 fw-semibold">Photos:</small>
                            <div class="d-flex gap-2 flex-wrap">
                                @if ($item->photo_1)
                                    <img src="{{ asset('storage/' . $item->photo_1) }}"
                                         alt="Photo 1"
                                         class="rounded shadow-sm"
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                @endif
                                @if ($item->photo_2)
                                    <img src="{{ asset('storage/' . $item->photo_2) }}"
                                         alt="Photo 2"
                                         class="rounded shadow-sm"
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                @endif
                                @if ($item->photo_3)
                                    <img src="{{ asset('storage/' . $item->photo_3) }}"
                                         alt="Photo 3"
                                         class="rounded shadow-sm"
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                @endif
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="col-12 col-lg-3">
                            <div class="d-flex flex-column gap-2">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('donate.show', $item->id) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       data-bs-toggle="tooltip"
                                       title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('donate.edit', $item->id) }}"
                                       class="btn btn-sm btn-outline-warning"
                                       data-bs-toggle="tooltip"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('donate.destroy', $item->id) }}"
                                          method="POST"
                                          class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="tooltip"
                                            title="Delete"
                                            data-title="{{ $item->title }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                <a href="{{ route('donate.participants', $item->id) }}"
                                   class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-users me-1"></i>View Participants
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Metadata -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="d-flex gap-2 gap-md-3 text-muted small flex-wrap">
                                <span>
                                    <i class="fas fa-user me-1"></i>
                                    Contact: {{ $item->contact_person_1 }}
                                </span>
                                <span>
                                    <i class="fas fa-calendar-plus me-1"></i>
                                    Created {{ $item->created_at->diffForHumans() }}
                                </span>
                                <span>
                                    <i class="fas fa-sync me-1"></i>
                                    Updated {{ $item->updated_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-hand-holding-heart fa-4x text-muted opacity-50"></i>
                    </div>
                    <h4 class="text-muted mb-2">No Donation Information Found</h4>
                    <p class="text-muted mb-4">Start by creating your first donation information</p>
                    <a href="{{ route('donate.create') }}" class="btn btn-primary px-4">
                        <i class="fas fa-plus-circle me-2"></i>Create First Item
                    </a>
                </div>
            @endforelse
        </div>

        @if($infoDonations->hasPages())
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="text-muted small">
                        Showing {{ $infoDonations->firstItem() }} to {{ $infoDonations->lastItem() }} of {{ $infoDonations->total() }} entries
                    </div>
                    <div>
                        {{ $infoDonations->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // Handle delete confirmation
    document.querySelectorAll('.delete-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const title = this.querySelector('button[type="submit"]').dataset.title;
            const message = `Are you sure you want to delete donation program "${title}"?\n\nThis action cannot be undone.`;

            if (confirm(message)) {
                this.submit();
            }
        });
    });
</script>
@endpush

<style>
.hover-effect {
    transition: all 0.3s ease;
}

.hover-effect:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

.donation-item-card:last-child {
    border-bottom: none !important;
}

.card {
    border: none;
    border-radius: 12px;
}

.card-header {
    border-radius: 12px 12px 0 0 !important;
}

/* Responsive font sizes */
@media (max-width: 768px) {
    .fs-md-4 {
        font-size: 1.2rem !important;
    }
}

@media (min-width: 769px) {
    .fs-md-4 {
        font-size: 1.5rem !important;
    }
}
</style>