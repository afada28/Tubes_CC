@extends('layouts.admin')

@section('page-title', 'Edit Journey Item')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('journey-founder.index') }}" class="btn btn-outline-secondary mb-3">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-semibold">Edit Journey Item</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('journey-founder.update', $journeyItems->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Basic Information -->
                        <div class="mb-4 p-4 border rounded bg-light">
                            <h6 class="mb-3 fw-semibold text-primary">
                                <i class="fas fa-info-circle me-2"></i>Basic Information
                            </h6>

                            <div class="mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title', $journeyItems->title) }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5">{{ old('content', $journeyItems->content) }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="date_start" class="form-label">Start Date</label>
                                        <input type="date" class="form-control @error('date_start') is-invalid @enderror"
                                            id="date_start" name="date_start"
                                            value="{{ old('date_start', $journeyItems->date_start ? $journeyItems->date_start->format('Y-m-d') : '') }}">
                                        @error('date_start')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Format: YYYY-MM-DD</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="date_end" class="form-label">End Date</label>
                                        <input type="date" class="form-control @error('date_end') is-invalid @enderror"
                                            id="date_end" name="date_end"
                                            value="{{ old('date_end', $journeyItems->date_end ? $journeyItems->date_end->format('Y-m-d') : '') }}">
                                        @error('date_end')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Must be after or equal to start date</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Location</label>
                                        <input type="text" class="form-control @error('location') is-invalid @enderror"
                                            id="location" name="location"
                                            value="{{ old('location', $journeyItems->location) }}"
                                            placeholder="e.g., San Francisco, CA">
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Photos Section -->
                        <div class="mb-4 p-4 border rounded bg-light">
                            <h6 class="mb-3 fw-semibold text-primary">
                                <i class="fas fa-images me-2"></i>Photos
                            </h6>

                            <div class="mb-3">
                                <label for="photo_1" class="form-label">Primary Photo <span
                                        class="text-danger">*</span></label>
                                @if ($journeyItems->photo_1)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $journeyItems->photo_1) }}" alt="Primary Photo"
                                            class="img-thumbnail" style="height: 150px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control @error('photo_1') is-invalid @enderror"
                                    id="photo_1" name="photo_1" accept="image/*"
                                    onchange="previewImage(this, 'preview_photo_1')">
                                @error('photo_1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="preview_photo_1" class="image-preview mt-2 rounded"
                                    style="display: none; width: 150px; height: 150px; background-size: cover; background-position: center;">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="photo_2" class="form-label">Additional Photo 1</label>
                                        @if ($journeyItems->photo_2)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $journeyItems->photo_2) }}"
                                                    alt="Additional Photo 1" class="img-thumbnail" style="height: 150px;">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control @error('photo_2') is-invalid @enderror"
                                            id="photo_2" name="photo_2" accept="image/*"
                                            onchange="previewImage(this, 'preview_photo_2')">
                                        @error('photo_2')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="preview_photo_2" class="image-preview mt-2 rounded"
                                            style="display: none; width: 150px; height: 150px; background-size: cover; background-position: center;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="photo_3" class="form-label">Additional Photo 2</label>
                                        @if ($journeyItems->photo_3)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $journeyItems->photo_3) }}"
                                                    alt="Additional Photo 2" class="img-thumbnail"
                                                    style="height: 150px;">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control @error('photo_3') is-invalid @enderror"
                                            id="photo_3" name="photo_3" accept="image/*"
                                            onchange="previewImage(this, 'preview_photo_3')">
                                        @error('photo_3')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="preview_photo_3" class="image-preview mt-2 rounded"
                                            style="display: none; width: 150px; height: 150px; background-size: cover; background-position: center;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="photo_4" class="form-label">Additional Photo 3</label>
                                        @if ($journeyItems->photo_4)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $journeyItems->photo_4) }}"
                                                    alt="Additional Photo 3" class="img-thumbnail"
                                                    style="height: 150px;">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control @error('photo_4') is-invalid @enderror"
                                            id="photo_4" name="photo_4" accept="image/*"
                                            onchange="previewImage(this, 'preview_photo_4')">
                                        @error('photo_4')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="preview_photo_4" class="image-preview mt-2 rounded"
                                            style="display: none; width: 150px; height: 150px; background-size: cover; background-position: center;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="photo_5" class="form-label">Additional Photo 4</label>
                                        @if ($journeyItems->photo_5)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $journeyItems->photo_5) }}"
                                                    alt="Additional Photo 4" class="img-thumbnail"
                                                    style="height: 150px;">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control @error('photo_5') is-invalid @enderror"
                                            id="photo_5" name="photo_5" accept="image/*"
                                            onchange="previewImage(this, 'preview_photo_5')">
                                        @error('photo_5')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="preview_photo_5" class="image-preview mt-2 rounded"
                                            style="display: none; width: 150px; height: 150px; background-size: cover; background-position: center;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Collapsible Additional Photos -->
                            <div class="mt-3">
                                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#additionalPhotos">
                                    <i class="fas fa-plus me-2"></i>Show More Photos
                                </button>
                                <div class="collapse mt-3" id="additionalPhotos">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="photo_6" class="form-label">Additional Photo 5</label>
                                                @if ($journeyItems->photo_6)
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/' . $journeyItems->photo_6) }}"
                                                            alt="Additional Photo 5" class="img-thumbnail"
                                                            style="height: 150px;">
                                                    </div>
                                                @endif
                                                <input type="file"
                                                    class="form-control @error('photo_6') is-invalid @enderror"
                                                    id="photo_6" name="photo_6" accept="image/*"
                                                    onchange="previewImage(this, 'preview_photo_6')">
                                                @error('photo_6')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div id="preview_photo_6" class="image-preview mt-2 rounded"
                                                    style="display: none; width: 150px; height: 150px; background-size: cover; background-position: center;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="photo_7" class="form-label">Additional Photo 6</label>
                                                @if ($journeyItems->photo_7)
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/' . $journeyItems->photo_7) }}"
                                                            alt="Additional Photo 6" class="img-thumbnail"
                                                            style="height: 150px;">
                                                    </div>
                                                @endif
                                                <input type="file"
                                                    class="form-control @error('photo_7') is-invalid @enderror"
                                                    id="photo_7" name="photo_7" accept="image/*"
                                                    onchange="previewImage(this, 'preview_photo_7')">
                                                @error('photo_7')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div id="preview_photo_7" class="image-preview mt-2 rounded"
                                                    style="display: none; width: 150px; height: 150px; background-size: cover; background-position: center;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="photo_8" class="form-label">Additional Photo 7</label>
                                                @if ($journeyItems->photo_8)
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/' . $journeyItems->photo_8) }}"
                                                            alt="Additional Photo 7" class="img-thumbnail"
                                                            style="height: 150px;">
                                                    </div>
                                                @endif
                                                <input type="file"
                                                    class="form-control @error('photo_8') is-invalid @enderror"
                                                    id="photo_8" name="photo_8" accept="image/*"
                                                    onchange="previewImage(this, 'preview_photo_8')">
                                                @error('photo_8')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div id="preview_photo_8" class="image-preview mt-2 rounded"
                                                    style="display: none; width: 150px; height: 150px; background-size: cover; background-position: center;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="photo_9" class="form-label">Additional Photo 8</label>
                                                @if ($journeyItems->photo_9)
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/' . $journeyItems->photo_9) }}"
                                                            alt="Additional Photo 8" class="img-thumbnail"
                                                            style="height: 150px;">
                                                    </div>
                                                @endif
                                                <input type="file"
                                                    class="form-control @error('photo_9') is-invalid @enderror"
                                                    id="photo_9" name="photo_9" accept="image/*"
                                                    onchange="previewImage(this, 'preview_photo_9')">
                                                @error('photo_9')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div id="preview_photo_9" class="image-preview mt-2 rounded"
                                                    style="display: none; width: 150px; height: 150px; background-size: cover; background-position: center;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="photo_10" class="form-label">Additional Photo 9</label>
                                                @if ($journeyItems->photo_10)
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/' . $journeyItems->photo_10) }}"
                                                            alt="Additional Photo 9" class="img-thumbnail"
                                                            style="height: 150px;">
                                                    </div>
                                                @endif
                                                <input type="file"
                                                    class="form-control @error('photo_10') is-invalid @enderror"
                                                    id="photo_10" name="photo_10" accept="image/*"
                                                    onchange="previewImage(this, 'preview_photo_10')">
                                                @error('photo_10')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div id="preview_photo_10" class="image-preview mt-2 rounded"
                                                    style="display: none; width: 150px; height: 150px; background-size: cover; background-position: center;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('journey-founder.index') }}" class="btn btn-secondary me-md-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Journey Item
                            </button>
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

        // Show additional photos section if there are photos
        document.addEventListener('DOMContentLoaded', function() {
            const hasAdditionalPhotos =
                {{ $journeyItems->photo_6 ||
                $journeyItems->photo_7 ||
                $journeyItems->photo_8 ||
                $journeyItems->photo_9 ||
                $journeyItems->photo_10
                    ? 'true'
                    : 'false' }};

            if (hasAdditionalPhotos) {
                new bootstrap.Collapse(document.getElementById('additionalPhotos'));
            }
        });
    </script>
@endpush
