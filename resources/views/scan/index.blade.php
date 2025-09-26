@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-hover">
                <div class="card-header text-white gradient-header">
                    <h4 class="mb-0"><i class="fas fa-qrcode me-2"></i>Scan QR Code</h4>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('scan.qr') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-4">
                            <label for="qr_image" class="form-label">Upload QR Code Image</label>
                            <input type="file" class="form-control" id="qr_image" name="qr_image" accept="image/jpeg,image/png" required>
                            <div class="form-text">
                                Accepted formats: JPG, PNG (max 2MB)
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-light text-primary fw-semibold">
                                <i class="fas fa-magnifying-glass me-2"></i>Scan & View Profile
                            </button>
                        </div>
                    </form>
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
    }
    .card-header {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
</style>
@endpush