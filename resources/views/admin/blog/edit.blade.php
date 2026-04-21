@extends('admin.includes.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Edit Blog Post</h1>
            <a href="{{ route('admin.blog.index') }}" class="btn btn-primary"><i class="align-middle" data-feather="arrow-left"></i> Back</a>
        </div>
        <div class="row">
            <div class="card shadow mb-4 w-100">
                <div class="col-md-12">@include('admin.includes.notification')</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.blog.update', $blog->id) }}" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" value="{{ old('title', $blog->title) }}" class="form-control" required>
                                    @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Summary</label>
                                    <textarea name="summary" class="form-control" rows="3">{{ old('summary', $blog->summary) }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Content <span class="text-danger">*</span></label>
                                    <textarea name="content" id="blogContent" class="form-control" rows="12">{{ old('content', $blog->content) }}</textarea>
                                    @error('content')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Cover Photo</label>
                                    @if($blog->photo)
                                        <div class="mb-2">
                                            <img src="{{ asset($blog->photo) }}" class="img-fluid rounded" style="max-height:150px" alt="Current photo">
                                            <small class="text-muted d-block mt-1">Current photo</small>
                                        </div>
                                    @endif
                                    <input type="file" name="photo" class="form-control" id="photoInput" accept="image/*">
                                    <div id="photoPreview" class="mt-2"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Author</label>
                                    <input type="text" name="author" value="{{ old('author', $blog->author) }}" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Tags</label>
                                    <input type="text" name="tags" value="{{ old('tags', $blog->tags) }}" class="form-control" placeholder="Comma-separated tags">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option value="active" {{ $blog->status == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $blog->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-success w-100">Update Post</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    feather.replace();
    document.getElementById('photoInput').addEventListener('change', function() {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photoPreview').innerHTML = '<img src="' + e.target.result + '" class="img-fluid rounded" style="max-height:150px">';
        };
        reader.readAsDataURL(this.files[0]);
    });
});
</script>
@endpush
@endsection
