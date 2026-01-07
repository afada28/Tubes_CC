@extends('layouts.admin')

@section('page-title', 'Carousel Management')

@section('content')
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="mb-2 fw-bold">Carousel Management</h2>
                    <p class="text-muted mb-0">
                        <i class="fas fa-images me-1"></i>
                        Create and manage carousel items displayed on your website
                    </p>
                </div>
                {{-- <div>
                    <a href="{{ route('carousel.create') }}" class="btn btn-primary px-4 py-2 shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i>Add New Item
                    </a>
                </div> --}}
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2 fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Stats Cards -->
    {{-- <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-list text-primary fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Items</h6>
                            <h3 class="mb-0 fw-bold">{{ $carouselItems->total() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-images text-success fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">With Images</h6>
                            <h3 class="mb-0 fw-bold">{{ $carouselItems->where('photo_1', '!=', null)->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-clock text-info fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Last Updated</h6>
                            <h3 class="mb-0 fw-bold">{{ $carouselItems->first()?->updated_at?->diffForHumans() ?? 'N/A' }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Main Content -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-table me-2 text-primary"></i>Carousel Items List
                </h5>
            </div>
        </div>
        <div class="card-body p-0">
            @forelse($carouselItems as $item)
                <div class="carousel-item-card border-bottom p-4 hover-effect">
                    <div class="row align-items-center">
                        <!-- Main Info -->
                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 45px; height: 45px;">
                                        <span class="fw-bold text-primary">{{ $loop->iteration }}</span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 fw-semibold">{{ Str::limit($item->title_1, 50) }}</h6>
                                    <p class="text-muted mb-0 small">
                                        <i class="fas fa-quote-left me-1"></i>
                                        {{ Str::limit($item->content_1, 80) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Photo -->
                        <div class="col-lg-3 mb-3 mb-lg-0">
                            <div class="d-flex align-items-center">
                                @if($item->photo_1)
                                    <img src="{{ asset('storage/' . $item->photo_1) }}"
                                         alt="Carousel Image"
                                         class="rounded shadow-sm me-2"
                                         style="width: 100px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center me-2"
                                         style="width: 100px; height: 60px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                                <div>
                                    <small class="text-muted d-block">Photo 1</small>
                                    <small class="fw-semibold">{{ $item->photo_1 ? 'Image' : 'No Image' }}</small>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="col-lg-3 text-lg-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('carousel.edit', $item->id) }}"
                                   class="btn btn-sm btn-outline-warning"
                                   data-bs-toggle="tooltip"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                {{-- <button type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $item->id }}"
                                        title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button> --}}
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

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title">
                                    <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                                    Confirm Delete
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this carousel item?</p>
                                <div class="alert alert-warning">
                                    <strong>{{ $item->title_1 }}</strong>
                                </div>
                                <p class="text-muted small mb-0">This action cannot be undone.</p>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('carousel.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-images fa-4x text-muted opacity-50"></i>
                    </div>
                    <h4 class="text-muted mb-2">No Carousel Items Found</h4>
                    <p class="text-muted mb-4">Start by creating your first carousel item</p>
                    <a href="{{ route('carousel.create') }}" class="btn btn-primary px-4">
                        <i class="fas fa-plus-circle me-2"></i>Create First Item
                    </a>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
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

.carousel-item-card:last-child {
    border-bottom: none !important;
}
</style>