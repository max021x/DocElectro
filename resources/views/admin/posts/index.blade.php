@extends('admin.layouts.main')
@section('content')
    <div class="admin-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0">Posts Management</h1>
                <p class="text-muted mb-0">Manage all your blog posts</p>
            </div>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus-circle"></i> New Post
            </a>
        </div>
    </div>

    <div class="table-container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">All Posts</h5>
            <div class="d-flex gap-2">
                <!-- Search Form -->
                <form method="GET" action="{{ route('admin.posts.index') }}" class="input-group input-group-sm"
                    style="width: 200px;">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Search posts..."
                        value="{{ request('search') }}">
                </form>
            </div>
        </div>

        @if ($posts->isEmpty())
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> No posts found. Create your first post!
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="50">ID</th>
                            <th>Title</th>
                            <th width="120">Created Date</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $post->title }}</div>
                                </td>
                                <td>{{ $post->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <!-- View Action -->
                                        <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-outline-info"
                                            title="View Post">
                                            <i class="fas fa-search"></i>
                                        </a>
                                        <!-- Edit Action -->
                                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-outline-primary"
                                            title="Edit Post">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <!-- Delete Action -->
                                        <form class="btn-group" method="POST" action="{{ route('admin.posts.destroy', $post->id) }}"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete this post?')"
                                                title="Delete Post">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Laravel Pagination -->
        @if ($posts->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $posts->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection
