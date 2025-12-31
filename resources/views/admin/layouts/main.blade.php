<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>

<body>
    <div class="container-fluid" x-data="{active:'{{ isset($active) ? $active : false }}'}">
        <div class="row">
            <!-- Sidebar -->
            <div id="sidebar" class="col-md-3 col-lg-2 px-0">
                <div class="sidebar-header">
                    <h4 class="text-center">Admin Panel</h4>
                </div>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link" :class="active === 'dashboard' ? 'active' : '' ">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.posts.index') }}" class="nav-link" :class="active === 'posts' ? 'active' : ''">
                            <i class="fas fa-newspaper me-2"></i>
                            All Posts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.posts.create') }}" class="nav-link" :class="active === 'create' ? 'active' : '' ">
                            <i class="fas fa-plus-circle me-2"></i>
                            Create Post
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link" :class="active === 'users' ? 'active' : ''">
                            <i class="fas fa-users me-2"></i>
                            Users
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.users.create') }}" class="nav-link" :class="active === 'create_user' ? 'active' : '' ">
                            <i class="fas fa-user-plus me-2"></i>
                            Create User
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.contacts.index') }}" class="nav-link" :class="active === 'contacts' ? 'active' : '' ">
                            <i class="fas fa-envelope me-2"></i>
                            Contact Messages
                        </a>
                    </li>

                    <li class="nav-item my-3 mx-4 ">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-danger w-100" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-power-off me-2"></i>Logout
                            </button>
                        </form>
                    </li>

                </ul>
            </div>

            <!-- Main Content -->
            <div id="content" class="col-md-9 col-lg-10 ms-sm-auto">
                @yield('content')
            </div>


            <footer class="bottom-fixed start-0 p-3 w-100 bg-dark">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="fas fa-user-cog text-light"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-2">
                        <p class="mb-0 text-light small">Admin User</p>
                        <a href="{{ url('/') }}" class="text-decoration-none small text-info">
                            <i class="fas fa-external-link-alt me-1"></i>View Website
                        </a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('scripts')
</body>

</html>