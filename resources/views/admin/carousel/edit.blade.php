@extends('layouts.admin')

@section('page-title', 'Edit Carousel Item')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route('carousel.index') }}" class="btn btn-outline-secondary mb-3">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit Carousel Item</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('carousel.update', $carouselItem->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- First Slide -->
                    <div class="mb-4 p-4 border rounded" style="background-color: #f8f9fa;">
                        <h6 class="mb-3">First Slide</h6>

                        <div class="mb-3">
                            <label for="title_1" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title_1') is-invalid @enderror"
                                id="title_1" name="title_1" value="{{ old('title_1', $carouselItem->title_1) }}">
                            @error('title_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content_1" class="form-label">Content</label>
                            <textarea class="form-control @error('content_1') is-invalid @enderror"
                                id="content_1" name="content_1" rows="3">{{ old('content_1', $carouselItem->content_1) }}</textarea>
                            @error('content_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="photo_1" class="form-label">Image</label>
                            <input type="file" class="form-control @error('photo_1') is-invalid @enderror"
                                id="photo_1" name="photo_1" accept="image/*" onchange="previewImage(this, 'image_preview_1')">
                            @error('photo_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if($carouselItem->photo_1)
                                <div class="mt-2">
                                    <p class="mb-1">Current image:</p>
                                    <img src="{{ asset('storage/' . $carouselItem->photo_1) }}" alt="Current Image" class="current-image">
                                </div>
                            @endif
                            <div id="image_preview_1" class="image-preview mt-2" style="display: none;"></div>
                        </div>
                    </div>

                    <!-- Second Slide -->
                    <div class="mb-4 p-4 border rounded" style="background-color: #f8f9fa;">
                        <h6 class="mb-3">Second Slide</h6>

                        <div class="mb-3">
                            <label for="title_2" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title_2') is-invalid @enderror"
                                id="title_2" name="title_2" value="{{ old('title_2', $carouselItem->title_2) }}">
                            @error('title_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content_2" class="form-label">Content</label>
                            <textarea class="form-control @error('content_2') is-invalid @enderror"
                                id="content_2" name="content_2" rows="3">{{ old('content_2', $carouselItem->content_2) }}</textarea>
                            @error('content_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="photo_2" class="form-label">Image</label>
                            <input type="file" class="form-control @error('photo_2') is-invalid @enderror"
                                id="photo_2" name="photo_2" accept="image/*" onchange="previewImage(this, 'image_preview_2')">
                            @error('photo_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if($carouselItem->photo_2)
                                <div class="mt-2">
                                    <p class="mb-1">Current image:</p>
                                    <img src="{{ asset('storage/' . $carouselItem->photo_2) }}" alt="Current Image" class="current-image">
                                </div>
                            @endif
                            <div id="image_preview_2" class="image-preview mt-2" style="display: none;"></div>
                        </div>
                    </div>

                    <!-- Third Slide -->
                    <div class="mb-4 p-4 border rounded" style="background-color: #f8f9fa;">
                        <h6 class="mb-3">Third Slide</h6>

                        <div class="mb-3">
                            <label for="title_3" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title_3') is-invalid @enderror"
                                id="title_3" name="title_3" value="{{ old('title_3', $carouselItem->title_3) }}">
                            @error('title_3')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content_3" class="form-label">Content</label>
                            <textarea class="form-control @error('content_3') is-invalid @enderror"
                                id="content_3" name="content_3" rows="3">{{ old('content_3', $carouselItem->content_3) }}</textarea>
                            @error('content_3')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="photo_3" class="form-label">Image</label>
                            <input type="file" class="form-control @error('photo_3') is-invalid @enderror"
                                id="photo_3" name="photo_3" accept="image/*" onchange="previewImage(this, 'image_preview_3')">
                            @error('photo_3')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if($carouselItem->photo_3)
                                <div class="mt-2">
                                    <p class="mb-1">Current image:</p>
                                    <img src="{{ asset('storage/' . $carouselItem->photo_3) }}" alt="Current Image" class="current-image">
                                </div>
                            @endif
                            <div id="image_preview_3" class="image-preview mt-2" style="display: none;"></div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('carousel.index') }}" class="btn btn-secondary me-md-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Carousel Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        preview.style.display = "block";

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.style.backgroundImage = `url('${e.target.result}')`;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush