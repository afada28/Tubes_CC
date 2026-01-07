@extends('layouts.admin')

@section('page-title', 'Volunteer Program Details - ' . $volunteer->title)

@section('content')
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('volunteer.index') }}" class="text-decoration-none">
                            <i class="fas fa-hands-helping me-1"></i>Volunteer Management
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Program Details</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center mb-2">
                        <h1 class="h2 mb-0 fw-bold me-3">{{ $volunteer->title }}</h1>
                        <span class="badge fs-6 {{ $volunteer->status == 'active' ? 'bg-success' : ($volunteer->status == 'completed' ? 'bg-secondary' : 'bg-warning') }}">
                            <i class="fas fa-circle me-1"></i>{{ ucfirst($volunteer->status) }}
                        </span>
                    </div>
                    <p class="text-muted mb-3">
                        <i class="fas fa-calendar me-2"></i>{{ \Carbon\Carbon::parse($volunteer->date)->format('l, d F Y') }}
                        <span class="mx-2">•</span>
                        <i class="fas fa-user me-2"></i>{{ $volunteer->pic_1 }}
                        <span class="mx-2">•</span>
                        <i class="fas fa-users me-2"></i>{{ $volunteer->participants->count() }} Participants
                    </p>
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    @if($volunteer->participants->where('status', 'pending')->count() > 0)
                        <a href="{{ route('volunteer.participants', $volunteer->id) }}"
                           class="btn btn-warning position-relative">
                            <i class="fas fa-clock me-2"></i>Pending Applications
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $volunteer->participants->where('status', 'pending')->count() }}
                                <span class="visually-hidden">pending applications</span>
                            </span>
                        </a>
                    @endif

                    <a href="{{ route('volunteer.participants', $volunteer->id) }}"
                       class="btn btn-info">
                        <i class="fas fa-users me-2"></i>All Participants ({{ $volunteer->participants->count() }})
                    </a>

                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-cog me-1"></i>Actions
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('volunteer.edit', $volunteer->id) }}">
                                    <i class="fas fa-edit me-2"></i>Edit Program
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <button class="dropdown-item text-danger" type="button"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="fas fa-trash me-2"></i>Delete Program
                                </button>
                            </li>
                        </ul>
                    </div>

                    <a href="{{ route('volunteer.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert untuk pending applications -->
    @if($volunteer->participants->where('status', 'pending')->count() > 0)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle me-3 fs-4"></i>
                <div>
                    <strong>{{ $volunteer->participants->where('status', 'pending')->count() }} applications</strong> are waiting for your review.
                    <a href="{{ route('volunteer.participants', $volunteer->id) }}" class="alert-link">Review now</a>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Main Content -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <!-- Program Overview -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-gradient text-white" style="background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle me-2 fs-5"></i>
                        <h5 class="mb-0 fw-semibold">Program Overview</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <label class="small text-muted fw-semibold mb-1">Program Date</label>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-alt text-primary me-2"></i>
                                    <span class="fw-semibold">{{ \Carbon\Carbon::parse($volunteer->date)->format('l, d F Y') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <label class="small text-muted fw-semibold mb-1">Program Status</label>
                                <div class="d-flex align-items-center">
                                    <span class="badge me-2 {{ $volunteer->status == 'active' ? 'bg-success' : ($volunteer->status == 'completed' ? 'bg-secondary' : 'bg-warning') }}">
                                        <i class="fas fa-circle me-1"></i>{{ ucfirst($volunteer->status) }}
                                    </span>
                                    @if($volunteer->status == 'active')
                                        <small class="text-success">Currently accepting applications</small>
                                    @elseif($volunteer->status == 'completed')
                                        <small class="text-secondary">Program has ended</small>
                                    @else
                                        <small class="text-warning">Program is inactive</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="small text-muted fw-semibold mb-2 d-block">Program Description</label>
                        <div class="bg-light rounded p-3 border-start border-primary border-3">
                            {!! nl2br(e($volunteer->content)) !!}
                        </div>
                    </div>

                    @if($volunteer->link)
                    <div class="mb-3">
                        <label class="small text-muted fw-semibold mb-2 d-block">External Resources</label>
                        <a href="{{ $volunteer->link }}" target="_blank"
                           class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-external-link-alt me-2"></i>{{ $volunteer->link }}
                        </a>
                    </div>
                    @endif

                    <!-- Program Timeline -->
                    <div class="border-top pt-3 mt-4">
                        <label class="small text-muted fw-semibold mb-2 d-block">Program Timeline</label>
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="p-2">
                                    <i class="fas fa-plus-circle text-info fa-2x mb-2"></i>
                                    <div class="small text-muted">Created</div>
                                    <div class="fw-semibold">{{ $volunteer->created_at->format('d M Y') }}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-2">
                                    <i class="fas fa-play-circle text-success fa-2x mb-2"></i>
                                    <div class="small text-muted">Program Date</div>
                                    <div class="fw-semibold">{{ \Carbon\Carbon::parse($volunteer->date)->format('d M Y') }}</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-2">
                                    <i class="fas fa-edit text-warning fa-2x mb-2"></i>
                                    <div class="small text-muted">Last Updated</div>
                                    <div class="fw-semibold">{{ $volunteer->updated_at->format('d M Y') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Volunteer Requirements -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-list-check me-2 text-primary fs-5"></i>
                            <h5 class="mb-0 fw-semibold">Volunteer Requirements</h5>
                        </div>
                        @php
                            $specifications = [];
                            for($i = 1; $i <= 10; $i++) {
                                if($volunteer->{'specification_'.$i}) {
                                    $specifications[] = $volunteer->{'specification_'.$i};
                                }
                            }
                        @endphp
                        <span class="badge bg-primary">{{ count($specifications) }} Requirements</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    @if(count($specifications) > 0)
                        <div class="row">
                            @foreach($specifications as $index => $spec)
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0">
                                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                                 style="width: 32px; height: 32px;">
                                                <i class="fas fa-check text-success"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="small text-muted mb-1">Requirement {{ $index + 1 }}</div>
                                            <div class="fw-semibold">{{ $spec }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-info-circle text-muted fa-3x mb-3"></i>
                            <h5 class="text-muted">No Specific Requirements</h5>
                            <p class="text-muted mb-0">This volunteer program has no specific requirements listed.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Program Gallery -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-images me-2 text-primary fs-5"></i>
                            <h5 class="mb-0 fw-semibold">Program Gallery</h5>
                        </div>
                        @php
                            $photoCount = 0;
                            if($volunteer->photo_1) $photoCount++;
                            if($volunteer->photo_2) $photoCount++;
                            if($volunteer->photo_3) $photoCount++;
                        @endphp
                        <span class="badge bg-primary">{{ $photoCount }} Photos</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    @if($photoCount > 0)
                        <div class="row g-3">
                            @if($volunteer->photo_1)
                                <div class="col-lg-4 col-md-6">
                                    <div class="position-relative overflow-hidden rounded shadow-sm bg-light"
                                         style="height: 250px;">
                                        <img src="{{ asset('storage/' . $volunteer->photo_1) }}"
                                             alt="Program Photo 1"
                                             class="img-fluid w-100 h-100 object-fit-cover cursor-pointer hover-zoom"
                                             data-bs-toggle="modal"
                                             data-bs-target="#photoModal1"
                                             style="transition: transform 0.3s ease;">
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <span class="badge bg-dark bg-opacity-75 px-2 py-1">Photo 1</span>
                                        </div>
                                        <div class="position-absolute bottom-0 start-0 end-0 bg-gradient-dark p-2">
                                            <small class="text-white">Click to view full size</small>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($volunteer->photo_2)
                                <div class="col-lg-4 col-md-6">
                                    <div class="position-relative overflow-hidden rounded shadow-sm bg-light"
                                         style="height: 250px;">
                                        <img src="{{ asset('storage/' . $volunteer->photo_2) }}"
                                             alt="Program Photo 2"
                                             class="img-fluid w-100 h-100 object-fit-cover cursor-pointer hover-zoom"
                                             data-bs-toggle="modal"
                                             data-bs-target="#photoModal2"
                                             style="transition: transform 0.3s ease;">
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <span class="badge bg-dark bg-opacity-75 px-2 py-1">Photo 2</span>
                                        </div>
                                        <div class="position-absolute bottom-0 start-0 end-0 bg-gradient-dark p-2">
                                            <small class="text-white">Click to view full size</small>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($volunteer->photo_3)
                                <div class="col-lg-4 col-md-6">
                                    <div class="position-relative overflow-hidden rounded shadow-sm bg-light"
                                         style="height: 250px;">
                                        <img src="{{ asset('storage/' . $volunteer->photo_3) }}"
                                             alt="Program Photo 3"
                                             class="img-fluid w-100 h-100 object-fit-cover cursor-pointer hover-zoom"
                                             data-bs-toggle="modal"
                                             data-bs-target="#photoModal3"
                                             style="transition: transform 0.3s ease;">
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <span class="badge bg-dark bg-opacity-75 px-2 py-1">Photo 3</span>
                                        </div>
                                        <div class="position-absolute bottom-0 start-0 end-0 bg-gradient-dark p-2">
                                            <small class="text-white">Click to view full size</small>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-images text-muted fa-4x mb-3"></i>
                            <h5 class="text-muted">No Photos Available</h5>
                            <p class="text-muted mb-3">No photos have been uploaded for this volunteer program yet.</p>
                            <a href="{{ route('volunteer.edit', $volunteer->id) }}" class="btn btn-outline-primary">
                                <i class="fas fa-plus me-2"></i>Add Photos
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-xl-4 col-lg-5">
            <!-- Quick Stats -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-chart-pie me-2 text-primary"></i>Quick Statistics
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3 text-center">
                        <div class="col-6">
                            <div class="bg-primary bg-opacity-10 rounded p-3 border-2 border-primary border-opacity-25 border">
                                <div class="h3 mb-1 text-primary fw-bold">{{ $volunteer->participants->count() }}</div>
                                <div class="small text-muted fw-semibold">Total Applications</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-warning bg-opacity-10 rounded p-3 border-2 border-warning border-opacity-25 border">
                                <div class="h3 mb-1 text-warning fw-bold">{{ $volunteer->participants->where('status', 'pending')->count() }}</div>
                                <div class="small text-muted fw-semibold">Pending Review</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-success bg-opacity-10 rounded p-3 border-2 border-success border-opacity-25 border">
                                <div class="h3 mb-1 text-success fw-bold">{{ $volunteer->participants->where('status', 'accepted')->count() }}</div>
                                <div class="small text-muted fw-semibold">Accepted</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-danger bg-opacity-10 rounded p-3 border-2 border-danger border-opacity-25 border">
                                <div class="h3 mb-1 text-danger fw-bold">{{ $volunteer->participants->where('status', 'rejected')->count() }}</div>
                                <div class="small text-muted fw-semibold">Rejected</div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    @if($volunteer->participants->count() > 0)
                        <div class="mt-4">
                            <div class="d-flex justify-content-between small text-muted mb-2">
                                <span>Application Progress</span>
                                <span>{{ $volunteer->participants->where('status', '!=', 'pending')->count() }}/{{ $volunteer->participants->count() }} Processed</span>
                            </div>
                            @php
                                $processedPercentage = $volunteer->participants->count() > 0 ?
                                    ($volunteer->participants->where('status', '!=', 'pending')->count() / $volunteer->participants->count()) * 100 : 0;
                            @endphp
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-primary"
                                     role="progressbar"
                                     style="width: {{ $processedPercentage }}%"
                                     aria-valuenow="{{ $processedPercentage }}"
                                     aria-valuemin="0"
                                     aria-valuemax="100">
                                </div>
                            </div>
                            <div class="small text-muted mt-1">{{ number_format($processedPercentage, 1) }}% applications processed</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Contact Information -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-address-book me-2 text-primary"></i>Contact Information
                    </h5>
                </div>
                <div class="card-body p-4">
                    <!-- Primary Contact -->
                    <div class="border rounded p-3 mb-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div class="d-flex align-items-center text-white mb-2">
                            <i class="fas fa-star me-2"></i>
                            <h6 class="mb-0 fw-semibold">Primary Contact</h6>
                        </div>
                        <div class="text-white mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-user me-3" style="width: 20px;"></i>
                                <span class="fw-semibold">{{ $volunteer->pic_1 }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-phone me-3" style="width: 20px;"></i>
                                <span>{{ $volunteer->phonenumber_1 }}</span>
                            </div>
                        </div>
                        <a href="https://wa.me/{{ str_replace(['+', '-', ' ', '(', ')'], '', $volunteer->phonenumber_1) }}?text=Hello {{ $volunteer->pic_1 }}, I have a question about the {{ $volunteer->title }} volunteer program."
                           target="_blank"
                           class="btn btn-success btn-sm w-100">
                            <i class="fab fa-whatsapp me-2"></i>Contact via WhatsApp
                        </a>
                    </div>

                    <!-- Secondary Contact -->
                    @if($volunteer->pic_2 && $volunteer->phonenumber_2)
                        <div class="border rounded p-3 bg-light">
                            <div class="d-flex align-items-center text-muted mb-2">
                                <i class="fas fa-user-friends me-2"></i>
                                <h6 class="mb-0 fw-semibold text-dark">Secondary Contact</h6>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-user text-muted me-3" style="width: 20px;"></i>
                                    <span>{{ $volunteer->pic_2 }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-phone text-muted me-3" style="width: 20px;"></i>
                                    <span>{{ $volunteer->phonenumber_2 }}</span>
                                </div>
                            </div>
                            <a href="https://wa.me/{{ str_replace(['+', '-', ' ', '(', ')'], '', $volunteer->phonenumber_2) }}?text=Hello {{ $volunteer->pic_2 }}, I have a question about the {{ $volunteer->title }} volunteer program."
                               target="_blank"
                               class="btn btn-outline-success btn-sm w-100">
                                <i class="fab fa-whatsapp me-2"></i>Contact via WhatsApp
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Participants -->
            @if($volunteer->participants->count() > 0)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0 fw-semibold">
                            <i class="fas fa-users me-2 text-primary"></i>Recent Applications
                        </h5>
                        <a href="{{ route('volunteer.participants', $volunteer->id) }}"
                           class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                </div>
                <div class="card-body p-3">
                    @foreach($volunteer->participants->sortByDesc('created_at')->take(5) as $participant)
                        <div class="d-flex align-items-center py-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                            <div class="flex-shrink-0">
                                <div class="bg-{{ $participant->status == 'accepted' ? 'success' : ($participant->status == 'rejected' ? 'danger' : 'warning') }} bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                     style="width: 40px; height: 40px;">
                                    <i class="fas fa-user text-{{ $participant->status == 'accepted' ? 'success' : ($participant->status == 'rejected' ? 'danger' : 'warning') }}"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1 fw-semibold">{{ $participant->name }}</h6>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-{{ $participant->status == 'accepted' ? 'success' : ($participant->status == 'rejected' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($participant->status) }}
                                    </span>
                                    <small class="text-muted">{{ $participant->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="https://wa.me/{{ str_replace(['+', '-', ' ', '(', ')'], '', $participant->phonenumber) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-outline-success"
                                   data-bs-toggle="tooltip"
                                   title="Contact {{ $participant->name }}">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Program Metadata -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-info me-2 text-primary"></i>Program Information
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3 small">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted fw-semibold">Program ID</span>
                                <span class="badge bg-light text-dark">#VL{{ str_pad($volunteer->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted fw-semibold">Created Date</span>
                                <span>{{ $volunteer->created_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted fw-semibold">Last Updated</span>
                                <span>{{ $volunteer->updated_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center py-2">
                                <span class="text-muted fw-semibold">Days Since Created</span>
                                <span>{{ $volunteer->created_at->diffInDays() }} days</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Photo Modals -->
    @if($volunteer->photo_1)
    <div class="modal fade" id="photoModal1" tabindex="-1" aria-labelledby="photoModal1Label" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="photoModal1Label">
                        <i class="fas fa-image me-2"></i>{{ $volunteer->title }} - Photo 1
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-1">
                    <img src="{{ asset('storage/' . $volunteer->photo_1) }}"
                         alt="Program Photo 1"
                         class="img-fluid rounded"
                         style="max-height: 70vh; width: auto;">
                </div>
                <div class="modal-footer border-0">
                    <a href="{{ asset('storage/' . $volunteer->photo_1) }}"
                       download="volunteer_photo_1_{{ $volunteer->id }}.jpg"
                       class="btn btn-primary">
                        <i class="fas fa-download me-2"></i>Download
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($volunteer->photo_2)
    <div class="modal fade" id="photoModal2" tabindex="-1" aria-labelledby="photoModal2Label" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="photoModal2Label">
                        <i class="fas fa-image me-2"></i>{{ $volunteer->title }} - Photo 2
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-1">
                    <img src="{{ asset('storage/' . $volunteer->photo_2) }}"
                         alt="Program Photo 2"
                         class="img-fluid rounded"
                         style="max-height: 70vh; width: auto;">
                </div>
                <div class="modal-footer border-0">
                    <a href="{{ asset('storage/' . $volunteer->photo_2) }}"
                       download="volunteer_photo_2_{{ $volunteer->id }}.jpg"
                       class="btn btn-primary">
                        <i class="fas fa-download me-2"></i>Download
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($volunteer->photo_3)
    <div class="modal fade" id="photoModal3" tabindex="-1" aria-labelledby="photoModal3Label" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="photoModal3Label">
                        <i class="fas fa-image me-2"></i>{{ $volunteer->title }} - Photo 3
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-1">
                    <img src="{{ asset('storage/' . $volunteer->photo_3) }}"
                         alt="Program Photo 3"
                         class="img-fluid rounded"
                         style="max-height: 70vh; width: auto;">
                </div>
                <div class="modal-footer border-0">
                    <a href="{{ asset('storage/' . $volunteer->photo_3) }}"
                       download="volunteer_photo_3_{{ $volunteer->id }}.jpg"
                       class="btn btn-primary">
                        <i class="fas fa-download me-2"></i>Download
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Confirm Delete
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-trash-alt text-danger fa-3x mb-3"></i>
                        <h5>Delete Volunteer Program</h5>
                    </div>
                    <div class="alert alert-danger">
                        <strong>{{ $volunteer->title }}</strong>
                    </div>
                    <p>Are you sure you want to delete this volunteer program? This action will:</p>
                    <ul class="text-muted">
                        <li>Permanently delete the program information</li>
                        <li>Remove all associated participant applications ({{ $volunteer->participants->count() }} applications)</li>
                        <li>Delete all uploaded photos</li>
                    </ul>
                    <p class="text-danger fw-semibold mb-0">This action cannot be undone!</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <form action="{{ route('volunteer.destroy', $volunteer->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-2"></i>Delete Program
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Image hover zoom effect
    document.querySelectorAll('.hover-zoom').forEach(function(img) {
        img.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });

        img.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Auto dismiss alerts
    setTimeout(function() {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            if (alert.classList.contains('alert-dismissible')) {
                var bsAlert = new bootstrap.Alert(alert);
                // bsAlert.close();
            }
        });
    }, 10000); // Auto dismiss after 10 seconds
</script>
@endpush

@push('styles')
<style>
.cursor-pointer {
    cursor: pointer;
}

.hover-zoom {
    transition: transform 0.3s ease-in-out;
}

.bg-gradient-dark {
    background: linear-gradient(0deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0) 100%);
}

.object-fit-cover {
    object-fit: cover;
}

.card {
    border: none;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.card-header {
    border-radius: 12px 12px 0 0 !important;
}

.info-item label {
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.badge {
    font-weight: 500;
}

.progress {
    border-radius: 10px;
}

.progress-bar {
    border-radius: 10px;
}

/* Custom scrollbar for modals */
.modal-body {
    scrollbar-width: thin;
    scrollbar-color: #6c757d #f8f9fa;
}

.modal-body::-webkit-scrollbar {
    width: 6px;
}

.modal-body::-webkit-scrollbar-track {
    background: #f8f9fa;
    border-radius: 3px;
}

.modal-body::-webkit-scrollbar-thumb {
    background: #6c757d;
    border-radius: 3px;
}

.modal-body::-webkit-scrollbar-thumb:hover {
    background: #495057;
}

/* Animation for cards */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: fadeInUp 0.6s ease-out;
}

.card:nth-child(2) { animation-delay: 0.1s; }
.card:nth-child(3) { animation-delay: 0.2s; }
.card:nth-child(4) { animation-delay: 0.3s; }

/* Responsive improvements */
@media (max-width: 768px) {
    .card-body {
        padding: 1rem !important;
    }

    .btn-group .btn {
        font-size: 0.8rem;
    }

    .modal-dialog {
        margin: 1rem;
    }
}
</style>
@endpush