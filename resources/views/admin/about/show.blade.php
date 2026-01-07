@extends('layouts.admin')

@section('page-title', 'About Item Details')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('about.index') }}">About Management</a></li>
                <li class="breadcrumb-item active">Item Details</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-lg-10 mx-auto">
        <!-- Header Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-eye text-primary fs-3"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="mb-1 fw-bold">{{ $aboutItems->title }}</h3>
                            <p class="text-muted mb-0">View complete information about this item</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('about.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </a>
                        <a href="{{ route('about.edit', $aboutItems->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash me-2"></i>Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-info-circle text-primary me-2"></i>Main Information
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="info-group">
                            <label class="text-muted small d-block mb-2">TITLE</label>
                            <h5 class="mb-0 fw-semibold">{{ $aboutItems->title ?? '-' }}</h5>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="info-group">
                            <label class="text-muted small d-block mb-2">SUBTITLE</label>
                            <p class="mb-0">{{ $aboutItems->subtitle ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery 1 -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-images text-success me-2"></i>Gallery Section 1
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <div class="info-group">
                            <label class="text-muted small d-block mb-2">GALLERY TITLE 1</label>
                            <h6 class="mb-0">{{ $aboutItems->gallery_title_1 ?? '-' }}</h6>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="info-group">
                            <label class="text-muted small d-block mb-2">GALLERY CONTENT 1</label>
                            <p class="mb-0">{{ $aboutItems->gallery_content_1 ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="info-group">
                    <label class="text-muted small d-block mb-3">GALLERY IMAGE 1</label>
                    @if($aboutItems->gallery_photo_1)
                        <div class="position-relative d-inline-block">
                            <img src="{{ asset('storage/' . $aboutItems->gallery_photo_1) }}"
                                 alt="Gallery 1"
                                 class="img-fluid rounded shadow-sm border"
                                 style="max-width: 100%; max-height: 400px; object-fit: cover;">
                            <div class="position-absolute top-0 end-0 m-2">
                                <a href="{{ asset('storage/' . $aboutItems->gallery_photo_1) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-light shadow-sm"
                                   data-bs-toggle="tooltip"
                                   title="View full size">
                                    <i class="fas fa-expand"></i>
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-light border d-inline-flex align-items-center">
                            <i class="fas fa-image-slash text-muted me-2"></i>
                            <span class="text-muted">No image uploaded</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Gallery 2 -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-images text-info me-2"></i>Gallery Section 2
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <div class="info-group">
                            <label class="text-muted small d-block mb-2">GALLERY TITLE 2</label>
                            <h6 class="mb-0">{{ $aboutItems->gallery_title_2 ?? '-' }}</h6>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="info-group">
                            <label class="text-muted small d-block mb-2">GALLERY CONTENT 2</label>
                            <p class="mb-0">{{ $aboutItems->gallery_content_2 ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="info-group">
                    <label class="text-muted small d-block mb-3">GALLERY IMAGE 2</label>
                    @if($aboutItems->gallery_photo_2)
                        <div class="position-relative d-inline-block">
                            <img src="{{ asset('storage/' . $aboutItems->gallery_photo_2) }}"
                                 alt="Gallery 2"
                                 class="img-fluid rounded shadow-sm border"
                                 style="max-width: 100%; max-height: 400px; object-fit: cover;">
                            <div class="position-absolute top-0 end-0 m-2">
                                <a href="{{ asset('storage/' . $aboutItems->gallery_photo_2) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-light shadow-sm"
                                   data-bs-toggle="tooltip"
                                   title="View full size">
                                    <i class="fas fa-expand"></i>
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-light border d-inline-flex align-items-center">
                            <i class="fas fa-image-slash text-muted me-2"></i>
                            <span class="text-muted">No image uploaded</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Metadata -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-clock text-secondary me-2"></i>Metadata
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                    <i class="fas fa-calendar-plus text-success"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <label class="text-muted small d-block mb-1">CREATED AT</label>
                                <h6 class="mb-0">
                                    {{ $aboutItems->created_at ? $aboutItems->created_at->format('d M Y, H:i') : '-' }}
                                </h6>
                                <small class="text-muted">
                                    {{ $aboutItems->created_at ? $aboutItems->created_at->diffForHumans() : '' }}
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                    <i class="fas fa-sync text-warning"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <label class="text-muted small d-block mb-1">LAST UPDATED</label>
                                <h6 class="mb-0">
                                    {{ $aboutItems->updated_at ? $aboutItems->updated_at->format('d M Y, H:i') : '-' }}
                                </h6>
                                <small class="text-muted">
                                    {{ $aboutItems->updated_at ? $aboutItems->updated_at->diffForHumans() : '' }}
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                    <i class="fas fa-hashtag text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <label class="text-muted small d-block mb-1">ITEM ID</label>
                                <h6 class="mb-0">#{{ $aboutItems->id }}</h6>
                                <small class="text-muted">Database ID</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <i class="fas fa-trash-alt text-danger" style="font-size: 3rem;"></i>
                </div>
                <h5 class="text-center mb-3">Are you sure?</h5>
                <p class="text-center text-muted mb-4">
                    You are about to delete this about item permanently. This action cannot be undone.
                </p>
                <div class="alert alert-warning">
                    <strong>Item:</strong> {{ $aboutItems->title }}
                </div>
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <form action="{{ route('about.destroy', $aboutItems->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Yes, Delete It
                    </button>
                </form>
            </div>
        </div>
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