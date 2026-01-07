@extends('layouts.admin')

@section('page-title', 'Add About Item')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route('about.index') }}" class="btn btn-outline-secondary mb-3">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Add New About Item</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

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
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                id="title" name="title" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subtitle" class="form-label">subtitle</label>
                            <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                                id="subtitle" name="subtitle" value="{{ old('subtitle') }}">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gallery_title_1" class="form-label">Gallery Title 1</label>
                            <input type="text" class="form-control @error('gallery_title_1') is-invalid @enderror"
                                id="gal" name="gallery_title_1" value="{{ old('gallery_title_1') }}">
                            @error('gallery_title_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gallery_content_1" class="form-label">Gallery Content 1</label>
                            <input type="text" class="form-control @error('gallery_content_1') is-invalid @enderror"
                                id="gal" name="gallery_content_1" value="{{ old('gallery_content_1') }}">
                            @error('gallery_content_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gallery_photo_1" class="form-label">Gallery Image 1</label>
                            <input type="file" class="form-control @error('gallery_photo_1') is-invalid @enderror"
                                id="gallery_photo_1" name="gallery_photo_1" accept="image/*" onchange="previewImage(this, 'image_preview_1')">
                            @error('gallery_photo_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="image_preview_1" class="image-preview mt-2" style="display: none;"></div>
                        </div>

                        <div class="mb-3">
                            <label for="gallery_title_2" class="form-label">Gallery Title 2</label>
                            <input type="text" class="form-control @error('gallery_title_2') is-invalid @enderror"
                                id="gal" name="gallery_title_2" value="{{ old('gallery_title_2') }}">
                            @error('gallery_title_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gallery_content_2" class="form-label">Gallery Content 2</label>
                            <input type="text" class="form-control @error('gallery_content_2') is-invalid @enderror"
                                id="gal" name="gallery_content_2" value="{{ old('gallery_content_2') }}">
                            @error('gallery_content_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gallery_photo_2" class="form-label">Gallery Image 2</label>
                            <input type="file" class="form-control @error('gallery_photo_2') is-invalid @enderror"
                                id="gallery_photo_2" name="gallery_photo_2" accept="image/*" onchange="previewImage(this, 'image_preview_1')">
                            @error('gallery_photo_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="image_preview_1" class="image-preview mt-2" style="display: none;"></div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('about.index') }}" class="btn btn-secondary me-md-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save About Item</button>
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
