@extends('layouts.admin')

@section('page-title', 'Donation Information Details')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route('donate.index') }}" class="btn btn-outline-secondary mb-3">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-eye me-2"></i>Donation Information Details
                    </h5>
                    <div>
                        <a href="{{ route('donate.edit', $infoDonation->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <!-- Basic Information -->
                <div class="mb-4">
                    <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">
                        <i class="fas fa-info-circle me-2"></i>Basic Information
                    </h6>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="text-muted small mb-1">Title</label>
                            <h5 class="fw-semibold">{{ $infoDonation->title }}</h5>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="text-muted small mb-1">Content</label>
                            <p class="mb-0">{{ $infoDonation->content }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="text-muted small mb-1">Start Date</label>
                            <p class="mb-0">
                                <span class="badge bg-success">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    {{ $infoDonation->start_date->format('d F Y') }}
                                </span>
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="text-muted small mb-1">End Date</label>
                            <p class="mb-0">
                                <span class="badge bg-danger">
                                    <i class="fas fa-calendar-times me-1"></i>
                                    {{ $infoDonation->end_date->format('d F Y') }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Payment Method 1 -->
                <div class="mb-4 p-3 rounded" style="background-color: #fff3cd;">
                    <h6 class="fw-bold text-warning border-bottom pb-2 mb-3">
                        <i class="fas fa-credit-card me-2"></i>Payment Method 1
                    </h6>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="text-muted small mb-1">Payment Method</label>
                            <p class="fw-semibold mb-0">{{ $infoDonation->payment_method_1 }}</p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="text-muted small mb-1">Account Number/Details</label>
                            <p class="fw-semibold mb-0">{{ $infoDonation->pic_payment_method_1 }}</p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="text-muted small mb-1">Contact Person</label>
                            <p class="fw-semibold mb-0">{{ $infoDonation->contact_person_1 }}</p>
                        </div>

                        @if($infoDonation->photo_1)
                            <div class="col-md-12">
                                <label class="text-muted small mb-1">Photo</label>
                                <div>
                                    <img src="{{ asset('storage/' . $infoDonation->photo_1) }}"
                                         class="rounded shadow-sm img-fluid"
                                         style="max-width: 300px; max-height: 300px;">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Payment Method 2 -->
                @if($infoDonation->payment_method_2)
                    <div class="mb-4 p-3 rounded" style="background-color: #d1ecf1;">
                        <h6 class="fw-bold text-info border-bottom pb-2 mb-3">
                            <i class="fas fa-credit-card me-2"></i>Payment Method 2
                        </h6>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="text-muted small mb-1">Payment Method</label>
                                <p class="fw-semibold mb-0">{{ $infoDonation->payment_method_2 }}</p>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="text-muted small mb-1">Account Number/Details</label>
                                <p class="fw-semibold mb-0">{{ $infoDonation->pic_payment_method_2 ?? '-' }}</p>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="text-muted small mb-1">Contact Person</label>
                                <p class="fw-semibold mb-0">{{ $infoDonation->contact_person_2 ?? '-' }}</p>
                            </div>

                            @if($infoDonation->photo_2)
                                <div class="col-md-12">
                                    <label class="text-muted small mb-1">Photo</label>
                                    <div>
                                        <img src="{{ asset('storage/' . $infoDonation->photo_2) }}"
                                             class="rounded shadow-sm img-fluid"
                                             style="max-width: 300px; max-height: 300px;">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Payment Method 3 -->
                @if($infoDonation->payment_method_3)
                    <div class="mb-4 p-3 rounded" style="background-color: #d4edda;">
                        <h6 class="fw-bold text-success border-bottom pb-2 mb-3">
                            <i class="fas fa-credit-card me-2"></i>Payment Method 3
                        </h6>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="text-muted small mb-1">Payment Method</label>
                                <p class="fw-semibold mb-0">{{ $infoDonation->payment_method_3 }}</p>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="text-muted small mb-1">Account Number/Details</label>
                                <p class="fw-semibold mb-0">{{ $infoDonation->pic_payment_method_3 ?? '-' }}</p>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="text-muted small mb-1">Contact Person</label>
                                <p class="fw-semibold mb-0">{{ $infoDonation->contact_person_3 ?? '-' }}</p>
                            </div>

                            @if($infoDonation->photo_3)
                                <div class="col-md-12">
                                    <label class="text-muted small mb-1">Photo</label>
                                    <div>
                                        <img src="{{ asset('storage/' . $infoDonation->photo_3) }}"
                                             class="rounded shadow-sm img-fluid"
                                             style="max-width: 300px; max-height: 300px;">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Related Donations -->
                @if($infoDonation->donations->count() > 0)
                    <div class="mb-4">
                        <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">
                            <i class="fas fa-list me-2"></i>Related Donations ({{ $infoDonation->donations->count() }})
                        </h6>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Donor Name</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($infoDonation->donations as $donation)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $donation->donor_name ?? 'Anonymous' }}</td>
                                            <td>Rp {{ number_format($donation->amount ?? 0, 0, ',', '.') }}</td>
                                            <td>{{ $donation->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <!-- Metadata -->
                <div class="mb-3">
                    <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">
                        <i class="fas fa-clock me-2"></i>Metadata
                    </h6>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <small class="text-muted">
                                <i class="fas fa-calendar-plus me-1"></i>
                                Created: {{ $infoDonation->created_at->format('d F Y, H:i') }}
                                ({{ $infoDonation->created_at->diffForHumans() }})
                            </small>
                        </div>

                        <div class="col-md-6 mb-2">
                            <small class="text-muted">
                                <i class="fas fa-sync me-1"></i>
                                Last Updated: {{ $infoDonation->updated_at->format('d F Y, H:i') }}
                                ({{ $infoDonation->updated_at->diffForHumans() }})
                            </small>
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
                <p>Are you sure you want to delete this donation information?</p>
                <div class="alert alert-warning">
                    <strong>{{ $infoDonation->title }}</strong>
                </div>
                <p class="text-muted small mb-0">This action cannot be undone and will also delete all related donations.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('donate.destroy', $infoDonation->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection