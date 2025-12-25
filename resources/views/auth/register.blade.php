@extends('layouts.main')
@section('content')
    <div class="d-flex justify-content-center mt-6 position-relative">
        <img src="images/svg/decoration-star.svg" alt="" class="decoration-star position-absolute start-0 w-50" />
        <div class="card py-5 px-3" style="width: 500px;">
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">User name</label>
                        <input type="name" class="form-control" name="name" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password-confirm" id="password">
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary btn-lg">Login</button>
                    </div>
                    <div class="mt-3 mx-2">
                        <a href="">Forgot Password ?</a>
                    </div>
                    <div class="mt-2 mx-2">
                        <a href="/register">Create new Account <i class="fas fa-hand-o-left"></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
