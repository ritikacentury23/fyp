@extends('admin.includes.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Product List</h1>
            <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="align-middle"
                    data-feather="plus"></i> Add Product</a>
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
                        <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Is Featured</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Size</th>
                                    <th>Condition</th>
                                    <!-- <th>Brand</th> -->
                                    <th>Stock</th>
                                    <th>Photo</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($products as $product)
                                @php
                                $sub_cat_info=DB::table('categories')->select('title')->where('id',$product->child_cat_id)->get();
                                // dd($sub_cat_info);
                                $brands=DB::table('brands')->select('title')->where('id',$product->brand_id)->get();
                                @endphp
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->title}}</td>
                                    <td>{{@$product->cat_info['title']}}
                                        <sub>
                                            {{@$product->sub_cat_info->title ?? ''}}
                                        </sub>
                                    </td>
                                    <td>{{(($product->is_featured==1)? 'Yes': 'No')}}</td>
                                    <td>Rs. {{$product->price}} /-</td>
                                    <td> {{$product->discount}}% OFF</td>
                                    <td>{{$product->size}}</td>
                                    <td>{{$product->condition}}</td>

                                    <td>
                                        @if($product->stock>0)
                                        <span class="badge bg-primary">{{$product->stock}}</span>
                                        @else
                                        <span class="badge bg-danger">{{$product->stock}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->photo)
                                        @php
                                        $photos = explode(',', $product->photo); // Split the photo string by comma
                                        @endphp
                                        @foreach($photos as $photo)
                                        <img src="{{ asset($photo) }}" class="img-fluid zoom" style="max-width:80px"
                                            alt="product-image">
                                        @endforeach
                                        @else
                                        <img src="{{ asset('backend/img/thumbnail-default.jpg') }}" class="img-fluid"
                                            style="max-width:80px" alt="avatar.png">
                                        @endif
                                    </td>

                                    <td>
                                        @if($product->status=='active')
                                        <span class="badge bg-success">{{$product->status}}</span>
                                        @else
                                        <span class="badge bg-warning">{{$product->status}}</span>
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        <a href="{{ route('product.edit', $product->id) }}"
                                            class="btn btn-sm btn-outline-info me-2" title="Edit">
                                            <i class="align-middle" data-feather="edit"></i>
                                        </a>


                                        <form method="POST" action="{{ route('product.destroy', [$product->id]) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this ite?');">
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