@extends('admin.includes.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Brand Create</h1>
            <a href="{{ route('brand.index') }}" class="btn btn-primary"><i class="align-middle"
                    data-feather="arrow-left"></i> Back</a>
        </div>

        <div class="row">
            <div class="card shadow mb-4 w-100">
                <div class="row">
                    <div class="col-md-12">
                        @include('admin.includes.notification')
                    </div>
                </div>

                <div class="card-body">
                    <form method="post" action="{{route('brand.store')}}">
                        {{csrf_field()}}
                        <div class="form-group mb-3 mt-4">
                            <label for="inputTitle" class="col-form-label">Title <span
                                    class="text-danger">*</span></label>
                            <input id="inputTitle" type="text" name="title" placeholder="Enter Brand Name"
                                value="{{old('title')}}" class="form-control">
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3 mt-4">
                            <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3 mt-4">
                           
                            <button class="btn btn-success" type="submit">Submit</button>
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
});
</script>
@endpush
@endsection