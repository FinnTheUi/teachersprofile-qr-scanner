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
                    <a href="{{ route('admin.profiles.download-qr', $profile->id) }}" class="btn btn-outline-primary">
                        <i class="fas fa-download me-2"></i>Download QR Code
                    </a>
                </div>
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
@endsection