@extends('admin.includes.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Product Create</h1>
            <a href="{{ route('product.index') }}" class="btn btn-primary"><i class="align-middle"
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
                    <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group mb-3 mt-2">
                            <label for="inputTitle" class="col-form-label">Title <span
                                    class="text-danger">*</span></label>
                            <input id="inputTitle" type="text" name="title" placeholder="Enter title"
                                value="{{old('title')}}" class="form-control">
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="summary" class="col-form-label">Summary <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" id="summernote-summary"
                                name="summary">{{ old('summary') }}</textarea>
                            @error('summary')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-form-label">Description</label>
                            <textarea class="form-control" id="summernote-description"
                                name="description">{{ old('description') }}</textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="form-group mb-3 mt-2">
                            <label for="is_featured">Is Featured</label><br>
                            <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Yes
                        </div>
                        {{-- {{$categories}} --}}

                        <div class="form-group">
                            <label for="cat_id">Category <span class="text-danger">*</span></label>
                            <select name="cat_id" id="cat_id" class="form-control">
                                <option value="">--Select any category--</option>
                                @foreach($categories as $key=>$cat_data)
                                <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3 mt-2 d-none" id="child_cat_div">
                            <label for="child_cat_id">Sub Category</label>
                            <select name="child_cat_id" id="child_cat_id" class="form-control">
                                <option value="">--Select any category--</option>
                                {{-- @foreach($parent_cats as $key=>$parent_cat)
                                <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
                                @endforeach --}}
                            </select>
                        </div>

                        <div class="form-group mb-3 mt-2">
                            <label for="price" class="col-form-label">Price(NRS) <span
                                    class="text-danger">*</span></label>
                            <input id="price" type="number" name="price" placeholder="Enter price"
                                value="{{old('price')}}" class="form-control">
                            @error('price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3 mt-2">
                            <label for="discount" class="col-form-label">Discount(%)</label>
                            <input id="discount" type="number" name="discount" min="0" max="100"
                                placeholder="Enter discount" value="{{old('discount')}}" class="form-control">
                            @error('discount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="form-group mb-3 mt-2">
                            <label for="brand_id">Brand</label>


                            <select name="brand_id" class="form-control">
                                <option value="">--Add Brand--</option>
                                @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3 mt-2">
                            <label for="condition">Condition</label>
                            <select name="condition" class="form-control">
                                <option value="">--Select Condition--</option>
                                <option value="default">Default</option>
                                <option value="new">New</option>
                                <option value="featured">Featured</option>
                                <option value="hot">Hot</option>
                            </select>
                        </div>

                        <div class="form-group mb-3 mt-2">
                            <label for="stock">Quantity <span class="text-danger">*</span></label>
                            <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity"
                                value="{{old('stock')}}" class="form-control">
                            @error('stock')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3 mt-2 ">
                            <label for="inputPhoto" class="col-form-label">Photo <span
                                    class="text-danger">*</span></label>
                            <input id="inputPhoto" type="file" name="photo" class="form-control">
                            <div id="holder" style="margin-top: 15px; max-height: 100px;"></div>
                            @error('photo')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3 mt-2">
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
$(document).ready(function() {
    $('#cat_id').change(function() {
        var cat_id = $(this).val();
        if (cat_id != null) {
            $.ajax({
                url: "/admin/category/" + cat_id + "/child",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: cat_id
                },
                type: "POST",
                success: function(response) {
                    if (typeof(response) != 'object') {
                        response = $.parseJSON(response);
                    }
                    var html_option =
                        "<option value=''>----Select sub category----</option>";
                    if (response.status) {
                        var data = response.data;
                        if (response.data) {
                            $('#child_cat_div').removeClass('d-none');
                            $.each(data, function(id, title) {
                                html_option += "<option value='" + id + "'>" +
                                    title + "</option>";
                            });
                        }
                    } else {
                        $('#child_cat_div').addClass('d-none');
                    }
                    $('#child_cat_id').html(html_option);
                }
            });
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    feather.replace();
});
</script>
<script>
$(document).ready(function() {
    $('#summernote-summary').summernote({
        height: 150
    });

    $('#summernote-description').summernote({
        height: 150
    });
});
</script>
@push('scripts')


@endpush
@endsection