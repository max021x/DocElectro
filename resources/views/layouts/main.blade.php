<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElectroDoc</title>
    <link rel="icon" href="">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/showpost.css') }}">

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white fixed-top shadow-sm {{ isset($dnone) ? 'd-none' : '' }}">
        <div class="container-fluid container-lg">

            <!-- Brand Logo -->
            <a class="navbar-brand fw-bold fs-4 text-primary d-flex align-items-center" href="{{ route('home') }}">
                <i class="fas fa-bolt me-2"></i>DocElectro
            </a>

            <!-- Search Box - Visible on medium and larger screens -->
            <div class="d-none d-lg-flex flex-grow-1 justify-content-center mx-4">
                <form action="{{ route('posts.index') }}" method="GET">
                    <input type="hidden" name="page" value="1">
                    <div class="input-group" style="max-width: 500px;">
                        <input type="text" name="search" class="form-control border-primary" placeholder="Search tutorials...">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <!-- Desktop Navigation -->
            <div class="d-none d-lg-flex align-items-center ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mx-2">
                        <a class="nav-link text-dark" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link text-dark" href="{{ route('posts.index') }}">Posts</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown mx-2">
                            <a class="nav-link dropdown-toggle d-flex align-items-center text-dark" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle fa-lg me-2"></i>
                                Account
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <div class="d-grid">
                                            <button class="btn btn-link text-danger p-0 border-0 text-decoration-none"
                                                type="submit">Logout
                                                <i class="fas fa-power-off me-2"></i>
                                            </button>
                                        </div>
                                    </form>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                    </a>
                                </li>
                                @if (auth()->user()->role === 'admin')
                                    
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-cog me-2"></i>Admin Dashboard
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                    @else
                        <li class="nav-item mx-2">
                            <a class="nav-link text-dark" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
                    @endauth
                    <li class="nav-item mx-2">
                        <a class="nav-link text-dark" href="/#contact">Contact</a>
                    </li>
                    <!-- <li class="nav-item mx-2">
                        <a href="#" class="nav-link text-dark">
                            <i class="fas fa-moon"></i>
                        </a>
                    </li> -->
                    <li class="nav-item mx-2">
                        <a href="https://github.com/max021x/electrodoc/tree/master" target="_blank" class="nav-link text-dark">
                            <i class="fab fa-github"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Mobile Menu Button -->
            <div class="d-flex align-items-center d-lg-none">
                @auth
                    <div class="dropdown me-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center text-dark" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle fa-lg"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <div class="d-grid">
                                        <button class="btn btn-link text-danger p-0 border-0 text-decoration-none"
                                            type="submit">Logout
                                            <i class="fas fa-power-off me-2"></i>
                                        </button>
                                    </div>
                                </form>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i>
                                    Dashboard
                                </a>
                            </li>
                            @if(auth()->user()->role === 'admin')
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-cog me-2"></i>Admin
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                @endauth
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#electroNav">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
            </div>

        </div>
    </nav>

    <!-- Mobile Offcanvas Sidebar -->
    <div class="offcanvas offcanvas-end" id="electroNav" tabindex="-1">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fw-bold text-primary">
                <i class="fas fa-bolt me-2"></i>ElectroDoc
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav">
                <li class="nav-item mb-2">
                    <a class="nav-link text-dark d-flex align-items-center" href="{{ route('home') }}">
                        <i class="fas fa-home me-3"></i>Home
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-dark d-flex align-items-center" href="{{ route('posts.index') }}">
                        <i class="fas fa-newspaper me-3"></i>Posts
                    </a>
                </li>
                @guest
                    <li class="nav-item mb-2">
                        <a class="nav-link text-dark d-flex align-items-center" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-3"></i>Login
                        </a>
                    </li>
                @endguest
                <li class="nav-item mb-2">
                    <a class="nav-link text-dark d-flex align-items-center" href="#contact">
                        <i class="fas fa-phone me-3"></i>Contact
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="https://github.com/max021x/electrodoc/tree/master" target="_blank" class="nav-link text-dark d-flex align-items-center">
                        <i class="fab fa-github me-3"></i>GitHub
                    </a>
                </li>

                <!-- Mobile Search -->
                <li class="nav-item mt-4">
                    <hr>
                    <form action="{{ route('posts.index') }}" method="GET" class="mt-3">
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control border-primary" placeholder="Search tutorials...">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <main class="pt-5">
        @yield('content')
    </main>


    <footer class="footer bg-light py-4 {{ isset($dnone) ? 'd-none' : '' }}">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-3">About ElectroDoc</h5>
                    <p class="text-muted">
                        Your comprehensive resource for electronics education. We provide detailed tutorials, 
                        circuit guides, and project documentation for enthusiasts, students, and professionals.
                    </p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-3">Technical Resources</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="fas fa-angle-right me-2"></i>Circuit Schematics
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="fas fa-angle-right me-2"></i>Component Datasheets
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="fas fa-angle-right me-2"></i>Project Documentation
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('home') }}" class="text-decoration-none text-dark">
                                <i class="fas fa-angle-right me-2"></i>Tutorials Home
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3">Connect With Our Community</h5>
                    <div class="mb-4">
                        <a href="https://github.com/max021x/electrodoc/tree/master" target="_blank" class="text-decoration-none me-3">
                            <i class="fab fa-github fa-2x text-dark"></i>
                        </a>
                        <a href="#" class="text-decoration-none me-3">
                            <i class="fab fa-youtube fa-2x text-danger"></i>
                        </a>
                        <a href="#" class="text-decoration-none me-3">
                            <i class="fab fa-discord fa-2x text-primary"></i>
                        </a>
                        <a href="#" class="text-decoration-none">
                            <i class="fab fa-stack-overflow fa-2x text-warning"></i>
                        </a>
                    </div>
                    <p class="text-muted mb-1">
                        <i class="fas fa-envelope me-2"></i>
                        <a href="mailto:support@electrodoc.com" class="text-decoration-none text-dark">
                            support@electrodoc.com
                        </a>
                    </p>
                    <p class="text-muted mb-0">
                        <i class="fas fa-comment me-2"></i>Technical Forum Available
                    </p>
                </div>
            </div>
            <hr class="mt-4">
            <div class="text-center text-muted">
                <p class="mb-0">&copy; {{ date('Y') }} ElectroDoc Electronics Tutorials. All technical content is open-source.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>