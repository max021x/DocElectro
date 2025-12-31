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
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i>
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Success Alert -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
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
                <input type="text" class="form-control" id="postTitle" name="title"
                       value="{{ old('title', $post->title) }}"
                       placeholder="Enter post title here..." required>
                <div class="form-text">The main title of your blog post</div>
            </div>

            <!-- Category Field -->
            <div class="mb-3">
                <label for="postCategory" class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                <select class="form-select" id="postCategory" name="category" required>
                    <option value="">Select a category</option>
                    <option value="Sensors" {{ old('category', $post->category) === 'Sensors' ? 'selected' : '' }}>Sensors</option>
                    <option value="MicroController" {{ old('category', $post->category) === 'MicroController' ? 'selected' : '' }}>MicroController</option>
                    <option value="Resistor" {{ old('category', $post->category) === 'Resistor' ? 'selected' : '' }}>Resistor</option>
                    <option value="Capacitor" {{ old('category', $post->category) === 'Capacitor' ? 'selected' : '' }}>Capacitor</option>
                </select>
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
                                 style="max-height: 80px; max-width: 120px;">
                            <div class="ms-3 text-start">
                                <small class="text-muted d-block">Current featured image</small>
                                <small>{{ basename($post->image) }}</small>
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
                                <button type="button" id="chooseImageBtn" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-upload"></i> Choose Image
                                </button>
                                <input type="file" id="imageFile" name="image" class="d-none" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-text small">Recommended size: 1200×600px. Leave empty to keep current image.</div>
            </div>

            <!-- Content Field -->
            <div class="mb-3">
                <label for="postContent" class="form-label fw-semibold">Post Content <span class="text-danger">*</span></label>
                <textarea class="form-control" id="postContent" name="content" rows="6" 
                          placeholder="Write your post content here..." required>{{ old('content', $post->content) }}</textarea>
                <div class="form-text small">
                    Write your content clearly and engagingly
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
                            <strong>{{ $post->created_at }}</strong>
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
@endsection

@section('scripts')
<script>
    // Get DOM elements
    const imageFileInput = document.getElementById('imageFile');
    const chooseImageBtn = document.getElementById('chooseImageBtn');
    const removeImageBtn = document.getElementById('removeImageBtn');
    const imagePreview = document.getElementById('imagePreview');
    const imageUploadArea = document.getElementById('imageUploadArea');
    const fileName = document.getElementById('fileName');
    
    // Event listener for choose image button
    chooseImageBtn.addEventListener('click', function() {
        imageFileInput.click();
    });
    
    // Event listener for file input change
    imageFileInput.addEventListener('change', function(event) {
        previewImage(event);
    });
    
    // Event listener for remove image button
    removeImageBtn.addEventListener('click', function() {
        removeImage();
    });
    
    // Image preview function
    function previewImage(event) {
        const input = event.target;
        const file = input.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function() {
                const img = imagePreview.querySelector('img');
                
                img.src = reader.result;
                fileName.textContent = file.name.length > 20 ? file.name.substring(0, 20) + '...' : file.name;
                imagePreview.classList.remove('d-none');
                imageUploadArea.classList.add('d-none');
            };
            
            reader.readAsDataURL(file);
        }
    }

    // Remove image function
    function removeImage() {
        imagePreview.classList.add('d-none');
        imageUploadArea.classList.remove('d-none');
        imageFileInput.value = '';
    }

    // Form submission with validation
    document.getElementById('editPostForm').addEventListener('submit', function(e) {
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
</script>
@endsection