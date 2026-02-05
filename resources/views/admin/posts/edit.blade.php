@extends('admin.layouts.main')
@section('content')
<div class="admin-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Edit Post</h1>
            <p class="text-muted mb-0">Update your blog post</p>
        </div>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Posts
        </a>
    </div>
</div>

<!-- Error Alert -->
@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i>
    <ul class="mb-0 ps-3">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Session Error -->
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i>
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Success Alert -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card mt-4">
    <div class="card-body">
        <form id="editPostForm" action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Title Field -->
            <div class="mb-3">
                <label for="postTitle" class="form-label fw-semibold">Post Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="postTitle" name="title"
                       value="{{ old('title', $post->title) }}"
                       placeholder="Enter post title here..." required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">The main title of your blog post</div>
            </div>

            <!-- Category Field -->
            <div class="mb-3">
                <label for="postCategory" class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                <select class="form-select @error('category') is-invalid @enderror" 
                        id="postCategory" name="category" required>
                    <option value="">Select a category</option>
                    <option value="Sensors" {{ old('category', $post->category) == 'Sensors' ? 'selected' : '' }}>Sensors</option>
                    <option value="MicroController" {{ old('category', $post->category) == 'MicroController' ? 'selected' : '' }}>MicroController</option>
                    <option value="Resistor" {{ old('category', $post->category) == 'Resistor' ? 'selected' : '' }}>Resistor</option>
                    <option value="Capacitor" {{ old('category', $post->category) == 'Capacitor' ? 'selected' : '' }}>Capacitor</option>
                </select>
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Choose the appropriate category for your post</div>
            </div>

            <!-- Current Image Display -->
            @if($post->image)
            <div class="mb-3">
                <label class="form-label fw-semibold">Current Image</label>
                <div class="border rounded p-3 bg-light">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('storage/upload/posts/' . $post->image) }}" 
                                 alt="Current image" 
                                 class="img-fluid rounded" 
                                 style="max-height: 80px; max-width: 120px;"
                                 id="currentImage">
                            <div class="ms-3 text-start">
                                <small class="text-muted d-block">Current featured image</small>
                                <small id="currentFileName">{{ basename($post->image) }}</small>
                            </div>
                        </div>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="removeImage" name="remove_image" value="1">
                                <label class="form-check-label text-danger" for="removeImage">
                                    <i class="fas fa-trash me-1"></i> Remove Image
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-text small">Check "Remove Image" to delete the current image</div>
            </div>
            @endif

            <!-- New Image Upload -->
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    @if($post->image)
                    Replace Image
                    @else
                    Add Featured Image
                    @endif
                </label>
                <div class="border rounded p-3 text-center bg-light">
                    <div id="imagePreview" class="d-none">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img src="" alt="Preview" class="img-fluid rounded" style="max-height: 80px; max-width: 120px;">
                                <div class="ms-3 text-start">
                                    <small class="text-muted d-block">New image selected</small>
                                    <small id="fileName"></small>
                                </div>
                            </div>
                            <button type="button" id="removeImageBtn" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                    <div id="imageUploadArea">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fas fa-image text-muted me-2"></i>
                            <div class="text-start">
                                <p class="mb-1 small">
                                    @if($post->image)
                                    Upload new image (optional)
                                    @else
                                    Upload featured image (optional)
                                    @endif
                                </p>
                                {{-- <button type="button" id="chooseImageBtn" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-upload"></i> Choose Image
                                </button> --}}
                                <input type="file" id="" name="image" accept="image/*" value="Chose Image">
                            </div>
                        </div>
                    </div>
                </div>
                @error('image')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <div class="form-text small">Recommended size: 1200×600px. Leave empty to keep current image.</div>
            </div>

            <!-- Content Field with Markdown Editor -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label for="postContent" class="form-label fw-semibold mb-0">Post Content <span class="text-danger">*</span></label>
                    <div class="text-muted small">
                        <i class="fas fa-info-circle"></i> Supports Markdown formatting
                    </div>
                </div>
                
                <!-- Textarea shows Markdown content -->
                <textarea class="form-control @error('content') is-invalid @enderror" 
                          id="postContent" name="content" rows="10" 
                          placeholder="Write your post content here using Markdown..." 
                          required>{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                <!-- Markdown Cheatsheet -->
                <div class="mt-3">
                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="collapse" data-bs-target="#markdownCheatsheet">
                        <i class="fas fa-question-circle me-1"></i> Markdown Help
                    </button>
                    <div class="collapse mt-2" id="markdownCheatsheet">
                        <div class="card card-body small">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong class="d-block mb-1">Headers:</strong>
                                    <code class="d-block"># H1</code>
                                    <code class="d-block">## H2</code>
                                    <code class="d-block">### H3</code>
                                </div>
                                <div class="col-md-4">
                                    <strong class="d-block mb-1">Text:</strong>
                                    <code class="d-block">*italic*</code>
                                    <code class="d-block">**bold**</code>
                                    <code class="d-block">~~strikethrough~~</code>
                                </div>
                                <div class="col-md-4">
                                    <strong class="d-block mb-1">Lists:</strong>
                                    <code class="d-block">- Item 1</code>
                                    <code class="d-block">- Item 2</code>
                                    <code class="d-block">1. First</code>
                                    <code class="d-block">2. Second</code>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <strong class="d-block mb-1">Links & Images:</strong>
                                    <code class="d-block">[link](url)</code>
                                    <code class="d-block">![alt](image-url)</code>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <strong class="d-block mb-1">Code:</strong>
                                    <code class="d-block">`inline code`</code>
                                    <code class="d-block">```code block```</code>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <strong class="d-block mb-1">Blockquotes:</strong>
                                    <code class="d-block">&gt; Quote text</code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-text small mt-2">
                    Write your content clearly using Markdown formatting. See the preview below.
                </div>
            </div>

            <!-- Live Preview Section -->
            <div class="card mb-4">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-newspaper me-2"></i> Article Preview
                    </h5>
                    <div>
                        <button type="button" class="btn btn-sm btn-outline-secondary me-2" onclick="updateArticlePreview()">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="scrollToTop()">
                            <i class="fas fa-arrow-up"></i> Go to Top
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <article id="articlePreview">
                        <div class="text-center text-muted p-4">
                            <i class="fas fa-paragraph fa-3x mb-3"></i>
                            <p class="mb-0">Start typing above to see your article preview here</p>
                            <small class="text-muted">Your formatted content will appear here as you type</small>
                        </div>
                    </article>
                </div>
            </div>

            <!-- Post Information -->
            <div class="mt-4 pt-3 border-top">
                <h6 class="fw-bold mb-3">
                    <i class="fas fa-info-circle text-info me-2"></i>
                    Post Information
                </h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="border rounded p-3">
                            <small class="text-muted d-block">Post ID</small>
                            <strong>{{ $post->id }}</strong>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3">
                            <small class="text-muted d-block">Created Date</small>
                            <strong>{{ $post->created_at->format('F j, Y, g:i a') }}</strong>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3">
                            <small class="text-muted d-block">Views</small>
                            <strong>{{ number_format($post->views ?? 0) }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Post
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Sticky Go to Top Button -->
<button id="goToTopBtn" class="btn btn-primary btn-lg rounded-circle shadow-lg" style="position: fixed; bottom: 30px; right: 30px; z-index: 1000; display: none; width: 60px; height: 60px;">
    <i class="fas fa-arrow-up"></i>
</button>
@endsection

@section('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script> --}}
{{-- <script>
    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize marked with options
        marked.setOptions({
            breaks: true,
            gfm: true,
            headerIds: false
        });

        // Initialize functions
        initializeFunctions();
        setupEventListeners();
        
        // Initial preview update with existing content
        if (document.getElementById('postContent') && document.getElementById('postContent').value.trim()) {
            updateArticlePreview();
        }
        
        // Initial check for scroll position
        toggleGoToTopButton();
    });

    // Initialize all functions
    function initializeFunctions() {
        // Image preview function
        window.previewImage = function(event) {
            const input = event.target;
            const file = input.files[0];
            
            if (file) {
                const reader = new FileReader();
                const fileName = document.getElementById('fileName');
                
                reader.onload = function() {
                    const imagePreview = document.getElementById('imagePreview');
                    const imageUploadArea = document.getElementById('imageUploadArea');
                    const img = imagePreview.querySelector('img');
                    
                    img.src = reader.result;
                    fileName.textContent = file.name.length > 20 ? file.name.substring(0, 20) + '...' : file.name;
                    imagePreview.classList.remove('d-none');
                    imageUploadArea.classList.add('d-none');
                    
                    // Update article preview if there's an image
                    updateArticlePreview();
                };
                
                reader.readAsDataURL(file);
            }
        };

        // Remove new image function
        window.removeImage = function() {
            const imagePreview = document.getElementById('imagePreview');
            const imageUploadArea = document.getElementById('imageUploadArea');
            const fileInput = document.getElementById('imageFile');
            
            imagePreview.classList.add('d-none');
            imageUploadArea.classList.remove('d-none');
            fileInput.value = '';
            
            updateArticlePreview();
        };

        // Update full article preview
        window.updateArticlePreview = function() {
            const title = document.getElementById('postTitle');
            const content = document.getElementById('postContent');
            const category = document.getElementById('postCategory');
            const articlePreview = document.getElementById('articlePreview');
            
            // Check if elements exist
            if (!title || !content || !category || !articlePreview) {
                console.log('Elements not found');
                return;
            }
            
            let html = '';
            
            // If no content yet
            if (!content.value.trim() && !title.value.trim()) {
                articlePreview.innerHTML = `
                    <div class="text-center text-muted p-4">
                        <i class="fas fa-paragraph fa-3x mb-3"></i>
                        <p class="mb-0">Start typing above to see your article preview here</p>
                        <small class="text-muted">Your formatted content will appear here as you type</small>
                    </div>`;
                return;
            }
            
            // Build the article preview
            if (title.value.trim()) {
                html += `<h1 class="mb-3">${escapeHtml(title.value)}</h1>`;
            }
            
            if (category.value) {
                html += `<span class="badge bg-primary mb-3 d-inline-block">${escapeHtml(category.value)}</span>`;
            }
            
            // Add metadata
            html += `<div class="text-muted mb-3">
                        <small><i class="fas fa-calendar me-1"></i> ${new Date().toLocaleDateString()} • 
                        <i class="fas fa-user ms-2 me-1"></i> Author</small>
                    </div>`;
            
            // Add featured image if exists (check new image first, then current)
            const imagePreview = document.getElementById('imagePreview');
            const currentImage = document.getElementById('currentImage');
            const removeImageCheckbox = document.getElementById('removeImage');
            
            // Show new image if selected
            if (imagePreview && !imagePreview.classList.contains('d-none')) {
                const img = imagePreview.querySelector('img');
                html += `<figure class="text-center mb-4">
                            <img src="${img.src}" alt="${escapeHtml(title.value)}" class="img-fluid rounded shadow-sm mb-2" style="max-height: 300px;">
                            <figcaption class="text-muted small">New Featured Image</figcaption>
                        </figure>`;
            }
            // Show current image if exists and not marked for removal
            else if (currentImage && (!removeImageCheckbox || !removeImageCheckbox.checked)) {
                html += `<figure class="text-center mb-4">
                            <img src="${currentImage.src}" alt="${escapeHtml(title.value)}" class="img-fluid rounded shadow-sm mb-2" style="max-height: 300px;">
                            <figcaption class="text-muted small">Current Featured Image</figcaption>
                        </figure>`;
            }
            
            // Add content
            if (content.value.trim()) {
                try {
                    // Parse with marked.js
                    const parsedContent = marked.parse(content.value);
                    
                    // If blockquotes aren't styled, add Bootstrap classes
                    const styledContent = parsedContent.replace(
                        /<blockquote>/g,
                        '<blockquote class="blockquote bg-light p-3 border-start border-primary border-3">'
                    );
                    
                    html += styledContent;
                } catch (error) {
                    html += `<div class="alert alert-warning">Error parsing content: ${error.message}</div>`;
                }
            }
            
            articlePreview.innerHTML = html;
        };

        // Scroll to top function
        window.scrollToTop = function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };

        // Escape HTML to prevent XSS
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
        window.escapeHtml = escapeHtml;

        // Show/hide go to top button based on scroll position
        function toggleGoToTopButton() {
            const goToTopBtn = document.getElementById('goToTopBtn');
            if (goToTopBtn) {
                if (window.scrollY > 300) {
                    goToTopBtn.style.display = 'block';
                } else {
                    goToTopBtn.style.display = 'none';
                }
            }
        }
        window.toggleGoToTopButton = toggleGoToTopButton;
    }

    // Setup all event listeners
    function setupEventListeners() {
        // Get elements
        const postContent = document.getElementById('postContent');
        const postTitle = document.getElementById('postTitle');
        const postCategory = document.getElementById('postCategory');
        const createPostForm = document.getElementById('editPostForm');
        const chooseImageBtn = document.getElementById('chooseImageBtn');
        const removeImageBtn = document.getElementById('removeImageBtn');
        const imageFile = document.getElementById('imageFile');
        const removeImageCheckbox = document.getElementById('removeImage');
        const goToTopBtn = document.getElementById('goToTopBtn');
        
        // Check if elements exist before adding listeners
        if (postContent) {
            // Update previews when content changes (with debounce)
            let previewTimeout;
            postContent.addEventListener('input', function() {
                clearTimeout(previewTimeout);
                previewTimeout = setTimeout(() => {
                    updateArticlePreview();
                }, 300);
            });
        }
        
        if (postTitle) {
            // Update article preview when title changes
            postTitle.addEventListener('input', updateArticlePreview);
        }
        
        if (postCategory) {
            // Update article preview when category changes
            postCategory.addEventListener('change', updateArticlePreview);
        }
        
        if (createPostForm) {
            // Form submission with validation
            createPostForm.addEventListener('submit', function(e) {
                const title = document.getElementById('postTitle').value.trim();
                const category = document.getElementById('postCategory').value;
                const content = document.getElementById('postContent').value.trim();
                
                if (!title) {
                    e.preventDefault();
                    alert('Please enter a post title');
                    document.getElementById('postTitle').focus();
                    return;
                }
                
                if (!category) {
                    e.preventDefault();
                    alert('Please select a category');
                    document.getElementById('postCategory').focus();
                    return;
                }
                
                if (!content) {
                    e.preventDefault();
                    alert('Please enter post content');
                    document.getElementById('postContent').focus();
                    return;
                }
                
                // Show loading state
                const submitBtn = e.target.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...';
                submitBtn.disabled = true;
            });
        }
        
        if (chooseImageBtn) {
            // Choose image button
            chooseImageBtn.addEventListener('click', function() {
                imageFile.click();
            });
        }
        
        if (removeImageBtn) {
            // Remove new image button
            removeImageBtn.addEventListener('click', removeImage);
        }
        
        if (imageFile) {
            // File input change
            imageFile.addEventListener('change', function(event) {
                previewImage(event);
            });
        }
        
        if (removeImageCheckbox) {
            // Remove current image checkbox
            removeImageCheckbox.addEventListener('change', function() {
                updateArticlePreview();
            });
        }
        
        if (goToTopBtn) {
            // Initialize go to top button
            goToTopBtn.addEventListener('click', scrollToTop);
            
            // Show/hide button on scroll
            window.addEventListener('scroll', toggleGoToTopButton);
        }
    }
</script> --}}
@endsection