@extends('layouts.app')

@section('content')
<div class="profile-section-bg">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="glass-card">
                    <div class="card-header-custom text-white text-center py-4">
                        <h3 class="mb-0">Teacher Profile</h3>
                    </div>
                    <div class="card-body p-4">
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
    .profile-section-bg {
        background: url('{{ asset("images/lnu-background.jpg") }}') center/cover;
        min-height: 100vh;
        position: relative;
    }

    .profile-section-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(13, 110, 253, 0.85), rgba(11, 94, 215, 0.85));
        backdrop-filter: blur(1px);
    }

    .container {
        position: relative;
        z-index: 1;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .card-header-custom {
        background: rgba(13, 110, 253, 0.1);
        backdrop-filter: blur(5px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .profile-section {
        background: rgba(255, 255, 255, 0.5);
        padding: 1.5rem;
        border-radius: 15px;
        height: 100%;
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .profile-section:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .profile-section h5 {
        color: #0d6efd;
        font-weight: 600;
    }

    .profile-section p {
        margin-bottom: 0;
        color: #2c3e50;
    }

    .btn-primary {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
        background: linear-gradient(135deg, #0b5ed7, #084298);
    }

    .rounded-circle {
        border: 4px solid rgba(255, 255, 255, 0.8);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush
