@extends('admin.includes.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Blog Posts</h1>
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary"><i class="align-middle" data-feather="plus"></i> Add Post</a>
        </div>
        <div class="row">
            <div class="card shadow mb-4 w-100">
                <div class="col-md-12">@include('admin.includes.notification')</div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if(count($blogs) > 0)
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Photo</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blogs as $blog)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($blog->photo)
                                            <img src="{{ asset($blog->photo) }}" class="img-fluid" style="max-width:70px;border-radius:4px" alt="{{ $blog->title }}">
                                        @else
                                            <img src="{{ asset('backend/img/thumbnail-default.jpg') }}" class="img-fluid" style="max-width:70px" alt="default">
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($blog->title, 50) }}</td>
                                    <td>{{ $blog->author }}</td>
                                    <td>
                                        @if($blog->status == 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $blog->created_at->format('M d, Y') }}</td>
                                    <td class="d-flex gap-1">
                                        <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                            <i class="align-middle" data-feather="edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.blog.destroy', $blog->id) }}" onsubmit="return confirm('Delete this blog post?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                <i class="align-middle" data-feather="trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <span class="float-end">{{ $blogs->links() }}</span>
                        @else
                        <h6 class="text-center">No blog posts found. Create your first post!</h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@push('scripts')
<script>document.addEventListener('DOMContentLoaded', function() { feather.replace(); });</script>
@endpush
@endsection
