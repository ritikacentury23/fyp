@extends('layouts.app')

@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Edit Review</h2>
        <div class="row">
            <div class="col-lg-3">
                @include('user.include.sidebar')
            </div>
            <div class="col-lg-9">
                <div class="my-account__dashboard" style="background:#fff;padding:25px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.05);">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                        <h5 style="font-weight:600;color:#333;margin:0;">Update Your Review</h5>
                        <a href="{{ route('user.productreview.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fa fa-arrow-left me-1"></i> Back to Reviews
                        </a>
                    </div>

                    @if($review->product)
                    <div style="background:#f9f9f9;border-radius:8px;padding:15px;margin-bottom:20px;display:flex;align-items:center;gap:15px;">
                        <img src="{{ $review->product->photo ? asset($review->product->photo) : asset('img/product/product-1.jpg') }}"
                             alt="{{ $review->product->title }}"
                             style="width:60px;height:60px;object-fit:cover;border-radius:6px;">
                        <div>
                            <strong style="font-size:15px;">{{ $review->product->title }}</strong>
                            <div style="font-size:12px;color:#888;margin-top:3px;">Reviewing this product</div>
                        </div>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('user.productreview.update', $review->id) }}">
                        @csrf @method('PATCH')
                        <div class="form-group mb-4">
                            <label style="font-weight:600;margin-bottom:10px;display:block;">Your Rating <span style="color:red;">*</span></label>
                            <div class="star-rating" style="display:flex;flex-direction:row-reverse;justify-content:flex-end;gap:6px;">
                                @for($i=5;$i>=1;$i--)
                                <input type="radio" id="star{{ $i }}" name="rate" value="{{ $i }}" {{ $review->rate == $i ? 'checked' : '' }} style="display:none;">
                                <label for="star{{ $i }}" style="font-size:34px;color:{{ $review->rate >= $i ? '#f5a623' : '#ddd' }};cursor:pointer;transition:color 0.2s;">&#9733;</label>
                                @endfor
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label style="font-weight:600;margin-bottom:6px;display:block;">Your Review <span style="color:red;">*</span></label>
                            <textarea name="review" class="form-control" rows="5" required>{{ old('review', $review->review) }}</textarea>
                        </div>
                        <div style="display:flex;gap:10px;">
                            <button type="submit" class="btn site-btn">Update Review</button>
                            <a href="{{ route('user.productreview.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
.star-rating label:hover,
.star-rating label:hover ~ label,
.star-rating input:checked ~ label { color: #f5a623 !important; }
</style>
@endsection
