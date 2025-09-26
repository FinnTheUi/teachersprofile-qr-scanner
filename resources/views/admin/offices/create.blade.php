@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header gradient-header">
                    <h4 class="mb-0">Add New Office</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.offices.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="office_name" class="form-label">Office Name</label>
                            <input type="text" class="form-control @error('office_name') is-invalid @enderror" 
                                   id="office_name" name="office_name" value="{{ old('office_name') }}" required>
                            @error('office_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="college" class="form-label">College</label>
                            <input type="text" class="form-control @error('college') is-invalid @enderror" 
                                   id="college" name="college" value="{{ old('college') }}" required>
                            @error('college')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.offices.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Office</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection