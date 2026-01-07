@extends('layouts.admin')

@section('page-title', 'Milestone Details')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <a href="{{ route('milestone.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
                <div class="btn-group">
                    <a href="{{ route('milestone.edit', $milestoneItems->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="fas fa-trash me-2"></i>Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Photo Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">
                        <i class="fas fa-image me-2 text-primary"></i>Milestone Photo
                    </h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('storage/' . $milestoneItems->photo) }}"
                         alt="Milestone Photo"
                         class="img-fluid rounded shadow-sm"
                         style="max-height: 400px; object-fit: cover;">
                </div>
            </div>

            <!-- Timeline 1 -->
            <div class="card shadow-sm mb-4" style="border-left: 4px solid #0d6efd;">
                <div class="card-header" style="background-color: #f8f9fa;">
                    <h5 class="mb-0 text-primary">
                        <i class="fas fa-flag-checkered me-2"></i>Timeline 1
                    </h5>
                </div>
                <div class="card-body">
                    <h6 class="fw-bold mb-2">{{ $milestoneItems->timeline_title_1 }}</h6>
                    <p class="text-muted mb-0" style="white-space: pre-line;">{{ $milestoneItems->timeline_content_1 }}</p>
                </div>
            </div>

            <!-- Timeline 2 -->
            <div class="card shadow-sm mb-4" style="border-left: 4px solid #198754;">
                <div class="card-header" style="background-color: #f0f8f0;">
                    <h5 class="mb-0 text-success">
                        <i class="fas fa-flag-checkered me-2"></i>Timeline 2
                    </h5>
                </div>
                <div class="card-body">
                    <h6 class="fw-bold mb-2">{{ $milestoneItems->timeline_title_2 }}</h6>
                    <p class="text-muted mb-0" style="white-space: pre-line;">{{ $milestoneItems->timeline_content_2 }}</p>
                </div>
            </div>

            <!-- Timeline 3 -->
            <div class="card shadow-sm mb-4" style="border-left: 4px solid #0dcaf0;">
                <div class="card-header" style="background-color: #f0f8ff;">
                    <h5 class="mb-0 text-info">
                        <i class="fas fa-flag-checkered me-2"></i>Timeline 3
                    </h5>
                </div>
                <div class="card-body">
                    <h6 class="fw-bold mb-2">{{ $milestoneItems->timeline_title_3 }}</h6>
                    <p class="text-muted mb-0" style="white-space: pre-line;">{{ $milestoneItems->timeline_content_3 }}</p>
                </div>
            </div>

            <!-- Timeline 4 -->
            <div class="card shadow-sm mb-4" style="border-left: 4px solid #ffc107;">
                <div class="card-header" style="background-color: #fff8f0;">
                    <h5 class="mb-0 text-warning">
                        <i class="fas fa-flag-checkered me-2"></i>Timeline 4
                    </h5>
                </div>
                <div class="card-body">
                    <h6 class="fw-bold mb-2">{{ $milestoneItems->timeline_title_4 }}</h6>
                    <p class="text-muted mb-0" style="white-space: pre-line;">{{ $milestoneItems->timeline_content_4 }}</p>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Information Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2 text-primary"></i>Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-muted d-block mb-1">
                            <i class="fas fa-hashtag me-1"></i>Milestone ID
                        </small>
                        <span class="fw-bold">#{{ $milestoneItems->id }}</span>
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-muted d-block mb-1">
                            <i class="fas fa-calendar-plus me-1"></i>Created At
                        </small>
                        <span class="fw-bold">{{ $milestoneItems->created_at->format('d M Y, H:i') }}</span>
                        <br>
                        <small class="text-muted">{{ $milestoneItems->created_at->diffForHumans() }}</small>
                    </div>

                    <div class="mb-0">
                        <small class="text-muted d-block mb-1">
                            <i class="fas fa-sync me-1"></i>Last Updated
                        </small>
                        <span class="fw-bold">{{ $milestoneItems->updated_at->format('d M Y, H:i') }}</span>
                        <br>
                        <small class="text-muted">{{ $milestoneItems->updated_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt me-2 text-warning"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('milestone.edit', $milestoneItems->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit Milestone
                        </a>
                        <a href="{{ route('milestone.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle me-2"></i>Add New Milestone
                        </a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash me-2"></i>Delete Milestone
                        </button>
                    </div>
                </div>
            </div>

            <!-- Timeline Summary Card -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">
                        <i class="fas fa-list-alt me-2 text-success"></i>Timeline Summary
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="fas fa-flag-checkered text-primary"></i>
                            </div>
                            <small class="text-muted">Timeline 1</small>
                        </div>
                        <p class="mb-0 small fw-semibold">{{ Str::limit($milestoneItems->timeline_title_1, 40) }}</p>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-success bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="fas fa-flag-checkered text-success"></i>
                            </div>
                            <small class="text-muted">Timeline 2</small>
                        </div>
                        <p class="mb-0 small fw-semibold">{{ Str::limit($milestoneItems->timeline_title_2, 40) }}</p>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-info bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="fas fa-flag-checkered text-info"></i>
                            </div>
                            <small class="text-muted">Timeline 3</small>
                        </div>
                        <p class="mb-0 small fw-semibold">{{ Str::limit($milestoneItems->timeline_title_3, 40) }}</p>
                    </div>

                    <div class="mb-0">
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-2">
                                <i class="fas fa-flag-checkered text-warning"></i>
                            </div>
                            <small class="text-muted">Timeline 4</small>
                        </div>
                        <p class="mb-0 small fw-semibold">{{ Str::limit($milestoneItems->timeline_title_4, 40) }}</p>
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
                    <p>Are you sure you want to delete this milestone item?</p>
                    <div class="alert alert-warning mb-3">
                        <strong>Timeline 1:</strong> {{ $milestoneItems->timeline_title_1 }}
                    </div>
                    <p class="text-danger mb-0">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        This action cannot be undone.
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('milestone.destroy', $milestoneItems->id) }}" method="POST" class="d-inline">
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