@extends('admin.layouts.main')
@section('content')
<div class="admin-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Users Management</h1>
            <p class="text-muted mb-0">Manage all registered users</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-user-plus"></i> New User
        </a>
    </div>
</div>

<div class="table-container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">All Users</h5>
        <div class="d-flex gap-2 align-items-center">
            <!-- Search Form -->
            <form action="{{ route('admin.users.index') }}" method="GET" class="mb-0">
                <div class="input-group input-group-sm" style="width: 200px;">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" name="search" class="form-control form-control-sm"
                        placeholder="Search users..." value="{{ request('search') }}">
                </div>
            </form>

            <!-- Role Filter Form -->
            <form action="{{ route('admin.users.index') }}" method="GET" class="mb-0">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <button class="btn btn-primary"><i class="fas fa-filter"></i></button>
                    <select name="role" class="form-select form-select-sm">
                        <option value="">All Roles</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
                        <option value="editor" {{ request('role') === 'editor' ? 'selected' : '' }}>Editor</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th width="50">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th width="120">Registered</th>
                    <th width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <div class="fw-semibold">{{ $user->name }}</div>
                        </td>
                        <td>
                            <a href="mailto:{{ $user->email }}" class="text-decoration-none">
                                {{ $user->email }}
                            </a>
                        </td>
                        <td>
                            @if ($user->role === 'admin')
                                <span class="badge bg-danger">Admin</span>
                            @elseif($user->role === 'editor')
                                <span class="badge bg-warning text-dark">Editor</span>
                            @else
                                <span class="badge bg-secondary">User</span>
                            @endif
                        </td>
                        <td>
                            <small class="text-muted">
                                {{ $user->created_at->format('M j, Y') }}
                            </small>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <!-- Edit Action -->
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline-primary"
                                    title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Delete Action -->
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                    class="btn-group">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this user?')"
                                        title="Delete User">
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

    <!-- Empty State -->
    @if ($users->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-users fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">No users yet</h4>
            <p class="text-muted mb-0">All registered users will appear here</p>
        </div>
    @endif

    <div class="d-flex justify-content-center mt-4">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection