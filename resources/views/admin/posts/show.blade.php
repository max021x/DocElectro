@extends('admin.layouts.main')
@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-light">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Post ID: <span class="badge bg-secondary">{{ $post->id }}</span></h5>
            <small class="text-muted">Post Details</small>
        </div>
    </div>
    
    <div class="card-body">
        <!-- Category Badge -->
        <div class="mb-3">
            @if(!empty($post->category))
                <span class="badge bg-primary px-3 py-2">
                    <i class="fas fa-tag me-1"></i>
                    {{ $post->category }}
                </span>
            @else
                <span class="badge bg-secondary px-3 py-2">
                    <i class="fas fa-tag me-1"></i>
                    No Category
                </span>
            @endif
        </div>
        
        <h2 class="card-title mb-4">{{ $post->title }}</h2>
        
        @if($post->image)
        <div class="mb-4">
            <div class="text-center">
                <img src="{{ asset('storage/upload/posts/' . $post->image) }}" 
                     alt="{{ $post->title }}" 
                     class="img-fluid rounded shadow-sm" 
                     style="max-height: 300px;">
            </div>
        </div>
        @endif
        
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h6 class="mb-0">Content</h6>
            </div>
            <div class="card-body">
                <div class="lh-lg post-content">
                    {!! $post->content !!}
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h6 class="mb-0 d-flex align-items-center">
                            <i class="fas fa-calendar-alt me-2 text-muted"></i>
                            Created
                        </h6>
                    </div>
                    <div class="card-body">
                        <p class="mb-2">
                            {{ $post->created_at->format('F j, Y, g:i a') }}
                        </p>
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            Created date
                        </small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h6 class="mb-0 d-flex align-items-center">
                            <i class="fas fa-eye me-2 text-muted"></i>
                            Views
                        </h6>
                    </div>
                    <div class="card-body">
                        <h4 class="mb-0">{{ number_format($post->views ?? 0) }}</h4>
                        <small class="text-muted">Total views</small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h6 class="mb-0 d-flex align-items-center">
                            <i class="fas fa-image me-2 text-muted"></i>
                            Image Info
                        </h6>
                    </div>
                    <div class="card-body">
                        @if($post->image)
                            <p class="mb-2">
                                <i class="fas fa-check-circle me-2 text-success"></i>
                                Image attached
                            </p>
                            <small class="text-muted d-block">
                                {{ basename($post->image) }}
                            </small>
                        @else
                            <p class="mb-0 text-muted">
                                <i class="fas fa-times-circle me-2"></i>
                                No image
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card-footer bg-light">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex gap-2">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back to Posts
                </a>
                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit me-1"></i> Edit Post
                </a>
            </div>
            <div class="text-muted small">
                <i class="fas fa-info-circle me-1"></i>
                Last updated: 
                @if($post->updated_at && $post->updated_at != $post->created_at)
                    {{ $post->updated_at->format('F j, Y, g:i a') }}
                @else
                    Not updated yet
                @endif
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