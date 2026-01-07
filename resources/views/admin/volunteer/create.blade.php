@extends('layouts.admin')

@section('page-title', 'Create Volunteer Program')

@section('content')
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('volunteer.index') }}">Volunteer Management</a></li>
                    <li class="breadcrumb-item active">Create Program</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-2 fw-bold">Create Volunteer Program</h2>
                    <p class="text-muted mb-0">
                        <i class="fas fa-plus-circle me-1"></i>
                        Add a new volunteer program to your website
                    </p>
                </div>
                <div>
                    <a href="{{ route('volunteer.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
            <h5 class="mb-0 fw-semibold">
                <i class="fas fa-hands-helping me-2 text-primary"></i>Volunteer Program Information
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('volunteer.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Basic Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="fw-semibold mb-3 text-primary">
                            <i class="fas fa-info-circle me-2"></i>Basic Information
                        </h6>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="title" class="form-label fw-semibold">Program Title *</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title') }}"
                               placeholder="e.g., Community Health Volunteer Program">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="content" class="form-label fw-semibold">Program Description *</label>
                        <textarea class="form-control @error('content') is-invalid @enderror"
                                  id="content" name="content" rows="5"
                                  placeholder="Describe the volunteer program, objectives, and activities...">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="date" class="form-label fw-semibold">Program Date *</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror"
                               id="date" name="date" value="{{ old('date') }}">
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label fw-semibold">Status *</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="">Select Status</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="link" class="form-label fw-semibold">External Link (Optional)</label>
                        <input type="url" class="form-control @error('link') is-invalid @enderror"
                               id="link" name="link" value="{{ old('link') }}"
                               placeholder="https://example.com/volunteer-info">
                        @error('link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Link to external website or additional information</div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Requirements/Specifications -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="fw-semibold mb-3 text-primary">
                            <i class="fas fa-list-check me-2"></i>Volunteer Requirements/Specifications
                        </h6>
                        <p class="text-muted small mb-3">Add up to 10 requirements or specifications for volunteers</p>
                    </div>

                    @for ($i = 1; $i <= 10; $i++)
                        <div class="col-md-6 mb-3">
                            <label for="specification_{{ $i }}" class="form-label">Requirement {{ $i }} {{ $i == 1 ? '' : '(Optional)' }}</label>
                            <input type="text" class="form-control @error('specification_'.$i) is-invalid @enderror"
                                   id="specification_{{ $i }}" name="specification_{{ $i }}"
                                   value="{{ old('specification_'.$i) }}"
                                   placeholder="e.g., Minimum age 18 years">
                            @error('specification_'.$i)
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endfor
                </div>

                <hr class="my-4">

                <!-- Contact Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="fw-semibold mb-3 text-primary">
                            <i class="fas fa-address-book me-2"></i>Contact Information
                        </h6>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="pic_1" class="form-label fw-semibold">Primary Contact Person *</label>
                        <input type="text" class="form-control @error('pic_1') is-invalid @enderror"
                               id="pic_1" name="pic_1" value="{{ old('pic_1') }}"
                               placeholder="Full Name">
                        @error('pic_1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phonenumber_1" class="form-label fw-semibold">Primary Phone Number *</label>
                        <input type="tel" class="form-control @error('phonenumber_1') is-invalid @enderror"
                               id="phonenumber_1" name="phonenumber_1" value="{{ old('phonenumber_1') }}"
                               placeholder="08123456789">
                        @error('phonenumber_1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="pic_2" class="form-label">Secondary Contact Person (Optional)</label>
                        <input type="text" class="form-control @error('pic_2') is-invalid @enderror"
                               id="pic_2" name="pic_2" value="{{ old('pic_2') }}"
                               placeholder="Full Name">
                        @error('pic_2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phonenumber_2" class="form-label">Secondary Phone Number (Optional)</label>
                        <input type="tel" class="form-control @error('phonenumber_2') is-invalid @enderror"
                               id="phonenumber_2" name="phonenumber_2" value="{{ old('phonenumber_2') }}"
                               placeholder="08123456789">
                        @error('phonenumber_2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">

                <!-- Photos -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="fw-semibold mb-3 text-primary">
                            <i class="fas fa-images me-2"></i>Program Photos
                        </h6>
                        <p class="text-muted small mb-3">Upload photos related to the volunteer program (JPEG, PNG, JPG, GIF - Max 2MB each)</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="photo_1" class="form-label">Photo 1</label>
                        <input type="file" class="form-control @error('photo_1') is-invalid @enderror"
                               id="photo_1" name="photo_1" accept="image/*">
                        @error('photo_1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="photo_2" class="form-label">Photo 2 (Optional)</label>
                        <input type="file" class="form-control @error('photo_2') is-invalid @enderror"
                               id="photo_2" name="photo_2" accept="image/*">
                        @error('photo_2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="photo_3" class="form-label">Photo 3 (Optional)</label>
                        <input type="file" class="form-control @error('photo_3') is-invalid @enderror"
                               id="photo_3" name="photo_3" accept="image/*">
                        @error('photo_3')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('volunteer.index') }}" class="btn btn-secondary px-4">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Create Program
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
    // Auto-resize textarea
    document.getElementById('content').addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });

    // Phone number formatting
    document.querySelectorAll('input[type="tel"]').forEach(function(input) {
        input.addEventListener('input', function() {
            // Remove non-numeric characters except + at the beginning
            let value = this.value.replace(/[^\d+]/g, '');

            // Ensure + is only at the beginning
            if (value.indexOf('+') > 0) {
                value = value.replace(/\+/g, '');
            }

            this.value = value;
        });
    });

    // Preview uploaded images
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById(previewId);
                if (preview) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Add image preview functionality
    ['photo_1', 'photo_2', 'photo_3'].forEach(function(inputId) {
        const input = document.getElementById(inputId);
        if (input) {
            input.addEventListener('change', function() {
                previewImage(this, inputId + '_preview');
            });
        }
    });
</script>
@endpush