@extends('admin.includes.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Edit About Us</h1>
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
                    <form method="post" action="{{route('aboutus.update',$category->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="inputDescription" class="col-form-label">Description <span
                                    class="text-danger">*</span></label>
                            <textarea id="inputDescription" name="description" placeholder="Enter description"
                                class="form-control" rows="5">{{$category->description}}</textarea>
                            @error('description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputImage" class="col-form-label">Image</label>
                            <input class="form-control" type="file" name="image" accept="image/*">
                            <div id="holder" style="margin-top:15px;max-height:100px;">
                                @if($category->image)
                                <img src="{{ asset($category->image) }}" class="img-fluid" style="max-width:150px" alt="Current Image">
                                <p class="mt-2 small text-muted">Current Image</p>
                                @endif
                            </div>
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <button class="btn btn-success" type="submit">Update</button>
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