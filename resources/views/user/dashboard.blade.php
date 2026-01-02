@extends('layouts.main')
@section('content')
<div class="container py-6">
    <!-- Error Alert -->
    @if(session('error'))
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif

    <!-- Success Alert -->
    @if(session('success'))
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">User Dashboard</h1>
            <p class="text-muted mb-0">Welcome back, {{ $user->name ?? 'User' }}</p>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-6">
            <div class="card border-primary border-2 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle text-muted mb-1">Saved Posts</h6>
                            <h2 class="card-title mb-0">{{ count($savedPosts ?? []) }}</h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-bookmark fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card border-info border-2 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle text-muted mb-1">Account Status</h6>
                            @if(isset($user->status))
                                <h2 class="card-title mb-0">{{ $user->status === 1 ? "Active✅" : "Inactive🛑" }}</h2>
                            @endif
                        </div>
                        <div class="bg-info bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-user-check fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Settings Row -->
    <div class="row g-4 mb-4">
        <!-- Edit Email Section -->
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0 d-flex align-items-center">
                        <i class="fas fa-envelope text-success me-2"></i>
                        Update Email
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted small mb-3">Current: {{ $user->email }}</p>
                    <form action="{{ route('email.update') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">New Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-save me-1"></i> Update Email
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Change Password Section -->
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0 d-flex align-items-center">
                        <i class="fas fa-key text-warning me-2"></i>
                        Change Password
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" class="form-control" name="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">
                            <i class="fas fa-lock me-1"></i> Change Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Saved Posts Section -->
    <div class="card shadow-sm mb-4 mt-5">
        <div class="card-header bg-white">
            <h5 class="mb-0 d-flex align-items-center">
                <i class="fas fa-bookmark text-primary me-2"></i>
                Saved Posts
                <span class="badge bg-primary ms-2">{{ count($savedPosts ?? []) }}</span>
            </h5>
        </div>
        <div class="card-body">
            @if(!empty($savedPosts))
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Saved Date</th>
                                <th width="100">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($savedPosts as $post)
                                <tr>
                                    <td>
                                        <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none">
                                            {{ $post->title }}
                                        </a>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($post->saved_at)->format('M j, Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        <form action="{{ route('posts.saved.delete', $post->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Remove this post from saved?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-bookmark fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No saved posts yet</h5>
                    <p class="text-muted">Posts you save will appear here</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Account Section -->
    <div class="card shadow-sm border-danger w-50">
        <div class="card-header bg-white border-danger">
            <h5 class="mb-0 d-flex align-items-center text-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Danger Zone
            </h5>
        </div>
        <div class="card-body">
            <p class="text-danger small mb-3">
                <i class="fas fa-info-circle me-1"></i>
                Deleting your account is permanent and cannot be undone.
            </p>
            <button type="button" class="btn btn-outline-danger w-100"
                data-bs-toggle="modal"
                data-bs-target="#deleteAccountModal">
                <i class="fas fa-trash me-1"></i> Delete Account
            </button>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-danger">
                <h5 class="modal-title text-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Delete Account
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone.
                </div>
                <p>All your data including saved posts and comments will be permanently deleted.</p>
                <form action="{{ route('account.delete') }}" method="POST" id="deleteAccountForm">
                    @csrf
                    @method('DELETE')
                    <div class="mb-3">
                        <label class="form-label">Enter your password to confirm:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="deleteAccountForm" class="btn btn-danger">
                    <i class="fas fa-trash me-1"></i> Delete Account Permanently
                </button>
            </div>
        </div>
    </div>
</div> 
@endsection