@extends('admin.includes.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Category Edit</h1>
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
                    <form method="post" action="{{route('category.update',$category->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="inputTitle" class="col-form-label">Title <span
                                    class="text-danger">*</span></label>
                            <input id="inputTitle" type="text" name="title" placeholder="Enter title"
                                value="{{$category->title}}" class="form-control">
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                      

                       
                        <div class="form-group">
                            <label for="inputPhoto" class="col-form-label">Photo</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                   
                                </span>
                                <input  class="form-control" type="file" name="photo"
                                    value="{{$category->photo}}">
                            </div>
                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                            @error('photo')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="active" {{(($category->status=='active')? 'selected' : '')}}>Active
                                </option>
                                <option value="inactive" {{(($category->status=='inactive')? 'selected' : '')}}>Inactive
                                </option>
                            </select>
                            @error('status')
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
<script>
$('#is_parent').change(function() {
    var is_checked = $('#is_parent').prop('checked');
    // alert(is_checked);
    if (is_checked) {
        $('#parent_cat_div').addClass('d-none');
        $('#parent_cat_div').val('');
    } else {
        $('#parent_cat_div').removeClass('d-none');
    }
})
</script>

@endsection