@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Profile Card -->
        <div class="col-lg-4 mb-4">
            <div class="card profile-card">
                <div class="card-body text-center">
                    <div class="profile-image-container mb-4">
                        <img src="{{ asset('images/default-avatar.svg') }}" alt="Profile" class="profile-image">
                    </div>
                    <h4 class="mb-1">{{ $profile->name }}</h4>
                    <p class="text-muted mb-3">{{ $profile->office->name }}</p>
                    <a href="{{ route('teacher.profile.edit') }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Profile
                    </a>
                </div>
            </div>

            <!-- QR Code Card -->
            <div class="card mt-4">
                <div class="card-body text-center">
                    <h5 class="card-title mb-3">Your QR Code</h5>
                    <div class="qr-container mb-3">
                        {!! QrCode::size(200)->generate(route('profile.show', $profile->id)) !!}
                    </div>
                    <a href="{{ route('teacher.download-qr') }}" class="btn btn-outline-primary">
                        <i class="fas fa-download me-2"></i>Download My QR Code
                    </a>
                </div>
            </div>
            <!-- Scan QR Button -->
            <div class="d-grid mt-4">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#scanQrModal">
                    <i class="fas fa-qrcode me-2"></i>Scan QR
                </button>
            </div>
        </div>

        <!-- Profile Details -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Profile Information</h5>
                    <div class="profile-info">
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted">Full Name</div>
                            <div class="col-md-8">{{ $profile->name }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted">Office/Department</div>
                            <div class="col-md-8">{{ $profile->office->name }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted">Contact Number</div>
                            <div class="col-md-8">{{ $profile->contact_number ?? 'Not set' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted">Bio</div>
                            <div class="col-md-8">{{ $profile->bio ?? 'No bio available' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 text-muted">Account Status</div>
                            <div class="col-md-8">
                                <span class="badge bg-{{ auth()->user()->is_active ? 'success' : 'danger' }}">
                                    {{ auth()->user()->is_active ? 'Active' : 'Suspended' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scan QR Modal -->
<div class="modal fade" id="scanQrModal" tabindex="-1" aria-labelledby="scanQrModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scanQrModalLabel"><i class="fas fa-qrcode me-2"></i>Scan QR Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="scan-form-section">
                    <form id="scanQrForm" action="{{ route('scan.qr') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="qr_image_modal" class="form-label">Upload QR Code Image</label>
                            <input type="file" class="form-control" id="qr_image_modal" name="qr_image" accept="image/jpeg,image/png" required>
                            <div class="form-text">Accepted formats: JPG, PNG (max 2MB)</div>
                        </div>
                        <div id="scan-error" class="alert alert-danger d-none"></div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-magnifying-glass me-2"></i>Scan & View Profile
                            </button>
                        </div>
                    </form>
                </div>
                <div id="scan-result-section" class="d-none"></div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .profile-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .profile-image-container {
        width: 120px;
        height: 120px;
        margin: 0 auto;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .qr-container {
        background: white;
        padding: 1rem;
        border-radius: 10px;
        display: inline-block;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .profile-info .row {
        border-bottom: 1px solid #f0f0f0;
        padding: 0.75rem 0;
    }

    .profile-info .row:last-child {
        border-bottom: none;
    }

    .badge {
        padding: 0.5rem 1rem;
        font-weight: 500;
    }
</style>
@endpush

@push('scripts')
<script>
$(function() {
    // Reset modal on open/close
    $('#scanQrModal').on('show.bs.modal', function() {
        $('#scan-form-section').show();
        $('#scan-result-section').addClass('d-none').html('');
        $('#scan-error').addClass('d-none').text('');
        $('#scanQrForm')[0].reset();
    });
    // AJAX form submit
    $('#scanQrForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $('#scan-error').addClass('d-none').text('');
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(data) {
                // Expect HTML of the profile card
                $('#scan-form-section').hide();
                $('#scan-result-section').removeClass('d-none').html(data);
            },
            error: function(xhr) {
                let msg = 'Unable to read QR code. Please try again with a clearer image.';
                if(xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    msg = Object.values(errors).map(arr => arr.join('<br>')).join('<br>');
                }
                $('#scan-error').removeClass('d-none').html(msg);
            }
        });
    });
});
</script>
@endpush
@endsection