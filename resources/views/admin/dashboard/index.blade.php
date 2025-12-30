@extends('admin.layouts.main')
@section('content')

<div class="admin-header mb-4">
    <h1 class="h3 mb-2">Dashboard</h1>
    <p class="text-muted mb-0">Welcome to your weblog admin panel</p>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card border-primary border-2 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle text-muted mb-1">Total Posts</h6>
                        <h2 class="card-title mb-0">{{ $totalPosts }}</h2>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-newspaper fa-2x text-primary"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.posts.index') }}" class="text-decoration-none small">
                        View all posts <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card border-success border-2 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle text-muted mb-1">Total Comments</h6>
                        <h2 class="card-title mb-0">{{ $totalComments }}</h2>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-comments fa-2x text-success"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="#" class="text-decoration-none small">
                        View comments <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card border-info border-2 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle text-muted mb-1">Contact Messages</h6>
                        <h2 class="card-title mb-0">{{ $totalContacts }}</h2>
                    </div>
                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-envelope fa-2x text-info"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.contacts.index') }}" class="text-decoration-none small">
                        View messages <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card border-warning border-2 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle text-muted mb-1">Total Users</h6>
                        <h2 class="card-title mb-0">{{ $totalUsers }}</h2>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-users fa-2x text-warning"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.users.index') }}" class="text-decoration-none small">
                        View users <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions & Admin Info -->
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Quick Actions</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card border-light shadow-sm h-100">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-plus-circle fa-3x text-primary"></i>
                                </div>
                                <h5 class="card-title">Create New Post</h5>
                                <p class="card-text text-muted small">Start writing a new blog post</p>
                                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary w-100">Create Post</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-light shadow-sm h-100">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="fas fa-list-alt fa-3x text-success"></i>
                                </div>
                                <h5 class="card-title">Manage Posts</h5>
                                <p class="card-text text-muted small">View and edit existing posts</p>
                                <a href="{{ route('admin.posts.index') }}" class="btn btn-success w-100">View Posts</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection