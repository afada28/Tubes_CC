@extends('layouts.admin')

@section('page-title', 'Founder Journey Management')

@section('content')
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="mb-2 fw-bold">Founder Journey Management</h2>
                    <p class="text-muted mb-0">
                        <i class="fas fa-info-circle me-1"></i>
                        Create and manage founder journey milestones displayed on your website
                    </p>
                </div>
                <div>
                    <a href="{{ route('journey-founder.create') }}" class="btn btn-primary px-4 py-2 shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i>Add New Journey Item
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

    <!-- Main Content -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-history me-2 text-primary"></i>Founder Journey Items List
                </h5>
                <span class="badge bg-primary">{{ $journeyItems->total() }} Items</span>
            </div>
        </div>
        <div class="card-body p-0">
            @forelse($journeyItems as $item)
                <div class="journey-item-card border-bottom p-4 hover-effect">
                    <div class="row align-items-center">
                        <!-- Main Info -->
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 45px; height: 45px;">
                                        <span class="fw-bold text-primary">{{ $loop->iteration }}</span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 fw-semibold">{{ Str::limit($item->title, 40) }}</h6>
                                    <p class="text-muted mb-0 small">
                                        @if($item->date_start || $item->date_end)
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            @if($item->date_start && $item->date_end)
                                                {{ $item->date_start }} - {{ $item->date_end }}
                                            @elseif($item->date_start)
                                                From {{ $item->date_start }}
                                            @else
                                                Until {{ $item->date_end }}
                                            @endif
                                        @endif

                                        @if($item->location)
                                            <span class="ms-2">
                                                <i class="fas fa-map-marker-alt me-1"></i>
                                                {{ $item->location }}
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Photos -->
                        <div class="col-lg-6 mb-3 mb-lg-0">
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

                                @if($item->photo_4 || $item->photo_5 || $item->photo_6 || $item->photo_7 || $item->photo_8 || $item->photo_9 || $item->photo_10)
                                    <div class="rounded bg-light d-flex align-items-center justify-content-center shadow-sm"
                                         style="width: 50px; height: 50px;">
                                        <small class="fw-bold text-muted">+{{
                                            (($item->photo_4 ? 1 : 0) +
                                            ($item->photo_5 ? 1 : 0) +
                                            ($item->photo_6 ? 1 : 0) +
                                            ($item->photo_7 ? 1 : 0) +
                                            ($item->photo_8 ? 1 : 0) +
                                            ($item->photo_9 ? 1 : 0) +
                                            ($item->photo_10 ? 1 : 0))
                                        }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="col-lg-2 text-lg-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('journey-founder.show', $item->id) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   data-bs-toggle="tooltip"
                                   title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('journey-founder.edit', $item->id) }}"
                                   class="btn btn-sm btn-outline-warning"
                                   data-bs-toggle="tooltip"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('journey-founder.destroy', $item->id) }}"
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
                        </div>
                    </div>

                    <!-- Metadata -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="d-flex gap-3 text-muted small">
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
                        <i class="fas fa-history fa-4x text-muted opacity-50"></i>
                    </div>
                    <h4 class="text-muted mb-2">No Founder Journey Items Found</h4>
                    <p class="text-muted mb-4">Start by creating your first journey milestone</p>
                    <a href="{{ route('journey-founder.create') }}" class="btn btn-primary px-4">
                        <i class="fas fa-plus-circle me-2"></i>Create First Journey Item
                    </a>
                </div>
            @endforelse
        </div>

        @if($journeyItems->hasPages())
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing {{ $journeyItems->firstItem() }} to {{ $journeyItems->lastItem() }} of {{ $journeyItems->total() }} entries
                    </div>
                    <div>
                        {{ $journeyItems->links() }}
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
            const message = `Are you sure you want to delete journey item "${title}"?\n\nThis action cannot be undone.`;

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

.journey-item-card:last-child {
    border-bottom: none !important;
}
</style>