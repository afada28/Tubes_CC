@extends('layouts.admin')

@section('page-title', 'Add Donation Information')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route('donate.index') }}" class="btn btn-outline-secondary mb-3">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-plus-circle me-2"></i>Add New Donation Information
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('donate.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <h6 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Please fix the following errors:</h6>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Basic Information -->
                    <div class="mb-4 p-4 border rounded" style="background-color: #f8f9fa;">
                        <h6 class="fw-bold mb-3 text-primary">
                            <i class="fas fa-info-circle me-2"></i>Basic Information
                        </h6>

                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                id="title" name="title" value="{{ old('title') }}" placeholder="Enter donation title">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('content') is-invalid @enderror"
                                id="content" name="content" rows="4" placeholder="Enter donation description">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="target" class="form-label">Donation Target <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('target') is-invalid @enderror"
                                id="target" name="target" value="{{ old('target') }}" placeholder="Enter donation target">
                            @error('target')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                    id="start_date" name="start_date" value="{{ old('start_date') }}">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                    id="end_date" name="end_date" value="{{ old('end_date') }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="">-- Select Status --</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Set donation status visibility</small>
                            </div>
                            <div class="mb-3">
                                <label for="photo_1" class="form-label">Photo <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('photo_1') is-invalid @enderror"
                                    id="photo_1" name="photo_1" accept="image/*" onchange="previewImage(this, 'preview_1')">
                                @error('photo_1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <img id="preview_1" class="mt-2 rounded shadow-sm" style="display: none; max-width: 200px; max-height: 200px;">
                            </div>

                            <div class="mb-3">
                                <label for="photo_2" class="form-label">Photo <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('photo_2') is-invalid @enderror"
                                    id="photo_2" name="photo_2" accept="image/*" onchange="previewImage(this, 'preview_2')">
                                @error('photo_2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <img id="preview_2" class="mt-2 rounded shadow-sm" style="display: none; max-width: 200px; max-height: 200px;">
                            </div>

                            <div class="mb-3">
                                <label for="photo_3" class="form-label">Photo <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('photo_3') is-invalid @enderror"
                                    id="photo_3" name="photo_3" accept="image/*" onchange="previewImage(this, 'preview_3')">
                                @error('photo_3')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <img id="preview_3" class="mt-2 rounded shadow-sm" style="display: none; max-width: 200px; max-height: 200px;">
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method 1 -->
                    <div class="mb-4 p-4 border rounded" style="background-color: #fff3cd;">
                        <h6 class="fw-bold mb-3 text-warning">
                            <i class="fas fa-credit-card me-2"></i>Payment Method 1 <span class="text-danger">*</span>
                        </h6>

                        <div class="mb-3">
                            <label for="payment_method_1" class="form-label">Payment Method Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('payment_method_1') is-invalid @enderror"
                                id="payment_method_1" name="payment_method_1" value="{{ old('payment_method_1') }}"
                                placeholder="e.g., Bank Transfer, E-Wallet">
                            @error('payment_method_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pic_payment_method_1" class="form-label">Account Number/Details <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('pic_payment_method_1') is-invalid @enderror"
                                id="pic_payment_method_1" name="pic_payment_method_1" value="{{ old('pic_payment_method_1') }}"
                                placeholder="e.g., 1234567890">
                            @error('pic_payment_method_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contact_person_1" class="form-label">Contact Person <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('contact_person_1') is-invalid @enderror"
                                id="contact_person_1" name="contact_person_1" value="{{ old('contact_person_1') }}"
                                placeholder="e.g., John Doe - 081234567890">
                            @error('contact_person_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Payment Method 2 (Optional) -->
                    <div class="mb-4 p-4 border rounded" style="background-color: #d1ecf1;">
                        <h6 class="fw-bold mb-3 text-info">
                            <i class="fas fa-credit-card me-2"></i>Payment Method 2 (Optional)
                        </h6>

                        <div class="mb-3">
                            <label for="payment_method_2" class="form-label">Payment Method Name</label>
                            <input type="text" class="form-control @error('payment_method_2') is-invalid @enderror"
                                id="payment_method_2" name="payment_method_2" value="{{ old('payment_method_2') }}"
                                placeholder="e.g., Bank Transfer, E-Wallet">
                            @error('payment_method_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pic_payment_method_2" class="form-label">Account Number/Details</label>
                            <input type="text" class="form-control @error('pic_payment_method_2') is-invalid @enderror"
                                id="pic_payment_method_2" name="pic_payment_method_2" value="{{ old('pic_payment_method_2') }}"
                                placeholder="e.g., 1234567890">
                            @error('pic_payment_method_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contact_person_2" class="form-label">Contact Person</label>
                            <input type="text" class="form-control @error('contact_person_2') is-invalid @enderror"
                                id="contact_person_2" name="contact_person_2" value="{{ old('contact_person_2') }}"
                                placeholder="e.g., Jane Smith - 081234567890">
                            @error('contact_person_2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Payment Method 3 (Optional) -->
                    <div class="mb-4 p-4 border rounded" style="background-color: #d4edda;">
                        <h6 class="fw-bold mb-3 text-success">
                            <i class="fas fa-credit-card me-2"></i>Payment Method 3 (Optional)
                        </h6>

                        <div class="mb-3">
                            <label for="payment_method_3" class="form-label">Payment Method Name</label>
                            <input type="text" class="form-control @error('payment_method_3') is-invalid @enderror"
                                id="payment_method_3" name="payment_method_3" value="{{ old('payment_method_3') }}"
                                placeholder="e.g., Bank Transfer, E-Wallet">
                            @error('payment_method_3')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pic_payment_method_3" class="form-label">Account Number/Details</label>
                            <input type="text" class="form-control @error('pic_payment_method_3') is-invalid @enderror"
                                id="pic_payment_method_3" name="pic_payment_method_3" value="{{ old('pic_payment_method_3') }}"
                                placeholder="e.g., 1234567890">
                            @error('pic_payment_method_3')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contact_person_3" class="form-label">Contact Person</label>
                            <input type="text" class="form-control @error('contact_person_3') is-invalid @enderror"
                                id="contact_person_3" name="contact_person_3" value="{{ old('contact_person_3') }}"
                                placeholder="e.g., Bob Wilson - 081234567890">
                            @error('contact_person_3')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('donate.index') }}" class="btn btn-secondary me-md-2">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Donation Information
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

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
    }
</script>
@endpush