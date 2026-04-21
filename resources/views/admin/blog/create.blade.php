@extends('admin.includes.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Create Blog Post</h1>
            <a href="{{ route('admin.blog.index') }}" class="btn btn-primary"><i class="align-middle" data-feather="arrow-left"></i> Back</a>
        </div>
        <div class="row">
            <div class="card shadow mb-4 w-100">
                <div class="col-md-12">@include('admin.includes.notification')</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Blog post title" required>
                                    @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Summary</label>
                                    <textarea name="summary" class="form-control" rows="3" placeholder="Short description shown on listing page">{{ old('summary') }}</textarea>
                                    @error('summary')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Content <span class="text-danger">*</span></label>
                                    <textarea name="content" id="blogContent" class="form-control" rows="12">{{ old('content') }}</textarea>
                                    @error('content')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Cover Photo</label>
                                    <input type="file" name="photo" class="form-control" id="photoInput" accept="image/*">
                                    <div id="photoPreview" class="mt-2"></div>
                                    @error('photo')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Author</label>
                                    <input type="text" name="author" value="{{ old('author', 'Admin') }}" class="form-control" placeholder="Author name">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Tags</label>
                                    <input type="text" name="tags" value="{{ old('tags') }}" class="form-control" placeholder="e.g. food, health, organic">
                                    <small class="text-muted">Comma-separated tags</small>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="col-form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-success w-100">Publish Post</button>
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
    document.getElementById('photoInput').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photoPreview').innerHTML = '<img src="' + e.target.result + '" class="img-fluid rounded" style="max-height:200px">';
        };
        reader.readAsDataURL(this.files[0]);
    });
});
</script>
@endpush
@endsection
