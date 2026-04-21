@extends('admin.includes.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Review List</h1>
            
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

                        <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
                            <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Review By</th>
                                        <th>Product Title</th>
                                        <th>Review</th>
                                        <th>Rate</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($reviews as $review)
                                    <tr>
                                        <td>{{$review->id}}</td>
                                        <td>{{$review->user_info['name']}}</td>
                                        <td>{{$review->product->title}}</td>
                                        <td>{{$review->review}}</td>
                                        <td>
                                            <ul style="list-style:none">
                                                @for($i=1; $i<=5;$i++) @if($review->rate >=$i)
                                                    <li style="float:left;color:#F7941D;"> <i class="align-middle"
                                                            data-feather="star"></i>
                                                    </li>
                                                    @else
                                                    <li style="float:left;color:#F7941D;"> <i class="align-middle"
                                                            data-feather="star"></i>
                                                    </li>
                                                    @endif
                                                    @endfor
                                            </ul>
                                        </td>
                                        <td>{{$review->created_at->format('M d D, Y g: i a')}}</td>
                                        <td>
                                            @if($review->status=='active')
                                            <span class="badge bg-success">{{$review->status}}</span>
                                            @else
                                            <span class="badge bg-warning">{{$review->status}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('review.edit', $review->id) }}"
                                                class="btn btn-sm btn-outline-info me-2" title="Edit">
                                                <i class="align-middle" data-feather="edit"></i>
                                            </a>


                                            <form method="POST" action="{{ route('review.destroy', [$review->id]) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this review?');">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    title="Delete">
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