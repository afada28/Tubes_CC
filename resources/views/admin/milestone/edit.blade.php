@extends('layouts.admin')

@section('page-title', 'Edit Milestone Item')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('milestone.index') }}" class="btn btn-outline-secondary mb-3">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2 text-warning"></i>Edit Milestone Item
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('milestone.update', $milestoneItems->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h6 class="alert-heading">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Please fix the following errors:
                                </h6>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Current Photo -->
                        <div class="mb-4 p-3 border rounded bg-light">
                            <label class="form-label fw-bold">Current Photo</label>
                            <div class="text-center">
                                <img src="{{ asset('storage/' . $milestoneItems->photo) }}"
                                     alt="Current Photo"
                                     class="img-thumbnail shadow-sm"
                                     style="max-width: 200px; max-height: 200px; object-fit: cover;">
                            </div>
                        </div>

                        <!-- Milestone Timeline Section -->
                        <div class="mb-4 p-4 border rounded" style="background-color: #f8f9fa;">
                            <h6 class="mb-3 fw-bold text-primary">
                                <i class="fas fa-flag-checkered me-2"></i>Timeline 1
                            </h6>

                            <div class="mb-3">
                                <label for="timeline_title_1" class="form-label">Milestone Title 1 <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('timeline_title_1') is-invalid @enderror"
                                       id="timeline_title_1"
                                       name="timeline_title_1"
                                       value="{{ old('timeline_title_1', $milestoneItems->timeline_title_1) }}"
                                       placeholder="Enter milestone title">
                                @error('timeline_title_1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="timeline_content_1" class="form-label">Milestone Content 1 <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('timeline_content_1') is-invalid @enderror"
                                          id="timeline_content_1"
                                          name="timeline_content_1"
                                          rows="3"
                                          placeholder="Enter milestone content">{{ old('timeline_content_1', $milestoneItems->timeline_content_1) }}</textarea>
                                @error('timeline_content_1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 p-4 border rounded" style="background-color: #f0f8f0;">
                            <h6 class="mb-3 fw-bold text-success">
                                <i class="fas fa-flag-checkered me-2"></i>Timeline 2
                            </h6>

                            <div class="mb-3">
                                <label for="timeline_title_2" class="form-label">Milestone Title 2 <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('timeline_title_2') is-invalid @enderror"
                                       id="timeline_title_2"
                                       name="timeline_title_2"
                                       value="{{ old('timeline_title_2', $milestoneItems->timeline_title_2) }}"
                                       placeholder="Enter milestone title">
                                @error('timeline_title_2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="timeline_content_2" class="form-label">Milestone Content 2 <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('timeline_content_2') is-invalid @enderror"
                                          id="timeline_content_2"
                                          name="timeline_content_2"
                                          rows="3"
                                          placeholder="Enter milestone content">{{ old('timeline_content_2', $milestoneItems->timeline_content_2) }}</textarea>
                                @error('timeline_content_2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 p-4 border rounded" style="background-color: #f0f8ff;">
                            <h6 class="mb-3 fw-bold text-info">
                                <i class="fas fa-flag-checkered me-2"></i>Timeline 3
                            </h6>

                            <div class="mb-3">
                                <label for="timeline_title_3" class="form-label">Milestone Title 3 <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('timeline_title_3') is-invalid @enderror"
                                       id="timeline_title_3"
                                       name="timeline_title_3"
                                       value="{{ old('timeline_title_3', $milestoneItems->timeline_title_3) }}"
                                       placeholder="Enter milestone title">
                                @error('timeline_title_3')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="timeline_content_3" class="form-label">Milestone Content 3 <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('timeline_content_3') is-invalid @enderror"
                                          id="timeline_content_3"
                                          name="timeline_content_3"
                                          rows="3"
                                          placeholder="Enter milestone content">{{ old('timeline_content_3', $milestoneItems->timeline_content_3) }}</textarea>
                                @error('timeline_content_3')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 p-4 border rounded" style="background-color: #fff8f0;">
                            <h6 class="mb-3 fw-bold text-warning">
                                <i class="fas fa-flag-checkered me-2"></i>Timeline 4
                            </h6>

                            <div class="mb-3">
                                <label for="timeline_title_4" class="form-label">Milestone Title 4 <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('timeline_title_4') is-invalid @enderror"
                                       id="timeline_title_4"
                                       name="timeline_title_4"
                                       value="{{ old('timeline_title_4', $milestoneItems->timeline_title_4) }}"
                                       placeholder="Enter milestone title">
                                @error('timeline_title_4')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="timeline_content_4" class="form-label">Milestone Content 4 <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('timeline_content_4') is-invalid @enderror"
                                          id="timeline_content_4"
                                          name="timeline_content_4"
                                          rows="3"
                                          placeholder="Enter milestone content">{{ old('timeline_content_4', $milestoneItems->timeline_content_4) }}</textarea>
                                @error('timeline_content_4')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Photo Upload -->
                        <div class="mb-4 p-4 border rounded">
                            <h6 class="mb-3 fw-bold">
                                <i class="fas fa-image me-2"></i>Update Photo (Optional)
                            </h6>

                            <div class="mb-3">
                                <label for="photo" class="form-label">New Photo</label>
                                <input type="file"
                                       class="form-control @error('photo') is-invalid @enderror"
                                       id="photo"
                                       name="photo"
                                       accept="image/*"
                                       onchange="previewImage(this, 'image_preview')">
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Leave empty to keep current photo. Accepted formats: JPG, PNG, GIF (Max: 2MB)
                                </small>
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="image_preview" class="image-preview mt-3" style="display: none;"></div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('milestone.index') }}" class="btn btn-secondary px-4">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-warning px-4">
                                <i class="fas fa-save me-2"></i>Update Milestone
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
            preview.innerHTML = '';

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.innerHTML = `
                        <div class="text-center">
                            <img src="${e.target.result}"
                                 class="img-thumbnail shadow-sm"
                                 style="max-width: 200px; max-height: 200px; object-fit: cover;"
                                 alt="Preview">
                            <p class="mt-2 text-muted small">New photo preview</p>
                        </div>
                    `;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush

<style>
    .image-preview {
        min-height: 50px;
    }
</style>