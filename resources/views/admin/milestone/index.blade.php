@extends('layouts.admin')

@section('page-title', 'Milestone Management')

@section('content')
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="mb-2 fw-bold">Milestone Management</h2>
                    <p class="text-muted mb-0">
                        <i class="fas fa-info-circle me-1"></i>
                        Create and manage milestone content displayed on your website
                    </p>
                </div>
                {{-- <div>
                    <a href="{{ route('milestone.create') }}" class="btn btn-primary px-4 py-2 shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i>Add New Milestone
                    </a>
                </div> --}}
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
                    <i class="fas fa-list-alt me-2 text-primary"></i>Milestone Items
                </h5>
                <span class="badge bg-primary">{{ $milestoneItems->total() }} Total</span>
            </div>
        </div>
        <div class="card-body p-0">
            @forelse($milestoneItems as $item)
                <div class="milestone-item-card border-bottom p-4 hover-effect">
                    <div class="row g-3">
                        <!-- Image & Number -->
                        <div class="col-lg-2 col-md-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                    style="width: 40px; height: 40px;">
                                    <span class="fw-bold text-primary">{{ $loop->iteration }}</span>
                                </div>
                                <img src="{{ asset('storage/' . $item->photo) }}"
                                     alt="Milestone {{ $loop->iteration }}"
                                     class="rounded shadow-sm"
                                     style="width: 70px; height: 70px; object-fit: cover;">
                            </div>
                        </div>

                        <!-- Timeline Items -->
                        <div class="col-lg-8 col-md-9">
                            <div class="row g-3">
                                <!-- Timeline 1 -->
                                <div class="col-md-6">
                                    <div class="timeline-item">
                                        <h6 class="mb-1 fw-semibold text-primary">
                                            <i class="fas fa-flag-checkered me-1"></i>
                                            {{ Str::limit($item->timeline_title_1, 35) }}
                                        </h6>
                                        <p class="text-muted mb-0 small">
                                            {{ Str::limit($item->timeline_content_1, 60) }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Timeline 2 -->
                                <div class="col-md-6">
                                    <div class="timeline-item">
                                        <h6 class="mb-1 fw-semibold text-success">
                                            <i class="fas fa-flag-checkered me-1"></i>
                                            {{ Str::limit($item->timeline_title_2, 35) }}
                                        </h6>
                                        <p class="text-muted mb-0 small">
                                            {{ Str::limit($item->timeline_content_2, 60) }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Timeline 3 -->
                                <div class="col-md-6">
                                    <div class="timeline-item">
                                        <h6 class="mb-1 fw-semibold text-info">
                                            <i class="fas fa-flag-checkered me-1"></i>
                                            {{ Str::limit($item->timeline_title_3, 35) }}
                                        </h6>
                                        <p class="text-muted mb-0 small">
                                            {{ Str::limit($item->timeline_content_3, 60) }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Timeline 4 -->
                                <div class="col-md-6">
                                    <div class="timeline-item">
                                        <h6 class="mb-1 fw-semibold text-warning">
                                            <i class="fas fa-flag-checkered me-1"></i>
                                            {{ Str::limit($item->timeline_title_4, 35) }}
                                        </h6>
                                        <p class="text-muted mb-0 small">
                                            {{ Str::limit($item->timeline_content_4, 60) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="col-lg-2 col-md-12">
                            <div class="d-flex flex-lg-column flex-row gap-2 justify-content-lg-center">
                                <a href="{{ route('milestone.show', $item->id) }}"
                                   class="btn btn-sm btn-outline-primary flex-fill"
                                   data-bs-toggle="tooltip" title="View Details">
                                    <i class="fas fa-eye me-1"></i>View
                                </a>
                                <a href="{{ route('milestone.edit', $item->id) }}"
                                   class="btn btn-sm btn-outline-warning flex-fill"
                                   data-bs-toggle="tooltip" title="Edit">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <form action="{{ route('milestone.destroy', $item->id) }}"
                                      method="POST"
                                      class="d-inline flex-fill delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-sm btn-outline-danger w-100"
                                        data-bs-toggle="tooltip"
                                        title="Delete"
                                        data-title="{{ $item->timeline_title_1 }}">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Metadata -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="d-flex gap-3 text-muted small flex-wrap">
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
                        <i class="fas fa-folder-open fa-4x text-muted opacity-50"></i>
                    </div>
                    <h4 class="text-muted mb-2">No Milestone Items Found</h4>
                    <p class="text-muted mb-4">Start by creating your first milestone item</p>
                    <a href="{{ route('milestone.create') }}" class="btn btn-primary px-4">
                        <i class="fas fa-plus-circle me-2"></i>Create First Milestone
                    </a>
                </div>
            @endforelse
        </div>

        @if ($milestoneItems->hasPages())
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="text-muted small">
                        Showing {{ $milestoneItems->firstItem() }} to {{ $milestoneItems->lastItem() }} of
                        {{ $milestoneItems->total() }} entries
                    </div>
                    <div>
                        {{ $milestoneItems->links() }}
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
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        // Handle delete confirmation
        document.querySelectorAll('.delete-form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const title = this.querySelector('button[type="submit"]').dataset.title;
                const message = `Are you sure you want to delete milestone "${title}"?\n\nThis action cannot be undone.`;

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

    .milestone-item-card:last-child {
        border-bottom: none !important;
    }

    .timeline-item {
        padding: 0.5rem;
        border-left: 3px solid #e9ecef;
        padding-left: 1rem;
    }
</style>