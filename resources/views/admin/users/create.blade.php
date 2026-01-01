@extends('admin.layouts.main')
@section('content')
<div class="admin-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Create New User</h1>
            <p class="text-muted mb-0">Add a new user to the system</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Back to Users
        </a>
    </div>
</div>

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i>
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i>
    <ul class="mb-0 ps-0">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card shadow-sm mt-4">
    <div class="card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            
            <div class="row g-3">
                <!-- Name Field -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" 
                               value="{{ old('name') }}"
                               placeholder="Enter full name" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Email Field -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" 
                               value="{{ old('email') }}"
                               placeholder="name@example.com" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Password Field -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" 
                               placeholder="Enter password" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Confirm Password Field -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="confirm_password" name="password_confirmation" 
                               placeholder="Confirm password" required>
                    </div>
                </div>
                
                <!-- Role Field -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="role" class="form-label">User Role <span class="text-danger">*</span></label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                            <option value="">Select a role</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ old('role') == 'user' || !old('role') ? 'selected' : '' }}>User</option>
                        </select>
                        @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Status Field -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Account Status <span class="text-danger">*</span></label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" 
                                       id="status_active" value="1" 
                                       {{ old('status', '1') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label text-success" for="status_active">
                                    <i class="fas fa-check-circle me-1"></i> Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" 
                                       id="status_inactive" value="0"
                                       {{ old('status') == '0' ? 'checked' : '' }}>
                                <label class="form-check-label text-danger" for="status_inactive">
                                    <i class="fas fa-times-circle me-1"></i> Inactive
                                </label>
                            </div>
                        </div>
                        @error('status')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="mt-4 pt-3 border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="fas fa-redo me-1"></i> Reset Form
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-plus me-1"></i> Create User
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Help Information -->
<div class="card shadow-sm mt-4">
    <div class="card-body">
        <h6 class="card-title mb-3">
            <i class="fas fa-info-circle text-primary me-2"></i>
            About User Roles & Status
        </h6>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="border rounded p-3">
                    <h6 class="fw-bold">User Roles</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <span class="badge bg-danger me-2">Admin</span>
                            <small>Full access to admin panel and all features</small>
                        </li>
                        <li>
                            <span class="badge bg-secondary me-2">User</span>
                            <small>Standard user with limited access</small>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border rounded p-3">
                    <h6 class="fw-bold">Account Status</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <span class="badge bg-success me-2">Active</span>
                            <small>User can login and use the system</small>
                        </li>
                        <li>
                            <span class="badge bg-danger me-2">Inactive</span>
                            <small>User cannot login (account disabled)</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection