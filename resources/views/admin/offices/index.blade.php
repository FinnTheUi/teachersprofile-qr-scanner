@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Manage Offices</h2>
        <a href="{{ route('admin.offices.create') }}" class="btn btn-outline-primary">
            <i class="fas fa-plus me-1"></i> Add New Office
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-hover">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Office Name</th>
                            <th>College</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($offices as $office)
                            <tr>
                                <td>{{ $office->office_name }}</td>
                                <td>{{ $office->college }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.offices.edit', $office) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                onclick="if(confirm('Are you sure you want to delete this office?')) { 
                                                    document.getElementById('delete-office-{{ $office->id }}').submit(); 
                                                }">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form id="delete-office-{{ $office->id }}" 
                                              action="{{ route('admin.offices.destroy', $office) }}" 
                                              method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">No offices found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $offices->links() }}
    </div>
</div>
@endsection