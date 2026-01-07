@extends('layouts.admin')

@section('page-title', 'Add Milestone Item')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('milestone.index') }}" class="btn btn-outline-secondary mb-3">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Add New Milestone Item</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('milestone.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- First Slide -->
                        <div class="mb-4 p-4 border rounded" style="background-color: #f8f9fa;">
                            <div class="mb-3">
                                <label for="timeline_title_1" class="form-label">Milestone Tittle 1</label>
                                <input type="text" class="form-control @error('timeline_title_1') is-invalid @enderror"
                                    id="timeline_title_1" name="timeline_title_1" value="{{ old('timeline_title_1') }}">
                                @error('timeline_title_1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="timeline_content_1" class="form-label">Milestone Content 1</label>
                                <textarea type="text" class="form-control @error('timeline_content_1') is-invalid @enderror" id="timeline_content_1"
                                    name="timeline_content_1">{{ old('timeline_content_1') }}</textarea>
                                @error('timeline_content_1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="timeline_title_2" class="form-label">Milestone Tittle 2</label>
                                <input type="text" class="form-control @error('timeline_title_2') is-invalid @enderror"
                                    id="timeline_title_2" name="timeline_title_2" value="{{ old('timeline_title_2') }}">
                                @error('timeline_title_2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="timeline_content_2" class="form-label">Milestone Content 2</label>
                                <textarea type="text" class="form-control @error('timeline_content_2') is-invalid @enderror" id="timeline_content_2"
                                    name="timeline_content_2">{{ old('timeline_content_2') }}</textarea>
                                @error('timeline_content_2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="timeline_title_3" class="form-label">Milestone Tittle 3</label>
                                <input type="text" class="form-control @error('timeline_title_3') is-invalid @enderror"
                                    id="timeline_title_3" name="timeline_title_3" value="{{ old('timeline_title_3') }}">
                                @error('timeline_title_3')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="timeline_content_3" class="form-label">Milestone Content 3</label>
                                <textarea type="text" class="form-control @error('timeline_content_3') is-invalid @enderror" id="timeline_content_3"
                                    name="timeline_content_3">{{ old('timeline_content_3') }}</textarea>
                                @error('timeline_content_3')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="timeline_title_4" class="form-label">Milestone Tittle 4</label>
                                <input type="text" class="form-control @error('timeline_title_4') is-invalid @enderror"
                                    id="timeline_title_4" name="timeline_title_4" value="{{ old('timeline_title_4') }}">
                                @error('timeline_title_4')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="timeline_content_4" class="form-label">Milestone Content 4</label>
                                <textarea type="text" class="form-control @error('timeline_content_4') is-invalid @enderror" id="timeline_content_4"
                                    name="timeline_content_4">{{ old('timeline_content_4') }}</textarea>
                                @error('timeline_content_4')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="photo" class="form-label">Photo</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                    id="photo" name="photo" accept="image/*"
                                    onchange="previewImage(this, 'image_preview_1')">
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="image_preview_1" class="image-preview mt-2" style="display: none;"></div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('milestone.index') }}" class="btn btn-secondary me-md-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Milestone Item</button>
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
