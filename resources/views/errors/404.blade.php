@extends('layouts.main')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 text-center">
            <div class="mb-4">
                <i class="bi bi-exclamation-triangle-fill text-warning fs-1"></i>
            </div>
            <h1 class="display-1 fw-bold text-warning">404</h1>
            <h2 class="mb-4">Page Not Found</h2>
            <p class="lead text-muted mb-4">
                The page you're looking for doesn't exist or has been moved.
            </p>
            <a href="/" class="btn btn-primary btn-lg">
                <i class="bi bi-house-door me-2"></i>Go to Homepage
            </a>
        </div>
    </div>
</div>/
@endsection