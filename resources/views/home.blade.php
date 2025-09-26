@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <div class="container py-4">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="welcome-card">
                    <div class="d-flex align-items-center">
                        <div class="welcome-icon">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div class="ms-3">
                            <h4 class="welcome-title mb-1">Welcome back, {{ Auth::user()->name }}!</h4>
                            <p class="welcome-subtitle mb-0">Here's what's happening with the QR Scanner system today.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-qrcode"></i>
                    </div>
                    <div class="stats-info">
                        <h5 class="stats-title">Total Scans</h5>
                        <h3 class="stats-number">{{ App\Models\Profile::count() }}</h3>
                        <p class="stats-text">Teacher profiles available</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stats-info">
                        <h5 class="stats-title">Offices</h5>
                        <h3 class="stats-number">{{ App\Models\Office::count() }}</h3>
                        <p class="stats-text">Registered departments</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stats-info">
                        <h5 class="stats-title">Users</h5>
                        <h3 class="stats-number">{{ App\Models\User::count() }}</h3>
                        <p class="stats-text">System users</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="action-card">
                    <h5 class="action-title mb-4">Quick Actions</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="{{ route('scan.form') }}" class="quick-action-btn">
                                <i class="fas fa-qrcode"></i>
                                <span>Scan QR Code</span>
                            </a>
                        </div>
                        @if(Auth::user()->isAdmin())
                        <div class="col-md-4">
                            <a href="{{ route('admin.profiles.create') }}" class="quick-action-btn">
                                <i class="fas fa-user-plus"></i>
                                <span>Add New Profile</span>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('admin.offices.create') }}" class="quick-action-btn">
                                <i class="fas fa-building"></i>
                                <span>Add New Office</span>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="row">
            <div class="col-12">
                <div class="activity-card">
                    <h5 class="activity-title mb-4">Recent Profiles</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Office</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\Profile::latest()->take(5)->get() as $profile)
                                <tr>
                                    <td>{{ $profile->name }}</td>
                                    <td>{{ $profile->office->name ?? 'N/A' }}</td>
                                    <td>{{ $profile->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('profile.show', $profile->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .dashboard-wrapper {
        background-color: #f8f9fa;
        min-height: calc(100vh - 60px);
    }

    .welcome-card {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        border-radius: 15px;
        padding: 2rem;
        color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .welcome-icon {
        font-size: 3rem;
        background: rgba(255, 255, 255, 0.2);
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .welcome-title {
        font-size: 1.75rem;
        font-weight: 600;
    }

    .welcome-subtitle {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1rem;
    }

    .stats-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        height: 100%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
    }

    .stats-icon {
        font-size: 1.5rem;
        color: #0d6efd;
        background: rgba(13, 110, 253, 0.1);
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        margin-bottom: 1rem;
    }

    .stats-title {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .stats-number {
        font-size: 1.75rem;
        font-weight: 600;
        color: #212529;
        margin-bottom: 0.25rem;
    }

    .stats-text {
        color: #6c757d;
        font-size: 0.85rem;
        margin: 0;
    }

    .action-card, .activity-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .action-title, .activity-title {
        color: #212529;
        font-weight: 600;
    }

    .quick-action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1.5rem;
        color: #495057;
        text-decoration: none;
        transition: all 0.3s ease;
        height: 100%;
    }

    .quick-action-btn:hover {
        background: #0d6efd;
        color: white;
        transform: translateY(-3px);
    }

    .quick-action-btn i {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        border-top: none;
        color: #6c757d;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 0.85rem;
    }

    .table td {
        vertical-align: middle;
    }

    @media (max-width: 768px) {
        .welcome-icon {
            width: 60px;
            height: 60px;
            font-size: 2rem;
        }

        .welcome-title {
            font-size: 1.25rem;
        }

        .welcome-subtitle {
            font-size: 0.9rem;
        }

        .stats-card {
            margin-bottom: 1rem;
        }
    }
</style>
@endpush
@endsection
