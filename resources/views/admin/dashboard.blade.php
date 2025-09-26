@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stats-info">
                    <h3 class="stats-number">{{ $totalUsers }}</h3>
                    <p class="stats-label">Total Users</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-icon blue">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="stats-info">
                    <h3 class="stats-number">{{ $totalTeachers }}</h3>
                    <p class="stats-label">Teacher Profiles</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-icon green">
                    <i class="fas fa-qrcode"></i>
                </div>
                <div class="stats-info">
                    <h3 class="stats-number">{{ $totalTeachers }}</h3>
                    <p class="stats-label">QR Codes Generated</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Users -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Recent Users</h5>
                    <a href="{{ route('admin.profiles.index') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentUsers as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-{{ $user->is_active ? 'success' : 'danger' }}">
                                            {{ $user->is_active ? 'Active' : 'Suspended' }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-{{ $user->is_active ? 'warning' : 'success' }}">
                                                <i class="fas fa-{{ $user->is_active ? 'ban' : 'check' }}"></i>
                                                {{ $user->is_active ? 'Suspend' : 'Activate' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Profiles -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Recent Profiles</h5>
                    <a href="{{ route('admin.profiles.index') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
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
                                @foreach($recentProfiles as $profile)
                                <tr>
                                    <td>{{ $profile->name }}</td>
                                    <td>{{ $profile->office->name }}</td>
                                    <td>{{ $profile->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('admin.profiles.edit', $profile) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('profile.show', $profile) }}" class="btn btn-sm btn-primary">
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
    .stats-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
    }

    .stats-icon {
        width: 60px;
        height: 60px;
        background: var(--primary-gradient);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
    }

    .stats-icon.blue {
        background: linear-gradient(135deg, #4e73df, #224abe);
    }

    .stats-icon.green {
        background: linear-gradient(135deg, #1cc88a, #13855c);
    }

    .stats-number {
        font-size: 1.75rem;
        font-weight: 600;
        margin: 0;
        line-height: 1.2;
    }

    .stats-label {
        color: #6c757d;
        margin: 0;
        font-size: 0.9rem;
    }

    .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        background: none;
        border-bottom: 1px solid #f0f0f0;
        padding: 1.25rem;
    }

    .table th {
        font-weight: 500;
        color: #6c757d;
        border-top: none;
    }

    .badge {
        padding: 0.5rem 1rem;
        font-weight: 500;
    }

    .btn-sm {
        padding: 0.25rem 0.75rem;
        font-size: 0.875rem;
        border-radius: 8px;
    }
</style>
@endpush
@endsection