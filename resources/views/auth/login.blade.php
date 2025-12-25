@extends('layouts.main')
@section('content')

{{-- error alert --}}
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="alert mt-1 alert-warning alert-dismissible fade show" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <p class="mb-0"><?= htmlspecialchars($error) ?></p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div> --}}

<div class="d-flex justify-content-center mt-6 position-relative">
    <img src="images/svg/decoration-star.svg" alt=""
        class="decoration-star position-absolute start-0 w-50 d-none d-md-block" />
    <div class="card py-5 px-3 w-100" style="max-width: 500px;">
        <div class="card-body">
            <form action="/login" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="email"
                        placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary btn-lg">Login</button>
                </div>
                <div class="mt-3 text-center">
                    <a href="" class="text-decoration-none">Forgot Password?</a>
                </div>
                <div class="mt-2 text-center">
                    <a href="/register" class="text-decoration-none">
                        Create new Account <i class="fas fa-hand-point-left ms-1"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection