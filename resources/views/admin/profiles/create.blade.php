@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header gradient-header">
                    <h4 class="mb-0">Add New Teacher Profile</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.profiles.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="user_id" class="form-label">Teacher</label>
                                    <select class="form-select @error('user_id') is-invalid @enderror" 
                                            id="user_id" name="user_id" required>
                                        <option value="">Select a teacher</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="office_id" class="form-label">Office</label>
                                    <select class="form-select @error('office_id') is-invalid @enderror" 
                                            id="office_id" name="office_id" required>
                                        <option value="">Select an office</option>
                                        @foreach($offices as $office)
                                            <option value="{{ $office->id }}" {{ old('office_id') == $office->id ? 'selected' : '' }}>
                                                {{ $office->office_name }} - {{ $office->college }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('office_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="course" class="form-label">Course</label>
                                    <input type="text" class="form-control @error('course') is-invalid @enderror" 
                                           id="course" name="course" value="{{ old('course') }}" required>
                                    @error('course')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="specialization" class="form-label">Specialization</label>
                                    <input type="text" class="form-control @error('specialization') is-invalid @enderror" 
                                           id="specialization" name="specialization" value="{{ old('specialization') }}" required>
                                    @error('specialization')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <input type="text" class="form-control @error('contact_number') is-invalid @enderror" 
                                   id="contact_number" name="contact_number" value="{{ old('contact_number') }}" required>
                            @error('contact_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subjects_taught" class="form-label">Subjects Taught</label>
                            <textarea class="form-control @error('subjects_taught') is-invalid @enderror" 
                                      id="subjects_taught" name="subjects_taught" rows="3" required>{{ old('subjects_taught') }}</textarea>
                            @error('subjects_taught')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="educational_background" class="form-label">Educational Background</label>
                            <textarea class="form-control @error('educational_background') is-invalid @enderror" 
                                      id="educational_background" name="educational_background" rows="4" required>{{ old('educational_background') }}</textarea>
                            @error('educational_background')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="researches" class="form-label">Research Work (Optional)</label>
                            <textarea class="form-control @error('researches') is-invalid @enderror" 
                                      id="researches" name="researches" rows="3">{{ old('researches') }}</textarea>
                            @error('researches')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture (Optional)</label>
                            <input type="file" class="form-control @error('profile_picture') is-invalid @enderror" 
                                   id="profile_picture" name="profile_picture" accept="image/jpeg,image/png">
                            @error('profile_picture')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="social_links_facebook" class="form-label">Facebook URL (Optional)</label>
                                    <input type="url" class="form-control @error('social_links.facebook') is-invalid @enderror" 
                                           id="social_links_facebook" name="social_links[facebook]" value="{{ old('social_links.facebook') }}">
                                    @error('social_links.facebook')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="social_links_linkedin" class="form-label">LinkedIn URL (Optional)</label>
                                    <input type="url" class="form-control @error('social_links.linkedin') is-invalid @enderror" 
                                           id="social_links_linkedin" name="social_links[linkedin]" value="{{ old('social_links.linkedin') }}">
                                    @error('social_links.linkedin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.profiles.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
