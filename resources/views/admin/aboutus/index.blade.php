@extends('admin.includes.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">About Us List</h1>
            <a href="{{ route('aboutus.create') }}" class="btn btn-primary"><i class="align-middle"
                    data-feather="plus"></i> Add About Us</a>
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
                        @if(count($aboutus)>0)
                        <table class="table table-bordered" id="aboutus-dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Description</th>
                                    <th>Photo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($aboutus as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>
                                        {{ Str::limit($item->description, 100, '...') }}
                                    </td>
                                    <td>
                                        @if($item->image)
                                        <img src="{{ asset($item->image) }}" class="img-fluid"
                                            style="max-width:80px" alt="{{ $item->image }}">
                                        @else
                                        <img src="{{ asset('backend/img/thumbnail-default.jpg') }}" class="img-fluid"
                                            style="max-width:80px" alt="avatar.png">
                                        @endif
                                    </td>

                                    <td class="d-flex">
                                        <a href="{{ route('aboutus.edit', $item->id) }}"
                                            class="btn btn-sm btn-outline-info me-2" title="Edit">
                                            <i class="align-middle" data-feather="edit"></i>
                                        </a>

                                        <form method="POST" action="{{ route('aboutus.destroy', [$item->id]) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this About Us entry?');">
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
                        @else
                        <h6 class="text-center">No About Us found!!! Please create About Us entry</h6>
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