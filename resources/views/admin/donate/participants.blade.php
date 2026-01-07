@extends('layouts.admin')

@section('page-title', 'Donation Participants - ' . $infoDonation->title)

@section('content')
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item">
                                <a href="{{ route('donate.index') }}" class="text-decoration-none">
                                    <i class="fas fa-hand-holding-heart me-1"></i>Donation Management
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Participants</li>
                        </ol>
                    </nav>
                    <h2 class="mb-2 fw-bold">{{ $infoDonation->title }}</h2>
                    <p class="text-muted mb-0">
                        <i class="fas fa-users me-1"></i>
                        Manage and view donation participants
                    </p>
                </div>
                <div>
                    <a href="{{ route('donate.index') }}" class="btn btn-secondary px-4 py-2 shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2 fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white border-0 shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Total Target</h6>
                            <h4 class="mb-0">Rp {{ number_format($infoDonation->target, 0, ',', '.') }}</h4>
                        </div>
                        <div>
                            <i class="fas fa-bullseye fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white border-0 shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Total Terkumpul</h6>
                            <h4 class="mb-0">Rp {{ number_format($totalDonations, 0, ',', '.') }}</h4>
                        </div>
                        <div>
                            <i class="fas fa-coins fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white border-0 shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Total Donatur</h6>
                            <h4 class="mb-0">{{ $donations->total() }} Orang</h4>
                        </div>
                        <div>
                            <i class="fas fa-users fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white border-0 shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Progress</h6>
                            <h4 class="mb-0">{{ number_format($progressPercentage, 1) }}%</h4>
                        </div>
                        <div>
                            <i class="fas fa-chart-line fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Bar -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="fw-semibold">Campaign Progress</span>
                <span class="badge bg-{{ $progressPercentage >= 100 ? 'success' : 'primary' }}">
                    {{ number_format($progressPercentage, 1) }}% Complete
                </span>
            </div>
            <div class="progress" style="height: 12px;">
                <div class="progress-bar bg-{{ $progressPercentage >= 100 ? 'success' : 'primary' }}"
                     role="progressbar"
                     style="width: {{ min($progressPercentage, 100) }}%"
                     aria-valuenow="{{ $progressPercentage }}"
                     aria-valuemin="0"
                     aria-valuemax="100">
                </div>
            </div>
            <div class="d-flex justify-content-between mt-2 small text-muted">
                <span>Rp 0</span>
                <span>Rp {{ number_format($infoDonation->target, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Participants List -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-users me-2 text-primary"></i>Donation Participants
                </h5>
            </div>
        </div>
        <div class="card-body p-0">
            @forelse($donations as $donation)
                <div class="participant-item border-bottom p-4 hover-effect">
                    <div class="row align-items-center">
                        <!-- Participant Info -->
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    @if($donation->photo)
                                        <div class="position-relative photo-container">
                                            <img src="{{ asset('storage/' . $donation->photo) }}"
                                                 alt="Donation proof"
                                                 class="rounded-circle shadow-sm proof-thumbnail"
                                                 style="width: 50px; height: 50px; object-fit: cover;"
                                                 onclick="openImageViewer('{{ asset('storage/' . $donation->photo) }}', '{{ $donation->name }}', '{{ number_format($donation->donate, 0, ',', '.') }}', '{{ $donation->created_at->format('d M Y H:i') }}', '{{ $donation->message ?? '' }}')"
                                                 role="button">
                                            <span class="photo-badge">
                                                <i class="fas fa-search-plus"></i>
                                            </span>
                                        </div>
                                    @else
                                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 fw-semibold">{{ $donation->name }}</h6>
                                    <p class="text-muted mb-1 small">
                                        <i class="fas fa-map-marker-alt me-1"></i>
                                        {{ Str::limit($donation->address, 50) }}
                                    </p>
                                    <p class="text-muted mb-0 small">
                                        <i class="fas fa-phone me-1"></i>
                                        {{ $donation->phonenumber }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Donation Amount -->
                        <div class="col-lg-2 mb-3 mb-lg-0 text-center">
                            <div class="badge bg-success fs-6 px-3 py-2">
                                Rp {{ number_format($donation->donate, 0, ',', '.') }}
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            @if($donation->message)
                                <div class="message-box">
                                    <i class="fas fa-quote-left text-muted small"></i>
                                    <span class="fst-italic">{{ Str::limit($donation->message, 80) }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Date & Actions -->
                        <div class="col-lg-2 text-lg-end">
                            <div class="d-flex flex-column align-items-end gap-2">
                                <span class="badge bg-info">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $donation->created_at->format('d M Y') }}
                                </span>
                                <span class="text-muted small">
                                    {{ $donation->created_at->format('H:i') }}
                                </span>
                                @if($donation->photo)
                                    <button class="btn btn-sm btn-outline-primary"
                                            onclick="openImageViewer('{{ asset('storage/' . $donation->photo) }}', '{{ $donation->name }}', '{{ number_format($donation->donate, 0, ',', '.') }}', '{{ $donation->created_at->format('d M Y H:i') }}', '{{ $donation->message ?? '' }}')">
                                        <i class="fas fa-eye me-1"></i>View Proof
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-users fa-4x text-muted opacity-50"></i>
                    </div>
                    <h4 class="text-muted mb-2">No Participants Yet</h4>
                    <p class="text-muted mb-4">This donation program hasn't received any participants yet.</p>
                </div>
            @endforelse
        </div>

        @if($donations->hasPages())
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing {{ $donations->firstItem() }} to {{ $donations->lastItem() }} of {{ $donations->total() }} participants
                    </div>
                    <div>
                        {{ $donations->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Enhanced Image Viewer Overlay -->
    <div id="imageViewerOverlay" class="image-viewer-overlay" onclick="closeImageViewer()">
        <div class="image-viewer-container" onclick="event.stopPropagation()">
            <button class="viewer-close-btn" onclick="closeImageViewer()">
                <i class="fas fa-times"></i>
            </button>

            <div class="viewer-content">
                <div class="viewer-image-wrapper">
                    <img id="viewerImage" src="" alt="Donation proof" class="viewer-image">
                    <div class="viewer-controls">
                        <button onclick="zoomIn()" class="control-btn" title="Zoom In">
                            <i class="fas fa-search-plus"></i>
                        </button>
                        <button onclick="zoomOut()" class="control-btn" title="Zoom Out">
                            <i class="fas fa-search-minus"></i>
                        </button>
                        <button onclick="resetZoom()" class="control-btn" title="Reset">
                            <i class="fas fa-redo"></i>
                        </button>
                        <button onclick="downloadImage()" class="control-btn" title="Download">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>

                <div class="viewer-info">
                    <div class="info-card">
                        <h5 class="info-title">
                            <i class="fas fa-user-circle me-2"></i>
                            <span id="viewerName"></span>
                        </h5>
                        <div class="info-details">
                            <div class="info-item">
                                <i class="fas fa-money-bill-wave text-success"></i>
                                <div>
                                    <small class="text-muted d-block">Amount</small>
                                    <strong>Rp <span id="viewerAmount"></span></strong>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-calendar-alt text-info"></i>
                                <div>
                                    <small class="text-muted d-block">Date</small>
                                    <strong id="viewerDate"></strong>
                                </div>
                            </div>
                        </div>
                        <div id="viewerMessageContainer" class="message-container" style="display: none;">
                            <hr>
                            <div class="d-flex align-items-start gap-2">
                                <i class="fas fa-comment-dots text-primary mt-1"></i>
                                <div>
                                    <small class="text-muted d-block mb-1">Message</small>
                                    <p class="mb-0 fst-italic" id="viewerMessage"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    let currentZoom = 1;
    let currentImageSrc = '';

    function openImageViewer(imageSrc, name, amount, date, message) {
        currentImageSrc = imageSrc;
        currentZoom = 1;

        document.getElementById('viewerImage').src = imageSrc;
        document.getElementById('viewerName').textContent = name;
        document.getElementById('viewerAmount').textContent = amount;
        document.getElementById('viewerDate').textContent = date;

        const messageContainer = document.getElementById('viewerMessageContainer');
        const messageElement = document.getElementById('viewerMessage');

        if (message) {
            messageElement.textContent = message;
            messageContainer.style.display = 'block';
        } else {
            messageContainer.style.display = 'none';
        }

        document.getElementById('imageViewerOverlay').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeImageViewer() {
        document.getElementById('imageViewerOverlay').classList.remove('active');
        document.body.style.overflow = '';
        resetZoom();
    }

    function zoomIn() {
        currentZoom = Math.min(currentZoom + 0.2, 3);
        applyZoom();
    }

    function zoomOut() {
        currentZoom = Math.max(currentZoom - 0.2, 0.5);
        applyZoom();
    }

    function resetZoom() {
        currentZoom = 1;
        applyZoom();
    }

    function applyZoom() {
        const img = document.getElementById('viewerImage');
        img.style.transform = `scale(${currentZoom})`;
    }

    function downloadImage() {
        const link = document.createElement('a');
        link.href = currentImageSrc;
        link.download = 'donation_proof_' + Date.now() + '.jpg';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        const overlay = document.getElementById('imageViewerOverlay');
        if (overlay.classList.contains('active')) {
            if (e.key === 'Escape') closeImageViewer();
            if (e.key === '+' || e.key === '=') zoomIn();
            if (e.key === '-') zoomOut();
            if (e.key === '0') resetZoom();
        }
    });

    function exportParticipants() {
        const participants = @json($donations->items());
        let csvContent = "data:text/csv;charset=utf-8,";
        csvContent += "Name,Phone,Address,Amount,Message,Date\n";

        participants.forEach(function(participant) {
            const row = [
                participant.name,
                participant.phonenumber,
                participant.address.replace(/,/g, ';'),
                participant.donate,
                (participant.message || '').replace(/,/g, ';'),
                participant.created_at
            ].join(",");
            csvContent += row + "\n";
        });

        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "donation_participants_{{ Str::slug($infoDonation->title) }}.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>
@endpush

<style>
/* Existing Styles */
.hover-effect {
    transition: all 0.3s ease;
}

.hover-effect:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

.participant-item:last-child {
    border-bottom: none !important;
}

.card {
    border: none;
    border-radius: 12px;
}

.card-header {
    border-radius: 12px 12px 0 0 !important;
}

/* Photo Thumbnail Enhancement */
.photo-container {
    position: relative;
    cursor: pointer;
}

.proof-thumbnail {
    transition: all 0.3s ease;
    cursor: pointer;
}

.proof-thumbnail:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2) !important;
}

.photo-badge {
    position: absolute;
    bottom: -5px;
    right: -5px;
    background: #0d6efd;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.photo-container:hover .photo-badge {
    opacity: 1;
}

/* Message Box */
.message-box {
    background: #f8f9fa;
    padding: 8px 12px;
    border-radius: 8px;
    border-left: 3px solid #0d6efd;
}

/* Image Viewer Overlay */
.image-viewer-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.95);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.image-viewer-overlay.active {
    opacity: 1;
    visibility: visible;
}

.image-viewer-container {
    width: 95%;
    max-width: 1400px;
    height: 90vh;
    background: white;
    border-radius: 16px;
    position: relative;
    display: flex;
    overflow: hidden;
    animation: slideUp 0.4s ease;
}

@keyframes slideUp {
    from {
        transform: translateY(50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.viewer-close-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.9);
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.viewer-close-btn:hover {
    background: #dc3545;
    color: white;
    transform: rotate(90deg);
}

.viewer-content {
    display: flex;
    width: 100%;
    height: 100%;
}

.viewer-image-wrapper {
    flex: 1;
    background: #1a1a1a;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: auto;
    padding: 20px;
}

.viewer-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    border-radius: 8px;
    transition: transform 0.3s ease;
    cursor: zoom-in;
}

.viewer-controls {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(255, 255, 255, 0.95);
    padding: 8px;
    border-radius: 30px;
    display: flex;
    gap: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.control-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    background: white;
    color: #333;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.control-btn:hover {
    background: #0d6efd;
    color: white;
    transform: scale(1.1);
}

.viewer-info {
    width: 350px;
    background: #f8f9fa;
    padding: 30px;
    overflow-y: auto;
    border-left: 1px solid #dee2e6;
}

.info-card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.info-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: #212529;
    display: flex;
    align-items: center;
}

.info-details {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px;
    background: #f8f9fa;
    border-radius: 8px;
}

.info-item i {
    font-size: 1.5rem;
    margin-top: 4px;
}

.message-container {
    margin-top: 15px;
}

.message-container hr {
    margin: 15px 0;
}

/* Responsive Design */
@media (max-width: 992px) {
    .viewer-content {
        flex-direction: column;
    }

    .viewer-info {
        width: 100%;
        max-height: 40%;
        border-left: none;
        border-top: 1px solid #dee2e6;
    }

    .viewer-image-wrapper {
        height: 60%;
    }
}

@media (max-width: 576px) {
    .image-viewer-container {
        width: 100%;
        height: 100vh;
        border-radius: 0;
    }

    .viewer-controls {
        padding: 6px;
        gap: 6px;
    }

    .control-btn {
        width: 35px;
        height: 35px;
    }
}
</style>