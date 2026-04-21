@extends('admin.includes.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Product Edit</h1>
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
                    <form method="post" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group mb-3 mt-2">
                            <label for="inputTitle" class="col-form-label">Title <span
                                    class="text-danger">*</span></label>
                            <input id="inputTitle" type="text" name="title" placeholder="Enter title"
                                value="{{$product->title}}" class="form-control">
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3 mt-2">
                            <label for="summary" class="col-form-label">Summary <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" id="summernote-summary" name="summary">{{$product->summary}}</textarea>
                            @error('summary')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3 mt-2">
                            <label for="description" class="col-form-label">Description</label>
                            <textarea class="form-control" id="summernote-description"
                                name="description">{{$product->description}}</textarea>
                            @error('description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="form-group mb-3 mt-2">
                            <label for="is_featured">Is Featured</label><br>
                            <input type="checkbox" name='is_featured' id='is_featured' value='{{$product->is_featured}}'
                                {{(($product->is_featured) ? 'checked' : '')}}> Yes
                        </div>
                        {{-- {{$categories}} --}}

                        <div class="form-group mb-3 mt-2">
                            <label for="cat_id">Category <span class="text-danger">*</span></label>
                            <select name="cat_id" id="cat_id" class="form-control">
                                <option value="">--Select any category--</option>
                                @foreach($categories as $key=>$cat_data)
                                <option value='{{$cat_data->id}}'
                                    {{(($product->cat_id==$cat_data->id)? 'selected' : '')}}>
                                    {{$cat_data->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        @php
                        $sub_cat_info=DB::table('categories')->select('title')->where('id',$product->child_cat_id)->get();
                        // dd($sub_cat_info);

                        @endphp
                        {{-- {{$product->child_cat_id}} --}}
                        <div class="form-group mb-3 mt-2  {{(($product->child_cat_id)? '' : 'd-none')}}" id="child_cat_div">
                            <label for="child_cat_id">Sub Category</label>
                            <select name="child_cat_id" id="child_cat_id" class="form-control">
                                <option value="">--Select any sub category--</option>

                            </select>
                        </div>

                        <div class="form-group mb-3 mt-2">
                            <label for="price" class="col-form-label">Price(NRS) <span
                                    class="text-danger">*</span></label>
                            <input id="price" type="number" name="price" placeholder="Enter price"
                                value="{{$product->price}}" class="form-control">
                            @error('price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group  mb-3 mt-2">
                            <label for="discount" class="col-form-label">Discount(%)</label>
                            <input id="discount" type="number" name="discount" min="0" max="100"
                                placeholder="Enter discount" value="{{$product->discount}}" class="form-control">
                            @error('discount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group  mb-3 mt-2">
                            <label for="brand_id">Brand</label>
                            <select name="brand_id" class="form-control">
                                <option value="">--Select Brand--</option>
                                @foreach($brands as $brand)
                                <option value="{{$brand->id}}" {{(($product->brand_id==$brand->id)? 'selected':'')}}>
                                    {{$brand->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group  mb-3 mt-2">
                            <label for="condition">Condition</label>
                            <select name="condition" class="form-control">
                                <option value="">--Select Condition--</option>
                                <option value="default" {{(($product->condition=='default')? 'selected':'')}}>Default
                                </option>
                                <option value="new" {{(($product->condition=='new')? 'selected':'')}}>New</option>
                                <option value="hot" {{(($product->condition=='hot')? 'selected':'')}}>Hot</option>
                            </select>
                        </div>

                        <div class="form-group  mb-3 mt-2">
                            <label for="stock">Quantity <span class="text-danger">*</span></label>
                            <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity"
                                value="{{$product->stock}}" class="form-control">
                            @error('stock')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group  mb-3 mt-2">
                            <label for="inputPhoto" class="col-form-label">Photo <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                               
                                <input id="thumbnail" class="form-control" type="file" name="photo"
                                    value="{{$product->photo}}">
                            </div>
                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                            @error('photo')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group  mb-3 mt-2">
                            <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="active" {{(($product->status=='active')? 'selected' : '')}}>Active
                                </option>
                                <option value="inactive" {{(($product->status=='inactive')? 'selected' : '')}}>Inactive
                                </option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group   mb-3 mt-2">
                            <button class="btn btn-success" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>


<script>
var child_cat_id = '{{$product->child_cat_id}}';
// alert(child_cat_id);
$('#cat_id').change(function() {
    var cat_id = $(this).val();

    if (cat_id != null) {
        // ajax call
        $.ajax({
            url: "/admin/category/" + cat_id + "/child",
            type: "POST",
            data: {
                _token: "{{csrf_token()}}"
            },
            success: function(response) {
                if (typeof(response) != 'object') {
                    response = $.parseJSON(response);
                }
                var html_option = "<option value=''>--Select any one--</option>";
                if (response.status) {
                    var data = response.data;
                    if (response.data) {
                        $('#child_cat_div').removeClass('d-none');
                        $.each(data, function(id, title) {
                            html_option += "<option value='" + id + "' " + (child_cat_id ==
                                id ? 'selected ' : '') + ">" + title + "</option>";
                        });
                    } else {
                        console.log('no response data');
                    }
                } else {
                    $('#child_cat_div').addClass('d-none');
                }
                $('#child_cat_id').html(html_option);

            }
        });
    } else {

    }

});
if (child_cat_id != null) {
    $('#cat_id').change();
}
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    feather.replace();
});
</script>
@push('scripts')


@endpush
@endsection