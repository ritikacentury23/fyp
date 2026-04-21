@extends('admin.includes.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Brand List</h1>
            <a href="{{ route('brand.create') }}" class="btn btn-primary"><i class="align-middle"
                    data-feather="plus"></i> Add Brand</a>
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
                        @if(count($brands)>0)
                        <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($brands as $brand)
                                <tr>
                                    <td>{{$brand->id}}</td>
                                    <td>{{$brand->title}}</td>

                                    <td>
                                        @if($brand->status=='active')
                                        <span class="badge bg-success">{{$brand->status}}</span>
                                        @else
                                        <span class="badge bg-warning">{{$brand->status}}</span>
                                        @endif
                                    </td>

                                    <td class="d-flex">
                                        <a href="{{ route('brand.edit', $brand->id) }}"
                                            class="btn btn-sm btn-outline-info me-2" title="Edit">
                                            <i class="align-middle" data-feather="edit"></i>
                                        </a>


                                        <form method="POST" action="{{ route('brand.destroy', [$brand->id]) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this brand?');">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                <i class="align-middle" data-feather="trash"></i>
                                            </button>
                                        </form>



                                    </td>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <span style="float:right">{{$brands->links()}}</span>
                        @else
                        <h6 class="text-center">No author found!!! Please create author</h6>
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