@extends('layouts.admin')

@section('page-title', 'Volunteer Participants - ' . $volunteer->title)

@section('content')
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('volunteer.index') }}">Volunteer Management</a></li>
                    <li class="breadcrumb-item active">Participants</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="mb-2 fw-bold">{{ $volunteer->title }}</h2>
                    <p class="text-muted mb-0">
                        <i class="fas fa-users me-1"></i>
                        Manage volunteer participants and their applications
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('volunteer.index') }}" class="btn btn-outline-secondary px-3 py-2">
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

    <!-- Program Info Card -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h6 class="fw-semibold mb-2">Program Information</h6>
                    <p class="text-muted mb-2">{{ Str::limit($volunteer->content, 200) }}</p>
                    <div class="d-flex gap-3 small text-muted flex-wrap">
                        <span><i class="fas fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($volunteer->date)->format('d M Y') }}</span>
                        <span><i class="fas fa-user me-1"></i>{{ $volunteer->pic_1 }}</span>
                        <span><i class="fas fa-phone me-1"></i>{{ $volunteer->phonenumber_1 }}</span>
                        <span><i class="fas fa-circle me-1"></i>{{ ucfirst($volunteer->status) }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row text-center">
                        <div class="col-3">
                            <div class="small text-muted">Total</div>
                            <div class="h5 mb-0 text-primary">{{ $totalParticipants }}</div>
                        </div>
                        <div class="col-3">
                            <div class="small text-muted">Pending</div>
                            <div class="h5 mb-0 text-warning">{{ $pendingCount }}</div>
                        </div>
                        <div class="col-3">
                            <div class="small text-muted">Accepted</div>
                            <div class="h5 mb-0 text-success">{{ $acceptedCount }}</div>
                        </div>
                        <div class="col-3">
                            <div class="small text-muted">Rejected</div>
                            <div class="h5 mb-0 text-danger">{{ $rejectedCount }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Participants List -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-table me-2 text-primary"></i>Participants List
                </h5>
                <span class="badge bg-primary">{{ $participants->total() }} Applications</span>
            </div>
        </div>
        <div class="card-body p-0">
            @forelse($participants as $participant)
                <div class="participant-item border-bottom p-4 hover-effect">
                    <div class="row align-items-center">
                        <!-- Participant Info -->
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="bg-{{ $participant->status == 'accepted' ? 'success' : ($participant->status == 'rejected' ? 'danger' : 'warning') }} bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 45px; height: 45px;">
                                        <i class="fas fa-user text-{{ $participant->status == 'accepted' ? 'success' : ($participant->status == 'rejected' ? 'danger' : 'warning') }}"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 fw-semibold">{{ $participant->name }}</h6>
                                    <p class="text-muted mb-1 small">
                                        <i class="fas fa-map-marker-alt me-1"></i>{{ $participant->adress }}
                                    </p>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <span class="badge bg-{{ $participant->status == 'accepted' ? 'success' : ($participant->status == 'rejected' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($participant->status) }}
                                        </span>
                                        <span class="badge bg-light text-dark">
                                            <i class="fas fa-graduation-cap me-1"></i>{{ $participant->last_education ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="col-lg-3 mb-3 mb-lg-0">
                            <small class="text-muted d-block mb-2">Contact Information:</small>
                            <div class="d-flex flex-column gap-1">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-phone text-muted me-2" style="width: 16px;"></i>
                                    <span class="small">{{ $participant->phonenumber }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-envelope text-muted me-2" style="width: 16px;"></i>
                                    <span class="small text-truncate" style="max-width: 200px;" title="{{ $participant->email }}">{{ $participant->email }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar text-muted me-2" style="width: 16px;"></i>
                                    <span class="small">{{ $participant->created_at->format('d M Y H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Application Details -->
                        <div class="col-lg-3 mb-3 mb-lg-0">
                            <small class="text-muted d-block mb-2">Application Details:</small>
                            <div class="small">
                                <div class="mb-2">
                                    <strong>Reason:</strong><br>
                                    <span class="text-muted">{{ Str::limit($participant->reason ?? 'No reason provided', 80) }}</span>
                                </div>
                                @if($participant->experience)
                                <div>
                                    <strong>Experience:</strong><br>
                                    <span class="text-muted">{{ Str::limit($participant->experience, 80) }}</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="col-lg-2 text-lg-end">
                            <div class="d-flex flex-column gap-2">
                                <!-- Status Update Select - FIXED -->
                                <select class="form-select form-select-sm status-select"
                                        data-volunteer-id="{{ $volunteer->id }}"
                                        data-participant-id="{{ $participant->id }}"
                                        onchange="handleStatusChange(this)">
                                    <option value="pending" {{ $participant->status == 'pending' ? 'selected' : '' }}>
                                        🕐 Pending
                                    </option>
                                    <option value="accepted" {{ $participant->status == 'accepted' ? 'selected' : '' }}>
                                        ✅ Accepted
                                    </option>
                                    <option value="rejected" {{ $participant->status == 'rejected' ? 'selected' : '' }}>
                                        ❌ Rejected
                                    </option>
                                </select>

                                <!-- WhatsApp Link -->
                                <a href="https://wa.me/{{ str_replace(['+', '-', ' ', '(', ')'], '', $participant->phonenumber) }}?text=Halo%20{{ urlencode($participant->name) }},%20terima%20kasih%20telah%20mendaftar%20sebagai%20volunteer%20untuk%20program%20{{ urlencode($volunteer->title) }}."
                                   target="_blank"
                                   class="btn btn-sm btn-outline-success">
                                    <i class="fab fa-whatsapp me-1"></i>WhatsApp
                                </a>

                                <!-- View Files - SAME AS DONATE -->
                                @if($participant->file_1 || $participant->file_2 || $participant->file_3)
                                <button type="button" class="btn btn-sm btn-outline-info"
                                        onclick="openFileViewer({{ json_encode([
                                            'file_1' => $participant->file_1,
                                            'file_2' => $participant->file_2,
                                            'file_3' => $participant->file_3,
                                            'name' => $participant->name,
                                            'date' => $participant->created_at->format('d M Y H:i')
                                        ]) }})">
                                    <i class="fas fa-paperclip me-1"></i>
                                    Files
                                    <span class="badge bg-info ms-1">
                                        {{ collect([$participant->file_1, $participant->file_2, $participant->file_3])->filter()->count() }}
                                    </span>
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-user-friends fa-4x text-muted opacity-50"></i>
                    </div>
                    <h4 class="text-muted mb-2">No Participants Yet</h4>
                    <p class="text-muted mb-4">Waiting for volunteer applications to this program</p>
                </div>
            @endforelse
        </div>

        @if($participants->hasPages())
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing {{ $participants->firstItem() }} to {{ $participants->lastItem() }} of {{ $participants->total() }} entries
                    </div>
                    <div>
                        {{ $participants->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Hidden form for status updates -->
    <form id="statusUpdateForm" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
        <input type="hidden" name="status" id="statusInput">
    </form>

    <!-- File Viewer Overlay (SAME AS DONATE) -->
    <div id="fileViewerOverlay" class="image-viewer-overlay" onclick="closeFileViewer()">
        <div class="image-viewer-container" onclick="event.stopPropagation()">
            <button class="viewer-close-btn" onclick="closeFileViewer()">
                <i class="fas fa-times"></i>
            </button>

            <div class="viewer-content">
                <div class="viewer-image-wrapper">
                    <img id="viewerFile" src="" alt="File preview" class="viewer-image">
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
                        <button onclick="downloadFile()" class="control-btn" title="Download">
                            <i class="fas fa-download"></i>
                        </button>
                        <button onclick="prevFile()" class="control-btn" title="Previous">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button onclick="nextFile()" class="control-btn" title="Next">
                            <i class="fas fa-chevron-right"></i>
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
                                <i class="fas fa-calendar-alt text-info"></i>
                                <div>
                                    <small class="text-muted d-block">Submitted</small>
                                    <strong id="viewerDate"></strong>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-file text-primary"></i>
                                <div>
                                    <small class="text-muted d-block">Current File</small>
                                    <strong id="currentFileName">File 1 of 3</strong>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="file-thumbnails" id="fileThumbnails">
                            <!-- Thumbnails will be generated here -->
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
    let currentFiles = [];
    let currentFileIndex = 0;

    // Handle status change with confirmation
    function handleStatusChange(selectElement) {
        const volunteerId = selectElement.dataset.volunteerId;
        const participantId = selectElement.dataset.participantId;
        const newStatus = selectElement.value;
        const oldStatus = selectElement.dataset.oldStatus || selectElement.querySelector('option[selected]')?.value;

        let confirmMessage = '';
        if (newStatus === 'accepted') {
            confirmMessage = 'Are you sure you want to ACCEPT this application?';
        } else if (newStatus === 'rejected') {
            confirmMessage = 'Are you sure you want to REJECT this application?';
        } else {
            confirmMessage = 'Change status to PENDING?';
        }

        if (confirm(confirmMessage)) {
            // Update form and submit
            const form = document.getElementById('statusUpdateForm');
            form.action = `/admin/volunteer/${volunteerId}/participants/${participantId}/status`;
            document.getElementById('statusInput').value = newStatus;
            form.submit();
        } else {
            // Revert to old status
            selectElement.value = oldStatus || 'pending';
        }
    }

    // Store original status for each select
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.status-select').forEach(select => {
            select.dataset.oldStatus = select.value;
            select.addEventListener('change', function() {
                // Update old status after successful change
                this.dataset.oldStatus = this.value;
            });
        });
    });

    function openFileViewer(data) {
        currentFiles = [];
        currentFileIndex = 0;
        currentZoom = 1;

        // Collect all files
        if (data.file_1) currentFiles.push({ path: data.file_1, label: 'File 1' });
        if (data.file_2) currentFiles.push({ path: data.file_2, label: 'File 2' });
        if (data.file_3) currentFiles.push({ path: data.file_3, label: 'File 3' });

        if (currentFiles.length === 0) return;

        // Set participant info
        document.getElementById('viewerName').textContent = data.name;
        document.getElementById('viewerDate').textContent = data.date;

        // Generate thumbnails
        generateThumbnails();

        // Show first file
        showFile(0);

        document.getElementById('fileViewerOverlay').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function generateThumbnails() {
        const container = document.getElementById('fileThumbnails');
        container.innerHTML = '<small class="text-muted d-block mb-2">All Files</small>';

        currentFiles.forEach((file, index) => {
            const extension = file.path.split('.').pop().toLowerCase();
            const isImage = ['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(extension);

            const thumb = document.createElement('div');
            thumb.className = 'file-thumb' + (index === currentFileIndex ? ' active' : '');
            thumb.onclick = () => showFile(index);

            if (isImage) {
                thumb.innerHTML = `<img src="/storage/${file.path}" alt="${file.label}">`;
            } else {
                const icon = extension === 'pdf' ? 'fa-file-pdf text-danger' : 'fa-file text-primary';
                thumb.innerHTML = `<i class="fas ${icon} fa-2x"></i>`;
            }

            const label = document.createElement('small');
            label.textContent = file.label;
            label.className = 'd-block text-center mt-1';
            thumb.appendChild(label);

            container.appendChild(thumb);
        });
    }

    function showFile(index) {
        if (index < 0 || index >= currentFiles.length) return;

        currentFileIndex = index;
        const file = currentFiles[index];
        const extension = file.path.split('.').pop().toLowerCase();
        const isImage = ['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(extension);

        const viewer = document.getElementById('viewerFile');
        const wrapper = viewer.parentElement;

        if (isImage) {
            viewer.src = `/storage/${file.path}`;
            viewer.style.display = 'block';
            viewer.style.cursor = 'zoom-in';
        } else {
            viewer.style.display = 'none';
            // Show PDF or other file types
            const icon = extension === 'pdf' ? 'fa-file-pdf text-danger' : 'fa-file text-primary';
            wrapper.innerHTML = `
                <div class="text-center">
                    <i class="fas ${icon} fa-5x mb-3"></i>
                    <h5>${file.label}</h5>
                    <p class="text-muted">${extension.toUpperCase()} File</p>
                    <a href="/storage/${file.path}" target="_blank" class="btn btn-primary">
                        <i class="fas fa-eye me-2"></i>Open File
                    </a>
                </div>
                <div class="viewer-controls">
                    <button onclick="downloadFile()" class="control-btn" title="Download">
                        <i class="fas fa-download"></i>
                    </button>
                    <button onclick="prevFile()" class="control-btn" title="Previous">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button onclick="nextFile()" class="control-btn" title="Next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            `;
        }

        document.getElementById('currentFileName').textContent = `${file.label} (${index + 1} of ${currentFiles.length})`;

        // Update thumbnail active state
        document.querySelectorAll('.file-thumb').forEach((thumb, i) => {
            thumb.classList.toggle('active', i === index);
        });

        resetZoom();
    }

    function closeFileViewer() {
        document.getElementById('fileViewerOverlay').classList.remove('active');
        document.body.style.overflow = '';
        resetZoom();
    }

    function prevFile() {
        showFile(currentFileIndex - 1);
    }

    function nextFile() {
        showFile(currentFileIndex + 1);
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
        const img = document.getElementById('viewerFile');
        if (img.style.display !== 'none') {
            img.style.transform = `scale(${currentZoom})`;
        }
    }

    function downloadFile() {
        if (currentFiles.length === 0) return;
        const file = currentFiles[currentFileIndex];
        const link = document.createElement('a');
        link.href = `/storage/${file.path}`;
        link.download = file.label;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        const overlay = document.getElementById('fileViewerOverlay');
        if (overlay.classList.contains('active')) {
            if (e.key === 'Escape') closeFileViewer();
            if (e.key === 'ArrowLeft') prevFile();
            if (e.key === 'ArrowRight') nextFile();
            if (e.key === '+' || e.key === '=') zoomIn();
            if (e.key === '-') zoomOut();
            if (e.key === '0') resetZoom();
        }
    });

    // Auto-dismiss alerts
    setTimeout(function() {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
</script>
@endpush

<style>
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
    border-radius: 12px;
}

/* Status Select Styling */
.status-select {
    border: 2px solid #dee2e6;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.status-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.status-select option {
    padding: 10px;
}

/* Image Viewer Overlay (SAME AS DONATE) */
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

/* File Thumbnails */
.file-thumbnails {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    margin-top: 15px;
}

.file-thumb {
    aspect-ratio: 1;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    padding: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: white;
}

.file-thumb:hover {
    border-color: #0d6efd;
    transform: scale(1.05);
}

.file-thumb.active {
    border-color: #0d6efd;
    background: #e7f1ff;
}

.file-thumb img {
    width: 100%;
    height: 60px;
    object-fit: cover;
    border-radius: 4px;
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

    .file-thumbnails {
        grid-template-columns: repeat(3, 1fr);
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
        font-size: 12px;
    }

    .viewer-info {
        padding: 20px;
    }

    .file-thumbnails {
        grid-template-columns: repeat(2, 1fr);
    }

    .participant-item {
        padding: 1.5rem !important;
    }

    .col-lg-2, .col-lg-3, .col-lg-4 {
        text-align: left !important;
    }
}

/* Additional responsive fixes */
@media (max-width: 768px) {
    .d-flex.flex-column.gap-2 {
        flex-direction: column !important;
    }

    .status-select {
        width: 100%;
    }
}
</style>