@extends('layouts.app')

@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">My Reviews</h2>
        <div class="row">
            <div class="col-lg-3">
                @include('user.include.sidebar')
            </div>
            <div class="col-lg-9">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
                @endif

                <div class="my-account__dashboard" style="background:#fff;padding:20px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.05);">
                    <h5 style="font-weight:600;margin-bottom:20px;color:#333;">Your Product Reviews</h5>

                    @if($reviews->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="font-size:14px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Rating</th>
                                    <th>Review</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $review)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($review->product)
                                            <a href="{{ route('product.detail', $review->product->slug) }}" style="color:#333;text-decoration:none;font-weight:500;">
                                                {{ Str::limit($review->product->title, 35) }}
                                            </a>
                                        @else
                                            <span style="color:#aaa;">Product removed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            @for($i=1;$i<=5;$i++)
                                                <i class="fa fa-star{{ $i <= $review->rate ? '' : '-o' }}" style="color:#f5a623;font-size:13px;"></i>
                                            @endfor
                                            <span style="font-size:12px;color:#888;">({{ $review->rate }}/5)</span>
                                        </div>
                                    </td>
                                    <td style="max-width:200px;">{{ Str::limit($review->review, 60) }}</td>
                                    <td>
                                        @if($review->status == 'active')
                                            <span class="badge bg-success">Published</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $review->created_at->format('M d, Y') }}</td>
                                    <td style="white-space:nowrap;">
                                        <a href="{{ route('user.productreview.edit', $review->id) }}" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('user.productreview.delete', $review->id) }}" style="display:inline;" onsubmit="return confirm('Delete this review?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">{{ $reviews->links() }}</div>
                    @else
                    <div style="text-align:center;padding:50px 20px;color:#aaa;">
                        <i class="fa fa-star-o fa-3x mb-3"></i>
                        <p style="font-size:15px;margin-bottom:15px;">You haven't written any reviews yet.</p>
                        <a href="{{ route('product-grids') }}" class="primary-btn" style="padding:10px 24px;">Shop & Review Products</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
