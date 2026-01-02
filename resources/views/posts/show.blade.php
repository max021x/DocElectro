@extends('layouts.main')
@section('content')


    <div class="container py-5">
        <!-- Error Alert -->
        @if (session('error'))
            <div class="row justify-content-center mb-3">
                <div class="col-12 col-lg-10 col-xl-9">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-9">

                <!-- Back Navigation -->
                <div class="mb-4">
                    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary btn-sm px-3 py-2">
                        <i class="fas fa-arrow-left me-2"></i>Back to Tutorials
                    </a>
                </div>

                <!-- Main Post Content Card -->
                <div class="card shadow-lg mb-5">
                    <!-- Post Header -->
                    <div class="card-header bg-white border-bottom py-4 px-4 px-md-5">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            @if (isset($post->category))
                                <span class="badge bg-primary px-3 py-2 mb-2">
                                    <i class="fas fa-microchip me-1"></i>
                                    {{ $post->category }}
                                </span>
                            @endif

                            <div class="text-muted d-flex align-items-center gap-3">
                                @if (isset($post->created_at))
                                    <span class="d-flex align-items-center fs-6 fs-md-base">
                                        <i class="fas fa-calendar-alt me-2"></i>
                                        {{ $post->created_at->format('F j, Y') }}
                                    </span>
                                @endif
                                <span class="d-flex align-items-center fs-6 fs-md-base">
                                    <i class="fas fa-eye me-2"></i>
                                    {{ number_format($post->views) }} views
                                </span>
                            </div>
                        </div>

                        <h1 class="display-6 fw-bold mb-0 fs-3 fs-md-2 fs-lg-1">{{ $post->title }}</h1>
                    </div>

                    <!-- Featured Image -->
                    @if ($post->image)
                        <div class="p-4 p-md-5">
                            <img src="{{ asset('storage/upload/posts/' . $post->image) }}" alt="{{ $post->title }}"
                                class="img-fluid rounded w-100 shadow" style="max-height: 500px; object-fit: cover;">
                        </div>
                    @endif

                    <!-- Post Content -->
                    <div class="card-body px-4 px-md-5 py-4 py-md-5">
                        <div class="post-content fs-6 fs-md-5 lh-lg">
                            {!! $post->content !!}
                        </div>
                    </div>

                    <!-- Post Footer Actions -->
                    <div class="card-footer bg-light py-4 px-4 px-md-5">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <!-- Save button only -->
                            <form action="{{ route('posts.save', $post->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-info btn-sm px-3 fs-6">
                                    <i class="fas fa-bookmark me-1"></i> Save Tutorial
                                </button>
                            </form>

                            <!-- Category and Author Info -->
                            <div class="d-flex align-items-center gap-4">
                                @if (isset($post->category))
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <i class="fas fa-tag fa-lg text-primary"></i>
                                        </div>
                                        <div class="fs-6 fs-md-base">
                                            <small class="text-muted d-block">Category</small>
                                            <strong>{{ $post->category }}</strong>
                                        </div>
                                    </div>
                                @endif

                                <!-- Author Info -->
                                @if (isset($post->user->name))
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="fas fa-user-circle fa-2x fa-lg fa-md-2x text-secondary"></i>
                                        </div>
                                        <div class="fs-6 fs-md-base">
                                            <small class="text-muted d-block">Written by</small>
                                            <strong>{{ $post->user->name }}</strong>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comment Section -->
                <div class="card shadow-lg mb-4">
                    <div class="card-header bg-white py-4 px-4 px-md-5">
                        <h3 class="mb-0 d-flex align-items-center fs-4 fs-md-3">
                            <i class="fas fa-comments me-3 text-primary"></i>
                            Technical Discussion
                            <span class="badge bg-primary ms-3 px-3 py-2 fs-6">{{ $comments->count() }}</span>
                        </h3>
                    </div>

                    <!-- Comment Form -->
                    <div class="card-body px-4 px-md-5 py-4 py-md-5">
                        <h5 class="mb-4 fs-5 fs-md-4">Share your technical insights</h5>
                        <form action="{{ route('comments.store', $post->id) }}/#commentContent" method="POST">
                            @csrf
                            <div class="mb-4">
                                <textarea class="form-control p-3 fs-6" id="commentContent" name="content" rows="4"
                                    placeholder="Share your circuit insights, modifications, or questions..."></textarea>
                                <div class="text-danger pt-1">
                                    @error('content')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4 py-2 fs-6">
                                    <i class="fas fa-paper-plane me-2"></i>Post Comment
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Comments List -->
                    <div class="px-4 px-md-5 pb-4 pb-md-5">
                        <h5 class="mb-4 border-bottom pb-3 fs-5 fs-md-4">Technical Discussion</h5>

                        @if ($comments->isEmpty())
                            <div class="text-center py-5">
                                <i class="fas fa-comment-slash fa-3x fa-2x fa-md-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0 fs-6">No technical discussion yet. Start the conversation!</p>
                            </div>
                        @else
                            <div class="row g-4">
                                @foreach ($comments as $comment)
                                    <div class="col-12">
                                        <div class="card border-light shadow-sm">
                                            <div class="card-body p-4">
                                                <div class="d-flex align-items-start mb-3">
                                                    <div class="me-3">
                                                        <div class="bg-light rounded-circle p-2">
                                                            <i class="fas fa-user-circle fa-lg fa-md-lg text-secondary"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                                            <div>
                                                                <h6 class="mb-0 fs-6">
                                                                    {{ $comment->user->name ?? 'Anonymous' }}</h6>
                                                                <small class="text-muted fs-6">
                                                                    <i class="fas fa-clock me-1"></i>
                                                                    {{ $comment->created_at->format('M j, Y \a\t g:i A') }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                        <p class="mb-0 fs-6">
                                                            {!! nl2br(e($comment->content)) !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Related Actions -->
                <div class="d-flex flex-wrap justify-content-between align-items-center mt-4">
                    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary px-4 py-2 mb-2 fs-6">
                        <i class="fas fa-list me-2"></i>View All Tutorials
                    </a>
                </div>

            </div>
        </div>
    </div>

    <style>
        .post-content {
            line-height: 1.6;
            color: #333;
        }

        .post-content h1,
        .post-content h2,
        .post-content h3,
        .post-content h4,
        .post-content h5,
        .post-content h6 {
            margin-top: 1.5em;
            margin-bottom: 0.75em;
            font-weight: 600;
            line-height: 1.25;
        }

        .post-content h1 {
            font-size: 2em;
            border-bottom: 1px solid #eaecef;
            padding-bottom: 0.3em;
        }

        .post-content h2 {
            font-size: 1.5em;
            border-bottom: 1px solid #eaecef;
            padding-bottom: 0.3em;
        }

        .post-content h3 {
            font-size: 1.25em;
        }

        .post-content p {
            margin-bottom: 1em;
        }

        .post-content ul,
        .post-content ol {
            padding-left: 2em;
            margin-bottom: 1em;
        }

        .post-content li {
            margin-bottom: 0.25em;
        }

        .post-content blockquote {
            padding: 0 1em;
            color: #6a737d;
            border-left: 0.25em solid #dfe2e5;
            margin: 0 0 1em 0;
            font-style: italic;
        }

        .post-content pre {
            background-color: #f6f8fa;
            border-radius: 6px;
            padding: 16px;
            overflow: auto;
            margin-bottom: 1em;
            font-family: ui-monospace, SFMono-Regular, SF Mono, Menlo, Consolas, Liberation Mono, monospace;
            font-size: 85%;
        }

        .post-content code {
            background-color: rgba(175, 184, 193, 0.2);
            border-radius: 6px;
            padding: 0.2em 0.4em;
            font-family: ui-monospace, SFMono-Regular, SF Mono, Menlo, Consolas, Liberation Mono, monospace;
            font-size: 85%;
        }

        .post-content pre code {
            background-color: transparent;
            padding: 0;
            font-size: 100%;
        }

        .post-content table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 1em;
            border: 1px solid #dfe2e5;
        }

        .post-content table th,
        .post-content table td {
            border: 1px solid #dfe2e5;
            padding: 6px 13px;
            text-align: left;
        }

        .post-content table th {
            font-weight: 600;
            background-color: #f6f8fa;
        }

        .post-content table tr:nth-child(2n) {
            background-color: #f6f8fa;
        }

        .post-content img {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
            margin: 1em 0;
        }

        .post-content a {
            color: #0366d6;
            text-decoration: none;
        }

        .post-content a:hover {
            text-decoration: underline;
        }

        .post-content hr {
            height: 0.25em;
            padding: 0;
            margin: 24px 0;
            background-color: #e1e4e8;
            border: 0;
        }
    </style>
@endsection
