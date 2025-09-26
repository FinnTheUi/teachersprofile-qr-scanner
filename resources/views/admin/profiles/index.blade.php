@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Teacher Profiles</h2>
        <a href="{{ route('admin.profiles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add New Profile
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Office</th>
                            <th>Specialization</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($profiles as $profile)
                            <tr>
                                <td>{{ $profile->user->name }}</td>
                                <td>{{ $profile->course }}</td>
                                <td>{{ $profile->office->office_name }}</td>
                                <td>{{ $profile->specialization }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.profiles.show', $profile) }}" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.profiles.edit', $profile) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.profiles.download-qr', $profile) }}" class="btn btn-sm btn-outline-success">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                onclick="if(confirm('Are you sure you want to delete this profile?')) { 
                                                    document.getElementById('delete-profile-{{ $profile->id }}').submit(); 
                                                }">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form id="delete-profile-{{ $profile->id }}" 
                                              action="{{ route('admin.profiles.destroy', $profile) }}" 
                                              method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No profiles found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $profiles->links() }}
    </div>
</div>
@endsection
