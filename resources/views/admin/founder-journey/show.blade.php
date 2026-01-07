@extends('layouts.admin')

@section('page-title', 'Journey Details')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route('journey-founder.index') }}" class="btn btn-outline-secondary mb-3">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>

        <div class="card shadow-sm border-0">
            <!-- Header with Image Background -->
            <div class="position-relative">
                <div class="journey-header rounded-top"
                     style="height: 200px; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                            url('{{ asset('storage/' . $journeyItems->photo_1) }}') no-repeat center center;
                            background-size: cover;">
                </div>
                <div class="position-absolute bottom-0 start-0 p-4 text-white">
                    <h3 class="fw-bold mb-0">{{ $journeyItems->title }}</h3>
                    <div class="mt-2">
                        @if($journeyItems->date_start || $journeyItems->date_end)
                            <span class="me-3">
                                <i class="fas fa-calendar-alt me-1"></i>
                                @if($journeyItems->date_start && $journeyItems->date_end)
                                    {{ $journeyItems->date_start }} - {{ $journeyItems->date_end }}
                                @elseif($journeyItems->date_start)
                                    From {{ $journeyItems->date_start }}
                                @else
                                    Until {{ $journeyItems->date_end }}
                                @endif
                            </span>
                        @endif

                        @if($journeyItems->location)
                            <span>
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ $journeyItems->location }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons Overlay -->
                <div class="position-absolute top-0 end-0 p-3">
                    <div class="btn-group">
                        <a href="{{ route('journey-founder.edit', $journeyItems->id) }}" class="btn btn-sm btn-light shadow-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <button type="button" class="btn btn-sm btn-danger shadow-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <!-- Content Section -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h5 class="border-bottom pb-2 mb-3 text-primary">
                            <i class="fas fa-align-left me-2"></i>Journey Description
                        </h5>
                        <div class="journey-content">
                            {!! nl2br(e($journeyItems->content)) !!}
                        </div>
                    </div>
                </div>

                <!-- Photo Gallery Section -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h5 class="border-bottom pb-2 mb-4 text-primary">
                            <i class="fas fa-images me-2"></i>Photo Gallery
                        </h5>

                        <div class="row g-3">
                            <!-- Main Photo -->
                            <div class="col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="ratio ratio-4x3">
                                        <img src="{{ asset('storage/' . $journeyItems->photo_1) }}"
                                             class="card-img-top rounded-top"
                                             alt="Main Photo">
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title">Primary Photo</h6>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Photos -->
                            @if($journeyItems->photo_2)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="ratio ratio-4x3">
                                            <img src="{{ asset('storage/' . $journeyItems->photo_2) }}"
                                                 class="card-img-top rounded-top"
                                                 alt="Additional Photo 1">
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title">Additional Photo 1</h6>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($journeyItems->photo_3)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="ratio ratio-4x3">
                                            <img src="{{ asset('storage/' . $journeyItems->photo_3) }}"
                                                 class="card-img-top rounded-top"
                                                 alt="Additional Photo 2">
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title">Additional Photo 2</h6>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($journeyItems->photo_4)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="ratio ratio-4x3">
                                            <img src="{{ asset('storage/' . $journeyItems->photo_4) }}"
                                                 class="card-img-top rounded-top"
                                                 alt="Additional Photo 3">
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title">Additional Photo 3</h6>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($journeyItems->photo_5)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="ratio ratio-4x3">
                                            <img src="{{ asset('storage/' . $journeyItems->photo_5) }}"
                                                 class="card-img-top rounded-top"
                                                 alt="Additional Photo 4">
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title">Additional Photo 4</h6>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($journeyItems->photo_6)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="ratio ratio-4x3">
                                            <img src="{{ asset('storage/' . $journeyItems->photo_6) }}"
                                                 class="card-img-top rounded-top"
                                                 alt="Additional Photo 5">
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title">Additional Photo 5</h6>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Show More Photos button if there are more photos -->
                            @if($journeyItems->photo_7 || $journeyItems->photo_8 || $journeyItems->photo_9 || $journeyItems->photo_10)
                                <div class="col-12 mt-3">
                                    <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#morePhotos">
                                        <i class="fas fa-plus-circle me-2"></i>Show More Photos
                                    </button>

                                    <div class="collapse mt-3" id="morePhotos">
                                        <div class="row g-3">
                                            @if($journeyItems->photo_7)
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="card border-0 shadow-sm h-100">
                                                        <div class="ratio ratio-4x3">
                                                            <img src="{{ asset('storage/' . $journeyItems->photo_7) }}"
                                                                 class="card-img-top rounded-top"
                                                                 alt="Additional Photo 6">
                                                        </div>
                                                        <div class="card-body">
                                                            <h6 class="card-title">Additional Photo 6</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($journeyItems->photo_8)
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="card border-0 shadow-sm h-100">
                                                        <div class="ratio ratio-4x3">
                                                            <img src="{{ asset('storage/' . $journeyItems->photo_8) }}"
                                                                 class="card-img-top rounded-top"
                                                                 alt="Additional Photo 7">
                                                        </div>
                                                        <div class="card-body">
                                                            <h6 class="card-title">Additional Photo 7</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($journeyItems->photo_9)
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="card border-0 shadow-sm h-100">
                                                        <div class="ratio ratio-4x3">
                                                            <img src="{{ asset('storage/' . $journeyItems->photo_9) }}"
                                                                 class="card-img-top rounded-top"
                                                                 alt="Additional Photo 8">
                                                        </div>
                                                        <div class="card-body">
                                                            <h6 class="card-title">Additional Photo 8</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($journeyItems->photo_10)
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="card border-0 shadow-sm h-100">
                                                        <div class="ratio ratio-4x3">
                                                            <img src="{{ asset('storage/' . $journeyItems->photo_10) }}"
                                                                 class="card-img-top rounded-top"
                                                                 alt="Additional Photo 9">
                                                        </div>
                                                        <div class="card-body">
                                                            <h6 class="card-title">Additional Photo 9</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Metadata Section -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card bg-light border-0">
                            <div class="card-body">
                                <h6 class="card-title text-muted">Metadata</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <small class="text-muted d-block mb-2">
                                            <i class="fas fa-calendar-plus me-1"></i> Created:
                                            <span class="fw-semibold">{{ $journeyItems->created_at->format('F j, Y, g:i a') }}</span>
                                        </small>
                                        <small class="text-muted d-block">
                                            <i class="fas fa-sync me-1"></i> Last Updated:
                                            <span class="fw-semibold">{{ $journeyItems->updated_at->format('F j, Y, g:i a') }}</span>
                                        </small>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted d-block mb-2">
                                            <i class="fas fa-fingerprint me-1"></i> ID:
                                            <span class="fw-semibold">{{ $journeyItems->id }}</span>
                                        </small>
                                    </div>
                                </div>
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
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                    Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this journey item?</p>
                <div class="alert alert-warning">
                    <strong>{{ $journeyItems->title }}</strong>
                    @if($journeyItems->date_start || $journeyItems->date_end)
                        <small class="d-block mt-1">
                            @if($journeyItems->date_start && $journeyItems->date_end)
                                {{ $journeyItems->date_start }} - {{ $journeyItems->date_end }}
                            @elseif($journeyItems->date_start)
                                From {{ $journeyItems->date_start }}
                            @else
                                Until {{ $journeyItems->date_end }}
                            @endif
                        </small>
                    @endif
                </div>
                <p class="text-danger mb-0"><strong>Warning:</strong> This action will permanently delete this item and all associated photos.</p>
                <p class="text-muted small mb-0">This action cannot be undone.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('journey-founder.destroy', $journeyItems->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Delete Permanently
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .journey-content {
        line-height: 1.6;
    }

    .card-img-top {
        object-fit: cover;
    }
</style>
@endpush