@extends('admin.includes.main')
@push('styles')

@endpush

@section('content')
<style>
.hidden {
    display: none;
}
</style>
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Category Create</h1>
            <a href="{{ route('category.index') }}" class="btn btn-primary"><i class="align-middle"
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
                    <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="inputTitle" class="col-form-label">Title <span
                                    class="text-danger">*</span></label>
                            <input id="inputTitle" type="text" name="title" placeholder="Enter title"
                                value="{{old('title')}}" class="form-control">
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>



                      
                        

                        <div class="form-group">
                            <label for="inputPhoto" class="col-form-label">Photo <span
                                    class="text-danger">*</span></label>
                            <input id="inputPhoto" type="file" name="photo" class="form-control">
                            <div id="holder" style="margin-top: 15px; max-height: 100px;"></div>
                            @error('photo')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
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


<script>
document.addEventListener('DOMContentLoaded', function() {
    feather.replace();

    // Initially hide parent category if checkbox is checked
    const isParent = document.getElementById('is_parent');
    const parentCatDiv = document.getElementById('parent_cat_div');

    function toggleParentCategory() {
        if (isParent.checked) {
            parentCatDiv.classList.add('hidden');
        } else {
            parentCatDiv.classList.remove('hidden');
        }
    }

    // Run once on load
    toggleParentCategory();

    // Add event listener
    isParent.addEventListener('change', toggleParentCategory);
});
</script>


@endsection