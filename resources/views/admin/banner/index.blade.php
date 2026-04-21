@extends('admin.includes.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Banner List</h1>
            <a href="{{ route('banner.create') }}" class="btn btn-primary"><i class="align-middle"
                    data-feather="plus"></i> Add Banner</a>
        </div>

        <div class="row">
            <div class="card shadow mb-4 w-100">
                <div class="row">
                    <div class="col-md-12">
                        @include('admin.includes.notification')
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        @if(count($banners)>0)
                        <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Photo</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($banners as $banner)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $banner->title }}</td>
                                    <td>{{ $banner->slug }}</td>
                                    <td>
                                        @if($banner->photo)
                                        <img src="{{ asset($banner->photo) }}" class="img-fluid zoom"
                                            style="max-width:80px" alt="{{ $banner->title }}">
                                        @else
                                        <img src="{{ asset('backend/img/thumbnail-default.jpg') }}"
                                            class="img-fluid zoom" style="max-width:80px" alt="default">
                                        @endif
                                    </td>
                                    <td>
                                        @if($banner->status=='active')
                                        <span class="badge bg-success">{{ $banner->status }}</span>
                                        @else
                                        <span class="badge bg-warning text-dark">{{ $banner->status }}</span>
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        <a href="{{ route('banner.edit', $banner->id) }}"
                                            class="btn btn-sm btn-outline-info me-2" title="Edit">
                                            <i class="align-middle" data-feather="edit"></i>
                                        </a>


                                        <form method="POST" action="{{ route('banner.destroy', [$banner->id]) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this banner?');">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                <i class="align-middle" data-feather="trash"></i>
                                            </button>
                                        </form>


                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <span class="float-end">{{ $banners->links() }}</span>
                        @else
                        <h6 class="text-center">No banners found! Please create a banner.</h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    feather.replace();
});
</script>
@endpush
@endsection