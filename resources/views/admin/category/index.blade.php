@extends('admin.includes.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Category List</h1>
            <a href="{{ route('category.create') }}" class="btn btn-primary"><i class="align-middle"
                    data-feather="plus"></i> Add Category</a>
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
                        @if(count($categories)>0)
                        <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Title</th>

                                    <th>Is Parent</th>
                                    <th>Parent Category</th>
                                    <th>Photo</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($categories as $category)
                                @php
                                @endphp
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->title}}</td>

                                    <td>{{(($category->is_parent==1)? 'Yes': 'No')}}</td>
                                    <td>
                                        {{$category->parent_info->title ?? ''}}
                                    </td>
                                    <td>
                                        @if($category->photo)
                                        <img src="{{ asset($category->photo) }}" class="img-fluid"
                                            style="max-width:80px" alt="{{ $category->photo }}">
                                        @else
                                        <img src="{{ asset('backend/img/thumbnail-default.jpg') }}" class="img-fluid"
                                            style="max-width:80px" alt="avatar.png">
                                        @endif
                                    </td>

                                    <td>
                                        @if($category->status=='active')
                                        <span class="badge bg-success">{{$category->status}}</span>
                                        @else
                                        <span class="badge bg-warning">{{$category->status}}</span>
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        <a href="{{ route('category.edit', $category->id) }}"
                                            class="btn btn-sm btn-outline-info me-2" title="Edit">
                                            <i class="align-middle" data-feather="edit"></i>
                                        </a>


                                        <form method="POST" action="{{ route('category.destroy', [$category->id]) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this category?');">
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
                        <span style="float:right">{{$categories->links()}}</span>
                        @else
                        <h6 class="text-center">No Categories found!!! Please create Category</h6>
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