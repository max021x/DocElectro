<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/fontawesome.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white fixed-top shadow-sm @isset($dnone) d-none @endisset">
        <div class="container-fluid container-lg">

            <!-- Brand Logo -->
            <a class="navbar-brand fw-bold fs-4 text-primary d-flex align-items-center" href="/">
                <i class="fas fa-bolt me-2"></i>ElectroDoc
            </a>

            <!-- Search Box - Visible on medium and larger screens -->
            <div class="d-none d-lg-flex flex-grow-1 justify-content-center mx-4">
                <form action="/posts" method="GET">
                    <input type="hidden" name="page" value="1">
                    <div class="input-group" style="max-width: 500px;">
                        <input type="text" name="search" class="form-control border-primary"
                            placeholder="Search products...">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <!-- Desktop Navigation -->
            <div class="d-none d-lg-flex align-items-center ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mx-2">
                        <a class="nav-link text-dark" href="/">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link text-dark" href="/posts?page=1">Posts</a>
                    </li>
                    @if(auth()->user())
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link dropdown-toggle d-flex align-items-center text-dark" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle fa-lg me-2"></i>
                            Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                            <li>
                                <form action="/logout" method="POST" class="d-inline">
                                    @csrf
                                    <div class="d-grid">
                                        <button class="btn btn-link text-danger p-0 border-0 text-decoration-none"
                                            type="submit">Logout
                                            <i class="fas fa-power-off me-2"></i>
                                        </button>
                                    </div>
                                </form>
                            </li>
                            {{-- @if(check('dashboard'))
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="/admin/dashboard">
                                    <i class="fas fa-cog me-2"></i>Admin Dashboard
                                </a>
                            </li>
                            @endif --}}
                        </ul>
                    </li>
                    @else
                    <li class="nav-item mx-2">
                        <a class="nav-link text-dark" href="/login">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    </li>
                    @endif
                    <li class="nav-item mx-2">
                        <a class="nav-link text-dark" href="/#contact">Contact</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a href="#" class="nav-link text-dark">
                            <i class="fab fa-github"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Mobile Menu Button -->
            <div class="d-flex align-items-center d-lg-none">
                @if(auth()->user())
                <div class="dropdown me-3">
                    <a class="nav-link dropdown-toggle d-flex align-items-center text-dark" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle fa-lg"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                        <li>
                            <a class="dropdown-item text-danger d-flex align-items-center" href="#">
                                <i class="fas fa-power-off me-2"></i>
                                <form action="/logout" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-link text-danger p-0 border-0 text-decoration-none"
                                        type="submit">Logout</button>
                                </form>
                            </a>
                        </li>
                        {{-- @if(check('dashboard'))
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="/admin/dashboard">
                                <i class="fas fa-cog me-2"></i>Admin
                            </a>
                        </li>
                        @endif --}}
                    </ul>
                </div>
                @endif
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#electroNav">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
            </div>

        </div>
    </nav>

    <!-- Mobile Offcanvas Sidebar -->
    <div class="offcanvas offcanvas-end" id="electroNav" tabindex="-1">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fw-bold text-primary">
                <i class="fas fa-bolt me-2"></i>ElectroShop
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav">
                <li class="nav-item mb-2">
                    <a class="nav-link text-dark d-flex align-items-center" href="/">
                        <i class="fas fa-home me-3"></i>Home
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-dark d-flex align-items-center" href="/posts">
                        <i class="fas fa-newspaper me-3"></i>Posts
                    </a>
                </li>
                @if(auth()->user())
                <li class="nav-item mb-2">
                    <a class="nav-link text-dark d-flex align-items-center" href="/login">
                        <i class="fas fa-sign-in-alt me-3"></i>Login
                    </a>
                </li>
                @endif
                <li class="nav-item mb-2">
                    <a class="nav-link text-dark d-flex align-items-center" href="/#contact">
                        <i class="fas fa-phone me-3"></i>Contact
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#" class="nav-link text-dark d-flex align-items-center">
                        <i class="fab fa-github me-3"></i>GitHub
                    </a>
                </li>

                <!-- Mobile Search -->
                <li class="nav-item mt-4">
                    <hr>
                    <form action="/posts" method="GET" class="mt-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control border-primary" placeholder="Search...">
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


    <footer class="footer bg-light py-4 @isset($dnone) d-none @endisset">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-3">About ElectroShop</h5>
                    <p class="text-muted">
                        Your one-stop destination for all electronic needs. We offer quality products
                        with the best prices and customer service in the industry.
                    </p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="fas fa-angle-right me-2"></i>Terms & Conditions
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="fas fa-angle-right me-2"></i>Privacy Policy
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none text-dark">
                                <i class="fas fa-angle-right me-2"></i>Return Policy
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/" class="text-decoration-none text-dark">
                                <i class="fas fa-angle-right me-2"></i>Home
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3">Connect With Us</h5>
                    <div class="mb-4">
                        <a href="#" class="text-decoration-none me-3">
                            <i class="fab fa-facebook fa-2x text-primary"></i>
                        </a>
                        <a href="#" class="text-decoration-none me-3">
                            <i class="fab fa-twitter fa-2x text-info"></i>
                        </a>
                        <a href="#" class="text-decoration-none me-3">
                            <i class="fab fa-instagram fa-2x text-danger"></i>
                        </a>
                        <a href="#" class="text-decoration-none">
                            <i class="fab fa-youtube fa-2x text-danger"></i>
                        </a>
                    </div>
                    <p class="text-muted mb-1">
                        <i class="fas fa-envelope me-2"></i>
                        <a href="mailto:support@electroshop.com" class="text-decoration-none text-dark">
                            support@electroshop.com
                        </a>
                    </p>
                    <p class="text-muted mb-0">
                        <i class="fas fa-phone me-2"></i>+1 (555) 123-4567
                    </p>
                </div>
            </div>
            <hr class="mt-4">
            <div class="text-center text-muted">
                <p class="mb-0">&copy; 2024 ElectroShop. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/script.js"></script>
</body>

</html>