@extends('admin.includes.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Review Edit</h1>
            <a href="{{ route('review.index') }}" class="btn btn-primary"><i class="align-middle"
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
                    <form action="{{route('review.update',$review->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name">Review By:</label>
                            <input type="text" disabled class="form-control" value="{{$review->user_info->name}}">
                        </div>
                        <div class="form-group">
                            <label for="review">Review</label>
                            <textarea name="review" id="" cols="20" rows="10"
                                class="form-control">{{$review->review}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status :</label>
                            <select name="status" id="" class="form-control">
                                <option value="">--Select Status--</option>
                                <option value="active" {{(($review->status=='active')? 'selected' : '')}}>Active
                                </option>
                                <option value="inactive" {{(($review->status=='inactive')? 'selected' : '')}}>Inactive
                                </option>
                            </select>
                        </div>

                       
                        <button type="submit" class="btn btn-primary">Update</button>
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