@extends('layouts.main')
@section('content')
    <div class="container my-5">
        <!-- Category Filter Buttons -->
        <div class="mb-4">
            <div class="d-flex flex-wrap gap-2 mb-3 justify-content-center">
                <a href="{{ route('posts.index') }}"
                    class="btn btn-outline-primary {{ !request()->has('category') ? 'active' : '' }}">
                    All Tutorials
                </a>
                <a href="{{ route('posts.index', ['category' => 'Sensors']) }}"
                    class="btn btn-outline-primary {{ request('category') == 'Sensors' ? 'active' : '' }}">
                    Sensors
                </a>
                <a href="{{ route('posts.index', ['category' => 'MicroController']) }}"
                    class="btn btn-outline-primary {{ request('category') == 'MicroController' ? 'active' : '' }}">
                    MicroController
                </a>
                <a href="{{ route('posts.index', ['category' => 'Resistor']) }}"
                    class="btn btn-outline-primary {{ request('category') == 'Resistor' ? 'active' : '' }}">
                    Resistor
                </a>
                <a href="{{ route('posts.index', ['category' => 'Capacitor']) }}"
                    class="btn btn-outline-primary {{ request('category') == 'Capacitor' ? 'active' : '' }}">
                    Capacitor
                </a>
            </div>

            @if (request()->has('category'))
                <div class="alert alert-info d-flex flex-column flex-sm-row align-items-start align-items-sm-center">
                    <div class="mb-2 mb-sm-0 d-flex align-items-center">
                        <i class="fas fa-filter me-2"></i>
                        <span>Showing tutorials in category: <strong
                                class="ms-1">{{ request('category') }}</strong></span>
                    </div>
                    <a href="{{ route('posts.index') }}" class="btn btn-sm btn-outline-info ms-sm-auto">
                        <i class="fas fa-times me-1"></i> Clear Filter
                    </a>
                </div>
            @endif
        </div>

        @if ($posts->count() < 1)
            <div class="my-6 p-5 text-center">
                <p class="lead">
                    @if (request()->has('category'))
                        No tutorials found in <strong>{{ request('category') }}</strong> category 😭
                    @else
                        No Tutorials Found 😭
                    @endif
                </p>
                @if (request()->has('category'))
                    <a href="{{ route('posts.index') }}" class="btn btn-primary mt-2">
                        <i class="fas fa-arrow-left me-1"></i> View All Tutorials
                    </a>
                @endif
            </div>
        @else
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <img class="card-img-top w-100 img-fluid"
                                src="{{ asset('storage/upload/posts/' . ($post->image ?? 'default.jpg')) }}"
                                alt="">
                            <div class="card-body">
                                <div class="mb-2">
                                    <span class="badge bg-primary">{{ $post->category ?? 'Electronics' }}</span>
                                </div>
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Views: {{ $post->views }}</span>
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-primary btn-sm">
                                        Read Tutorial
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Laravel Pagination Links -->
        @if ($posts->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $posts->links('pagination::bootstrap-5') }} </div>
        @endif
    </div>
@endsection
