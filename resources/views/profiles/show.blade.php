@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header text-white" style="background: linear-gradient(135deg, #0d6efd, #0b5ed7)">
                    <h4 class="mb-0">Teacher Profile</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block">
                            <img src="{{ $profile->profile_picture ? asset('storage/' . $profile->profile_picture) : asset('images/default-avatar.svg') }}"
                                alt="{{ $profile->user->name }}"
                                class="rounded-circle mb-3"
                                style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <h3 class="mb-1">{{ $profile->user->name }}</h3>
                        <p class="text-muted mb-2">{{ $profile->course }}</p>
                        <p class="mb-0">{{ $profile->office->college }}</p>
                        <p class="text-muted">{{ $profile->office->office_name }}</p>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="profile-section">
                                <h5 class="border-bottom pb-2 mb-3">
                                    <i class="fas fa-graduation-cap me-2"></i>Specialization
                                </h5>
                                <p>{{ $profile->specialization }}</p>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="profile-section">
                                <h5 class="border-bottom pb-2 mb-3">
                                    <i class="fas fa-chalkboard-teacher me-2"></i>Subjects Taught
                                </h5>
                                <p>{{ $profile->subjects_taught }}</p>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="profile-section">
                                <h5 class="border-bottom pb-2 mb-3">
                                    <i class="fas fa-user-graduate me-2"></i>Educational Background
                                </h5>
                                <p>{{ $profile->educational_background }}</p>
                            </div>
                        </div>

                        @if($profile->researches)
                        <div class="col-12">
                            <div class="profile-section">
                                <h5 class="border-bottom pb-2 mb-3">
                                    <i class="fas fa-microscope me-2"></i>Research Work
                                </h5>
                                <p>{{ $profile->researches }}</p>
                            </div>
                        </div>
                        @endif

                        <div class="col-md-6">
                            <div class="profile-section">
                                <h5 class="border-bottom pb-2 mb-3">
                                    <i class="fas fa-phone me-2"></i>Contact
                                </h5>
                                <p>{{ $profile->contact_number }}</p>
                            </div>
                        </div>

                        @if($profile->social_links)
                        <div class="col-md-6">
                            <div class="profile-section">
                                <h5 class="border-bottom pb-2 mb-3">
                                    <i class="fas fa-share-alt me-2"></i>Social Links
                                </h5>
                                <div class="d-flex gap-2">
                                    @if(isset($profile->social_links['facebook']))
                                        <a href="{{ $profile->social_links['facebook'] }}" target="_blank" class="btn btn-primary">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    @endif
                                    @if(isset($profile->social_links['linkedin']))
                                        <a href="{{ $profile->social_links['linkedin'] }}" target="_blank" class="btn btn-primary">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('scan.form') }}" class="btn btn-primary">
                            <i class="fas fa-qrcode me-2"></i>Scan Another QR
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    .profile-section {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 10px;
        height: 100%;
    }
    .profile-section h5 {
        color: #0d6efd;
    }
    .profile-section p {
        margin-bottom: 0;
    }
</style>
@endpush
