@extends('layouts.admin')

@section('page-title', 'Edit About Item')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('about.index') }}">About Management</a></li>
                <li class="breadcrumb-item active">Edit Item</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <!-- Header Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                            <i class="fas fa-edit text-warning fs-3"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h3 class="mb-1 fw-bold">Edit About Item</h3>
                        <p class="text-muted mb-0">Update information and gallery images</p>
                    </div>
                    <div>
                        <a href="{{ route('about.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <form action="{{ route('about.update', $aboutItems->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-exclamation-circle me-2 mt-1"></i>
                        <div class="flex-grow-1">
                            <strong>Oops! There were some errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Main Information -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-info-circle text-primary me-2"></i>Main Information
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label for="title" class="form-label fw-semibold">
                            Title <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control form-control-lg @error('title') is-invalid @enderror"
                               id="title"
                               name="title"
                               value="{{ old('title', $aboutItems->title) }}"
                               placeholder="Enter main title">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-0">
                        <label for="subtitle" class="form-label fw-semibold">Subtitle</label>
                        <textarea class="form-control @error('subtitle') is-invalid @enderror"
                                  id="subtitle"
                                  name="subtitle"
                                  rows="3"
                                  placeholder="Enter subtitle or description">{{ old('subtitle', $aboutItems->subtitle) }}</textarea>
                        @error('subtitle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Gallery 1 -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-image text-success me-2"></i>Gallery Section 1
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="gallery_title_1" class="form-label fw-semibold">Gallery Title 1</label>
                            <input type="text"
                                   class="form-control @error('gallery_title_1') is-invalid @enderror"
                                   id="gallery_title_1"
                                   name="gallery_title_1"
                                   value="{{ old('gallery_title_1', $aboutItems->gallery_title_1) }}"
                                   placeholder="Enter gallery title">
                            @error('gallery_title_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="gallery_content_1" class="form-label fw-semibold">Gallery Content 1</label>
                            <input type="text"
                                   class="form-control @error('gallery_content_1') is-invalid @enderror"
                                   id="gallery_content_1"
                                   name="gallery_content_1"
                                   value="{{ old('gallery_content_1', $aboutItems->gallery_content_1) }}"
                                   placeholder="Enter gallery content">
                            @error('gallery_content_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-semibold">Gallery Image 1</label>

                        @if($aboutItems->gallery_photo_1)
                            <div class="card mb-3 border">
                                <div class="card-body p-3">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img src="{{ asset('storage/' . $aboutItems->gallery_photo_1) }}"
                                                 alt="Current Image 1"
                                                 class="rounded shadow-sm"
                                                 style="width: 120px; height: 120px; object-fit: cover;">
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-1">Current Image</h6>
                                            <p class="text-muted small mb-0">This image will be replaced if you upload a new one</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="border rounded p-3 bg-light">
                            <input type="file"
                                   class="form-control @error('gallery_photo_1') is-invalid @enderror"
                                   id="gallery_photo_1"
                                   name="gallery_photo_1"
                                   accept="image/*"
                                   onchange="previewImage(this, 'image_preview_1')">
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-info-circle me-1"></i>
                                Leave empty to keep current image. Max size: 2MB
                            </small>
                            @error('gallery_photo_1')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="image_preview_1" class="mt-3" style="display: none;">
                            <div class="card border">
                                <div class="card-body p-3">
                                    <p class="text-muted small mb-2">
                                        <i class="fas fa-eye me-1"></i>Preview New Image:
                                    </p>
                                    <img src="" alt="Preview" class="rounded shadow-sm" style="max-width: 100%; height: auto;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gallery 2 -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-image text-info me-2"></i>Gallery Section 2
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="gallery_title_2" class="form-label fw-semibold">Gallery Title 2</label>
                            <input type="text"
                                   class="form-control @error('gallery_title_2') is-invalid @enderror"
                                   id="gallery_title_2"
                                   name="gallery_title_2"
                                   value="{{ old('gallery_title_2', $aboutItems->gallery_title_2) }}"
                                   placeholder="Enter gallery title">
                            @error('gallery_title_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="gallery_content_2" class="form-label fw-semibold">Gallery Content 2</label>
                            <input type="text"
                                   class="form-control @error('gallery_content_2') is-invalid @enderror"
                                   id="gallery_content_2"
                                   name="gallery_content_2"
                                   value="{{ old('gallery_content_2', $aboutItems->gallery_content_2) }}"
                                   placeholder="Enter gallery content">
                            @error('gallery_content_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-semibold">Gallery Image 2</label>

                        @if($aboutItems->gallery_photo_2)
                            <div class="card mb-3 border">
                                <div class="card-body p-3">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img src="{{ asset('storage/' . $aboutItems->gallery_photo_2) }}"
                                                 alt="Current Image 2"
                                                 class="rounded shadow-sm"
                                                 style="width: 120px; height: 120px; object-fit: cover;">
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-1">Current Image</h6>
                                            <p class="text-muted small mb-0">This image will be replaced if you upload a new one</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="border rounded p-3 bg-light">
                            <input type="file"
                                   class="form-control @error('gallery_photo_2') is-invalid @enderror"
                                   id="gallery_photo_2"
                                   name="gallery_photo_2"
                                   accept="image/*"
                                   onchange="previewImage(this, 'image_preview_2')">
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-info-circle me-1"></i>
                                Leave empty to keep current image. Max size: 2MB
                            </small>
                            @error('gallery_photo_2')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="image_preview_2" class="mt-3" style="display: none;">
                            <div class="card border">
                                <div class="card-body p-3">
                                    <p class="text-muted small mb-2">
                                        <i class="fas fa-eye me-1"></i>Preview New Image:
                                    </p>
                                    <img src="" alt="Preview" class="rounded shadow-sm" style="max-width: 100%; height: auto;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('about.index') }}" class="btn btn-lg btn-secondary px-4">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-lg btn-warning px-4">
                            <i class="fas fa-save me-2"></i>Update Item
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.style.display = "block";
                preview.querySelector('img').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush