@extends('admin.includes.main')
@push('styles')

@endpush

@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Create About Us</h1>
            <a href="{{ route('aboutus.index') }}" class="btn btn-primary"><i class="align-middle"
                    data-feather="arrow-left"></i> Back</a>
        </div>

        <div class="row">
            <div class="card shadow mb-4 w-100">
                <div class="row">
                    <div class="col-md-12">
                        @include('admin.includes.notification')
                    </div>
                </div>

                <div class="card-body p-4">
                    <form method="post" action="{{route('aboutus.store')}}" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="inputDescription" class="col-form-label">Description <span
                                    class="text-danger">*</span></label>
                            <textarea id="inputDescription" name="description" placeholder="Enter description"
                                class="form-control" rows="5">{{old('description')}}</textarea>
                            @error('description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputImage" class="col-form-label">Image <span
                                    class="text-danger">*</span></label>
                            <input id="inputImage" type="file" name="image" class="form-control" accept="image/*">
                            <div id="holder" style="margin-top: 15px; max-height: 100px;"></div>
                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    feather.replace();
});
</script>

@endsection