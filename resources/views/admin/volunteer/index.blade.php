@extends('layouts.admin')

@section('page-title', 'Volunteer Management')

@section('content')
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="mb-2 fw-bold">Volunteer Management</h2>
                    <p class="text-muted mb-0">
                        <i class="fas fa-users me-1"></i>
                        Create and manage volunteer programs and participants
                    </p>
                </div>
                <div>
                    <a href="{{ route('volunteer.create') }}" class="btn btn-primary px-4 py-2 shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i>Add New Volunteer Program
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
                            <h3 class="mb-0">{{ $totalVolunteers }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-hands-helping fa-2x"></i>
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
                            <h6 class="mb-0">Total Participants</h6>
                            <h3 class="mb-0">{{ $totalParticipants }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-user-friends fa-2x"></i>
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
                            <h6 class="mb-0">Pending Applications</h6>
                            <h3 class="mb-0">{{ $pendingParticipants }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-clock fa-2x"></i>
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
                            <h6 class="mb-0">Accepted Volunteers</h6>
                            <h3 class="mb-0">{{ $acceptedParticipants }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-check-circle fa-2x"></i>
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
                    <i class="fas fa-table me-2 text-primary"></i>Volunteer Programs List
                </h5>
                <span class="badge bg-primary">{{ $volunteers->total() }} Items</span>
            </div>
        </div>
        <div class="card-body p-0">
            @forelse($volunteers as $item)
                <div class="volunteer-item-card border-bottom p-3 p-md-4 hover-effect">
                    <div class="row align-items-center g-3">
                        <!-- Main Info -->
                        <div class="col-12 col-lg-3">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 45px; height: 45px;">
                                        <i class="fas fa-hands-helping text-primary"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 fw-semibold">{{ Str::limit($item->title, 40) }}</h6>
                                    <p class="text-muted mb-2 small">
                                        <i class="fas fa-align-left me-1"></i>
                                        {{ Str::limit($item->content, 60) }}
                                    </p>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <span class="badge bg-info">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                                        </span>
                                        <span class="badge {{ $item->status == 'active' ? 'bg-success' : ($item->status == 'completed' ? 'bg-secondary' : 'bg-warning') }}">
                                            <i class="fas fa-circle me-1"></i>{{ ucfirst($item->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Participant Statistics -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <small class="text-muted d-block mb-2 fw-semibold">Participant Statistics:</small>
                            <div class="d-flex flex-column gap-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Total:</small>
                                    <span class="badge bg-primary">
                                        {{ $item->participants->count() }} Orang
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Accepted:</small>
                                    <span class="badge bg-success">
                                        {{ $item->participants->where('status', 'accepted')->count() }} Orang
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Pending:</small>
                                    <a href="{{ route('volunteer.participants', $item->id) }}" class="badge bg-warning text-decoration-none">
                                        <i class="fas fa-clock me-1"></i>{{ $item->participants->where('status', 'pending')->count() }} Orang
                                    </a>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Rejected:</small>
                                    <span class="badge bg-danger">
                                        {{ $item->participants->where('status', 'rejected')->count() }} Orang
                                    </span>
                                </div>
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
                                    <a href="{{ route('volunteer.show', $item->id) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       data-bs-toggle="tooltip"
                                       title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('volunteer.edit', $item->id) }}"
                                       class="btn btn-sm btn-outline-warning"
                                       data-bs-toggle="tooltip"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('volunteer.destroy', $item->id) }}"
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
                                <a href="{{ route('volunteer.participants', $item->id) }}"
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
                                    PIC: {{ $item->pic_1 }}
                                </span>
                                <span>
                                    <i class="fas fa-phone me-1"></i>
                                    {{ $item->phonenumber_1 }}
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
                        <i class="fas fa-hands-helping fa-4x text-muted opacity-50"></i>
                    </div>
                    <h4 class="text-muted mb-2">No Volunteer Programs Found</h4>
                    <p class="text-muted mb-4">Start by creating your first volunteer program</p>
                    <a href="{{ route('volunteer.create') }}" class="btn btn-primary px-4">
                        <i class="fas fa-plus-circle me-2"></i>Create First Program
                    </a>
                </div>
            @endforelse
        </div>

        @if($volunteers->hasPages())
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="text-muted small">
                        Showing {{ $volunteers->firstItem() }} to {{ $volunteers->lastItem() }} of {{ $volunteers->total() }} entries
                    </div>
                    <div>
                        {{ $volunteers->links() }}
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
            const message = `Are you sure you want to delete volunteer program "${title}"?\n\nThis action will also delete all associated participants and cannot be undone.`;

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

.volunteer-item-card:last-child {
    border-bottom: none !important;
}

.card {
    border: none;
    border-radius: 12px;
}

.card-header {
    border-radius: 12px 12px 0 0 !important;
}
</style>