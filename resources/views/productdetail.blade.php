@extends('layouts.app')

@section('content')

<section class="product-details spad">
    <div class="container">
        <div class="row">

            {{-- Product Images --}}
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                            src="{{ $product_detail->photo ? asset($product_detail->photo) : asset('img/product/details/product-details-1.jpg') }}"
                            alt="{{ $product_detail->title }}">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        @if($product_detail->photos && count($product_detail->photos) > 0)
                            @foreach($product_detail->photos as $photo)
                            <img data-imgbigurl="{{ asset($photo) }}" src="{{ asset($photo) }}" alt="{{ $product_detail->title }}">
                            @endforeach
                        @else
                            <img data-imgbigurl="{{ asset($product_detail->photo) }}" src="{{ asset($product_detail->photo) }}" alt="{{ $product_detail->title }}">
                        @endif
                    </div>
                </div>
            </div>

            {{-- Product Info --}}
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{ $product_detail->title }}</h3>

                    {{-- Dynamic Star Rating --}}
                    <div class="product__details__rating" style="display:flex;align-items:center;gap:8px;margin-bottom:12px;">
                        <div>
                            @php $fullStars = floor($avgRating); $halfStar = ($avgRating - $fullStars) >= 0.5; @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $fullStars)
                                    <i class="fa fa-star" style="color:#f5a623;"></i>
                                @elseif($i == $fullStars + 1 && $halfStar)
                                    <i class="fa fa-star-half-o" style="color:#f5a623;"></i>
                                @else
                                    <i class="fa fa-star-o" style="color:#ccc;"></i>
                                @endif
                            @endfor
                        </div>
                        <span style="font-size:14px;color:#777;">({{ $reviewCount }} {{ Str::plural('review', $reviewCount) }})</span>
                        @if($reviewCount > 0)
                        <span style="font-size:14px;color:#7fba00;font-weight:600;">{{ number_format($avgRating, 1) }}/5</span>
                        @endif
                    </div>

                    <div class="product__details__price">
                        @if($product_detail->discount_price)
                            <span style="text-decoration:line-through;color:#999;font-size:16px;">Rs {{ number_format($product_detail->price, 2) }}</span>
                            Rs {{ number_format($product_detail->discount_price, 2) }}
                        @else
                            Rs {{ number_format($product_detail->price, 2) }}
                        @endif
                    </div>
                    @if($product_detail->discount && $product_detail->discount > 0)
                    <p style="color:#e83e8c;font-size:13px;"><i class="fa fa-tag"></i> {{ $product_detail->discount }}% discount included</p>
                    @endif
                    <p>{!! $product_detail->description !!}</p>

                    <div class="product__details__quantity">
                        <form action="{{ route('single-add-to-cart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="slug" value="{{ $product_detail->slug }}">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" name="quant[1]" value="1" data-min="1" data-max="1000">
                                </div>
                            </div>
                            <button type="submit" class="primary-btn">ADD TO CART</button>
                        </form>
                    </div>

                    {{-- Wishlist --}}
                    @auth
                    <a href="{{ route('add-to-wishlist', $product_detail->slug) }}" class="heart-icon" style="display:inline-flex;align-items:center;gap:6px;margin-top:10px;color:#e83e8c;text-decoration:none;font-size:14px;">
                        <span class="icon_heart_alt"></span> Add to Wishlist
                    </a>
                    @endauth

                    <ul style="margin-top:16px;">
                        <li><b>Availability</b>
                            <span>
                                @if($product_detail->stock > 0)
                                    <span style="color:#28a745;">In Stock ({{ $product_detail->stock }} left)</span>
                                @else
                                    <span style="color:#dc3545;">Out of Stock</span>
                                @endif
                            </span>
                        </li>
                        <li><b>Weight</b> <span>{{ $product_detail->weight ?? 'N/A' }}</span></li>
                        <li><b>Category</b> <span>{{ $product_detail->category->title ?? $product_detail->cat_info->title ?? 'N/A' }}</span></li>
                        <li>
                            <b>Share on</b>
                            <div class="share">
                                <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(request()->fullUrl()) }}" target="_blank"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Tabs --}}
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">
                                Reviews <span>({{ $reviewCount }})</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Product Description</h6>
                                <p>{!! $product_detail->description !!}</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Product Information</h6>
                                <table class="table">
                                    <tr><td><b>Weight</b></td><td>{{ $product_detail->weight ?? 'N/A' }}</td></tr>
                                    <tr><td><b>Category</b></td><td>{{ $product_detail->category->title ?? $product_detail->cat_info->title ?? 'N/A' }}</td></tr>
                                    <tr><td><b>Stock</b></td><td>{{ $product_detail->stock ?? 'N/A' }}</td></tr>
                                    <tr><td><b>Condition</b></td><td>{{ ucfirst($product_detail->condition ?? 'N/A') }}</td></tr>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Customer Reviews</h6>

                                {{-- Review Summary Bar --}}
                                @if($reviewCount > 0)
                                <div style="background:#f9f9f9;border-radius:10px;padding:20px;margin-bottom:25px;display:flex;align-items:center;gap:30px;flex-wrap:wrap;">
                                    <div style="text-align:center;">
                                        <div style="font-size:52px;font-weight:700;color:#f5a623;line-height:1;">{{ number_format($avgRating, 1) }}</div>
                                        <div>
                                            @for($i=1;$i<=5;$i++)
                                                <i class="fa fa-star{{ $i <= round($avgRating) ? '' : '-o' }}" style="color:#f5a623;font-size:16px;"></i>
                                            @endfor
                                        </div>
                                        <div style="font-size:13px;color:#888;margin-top:4px;">{{ $reviewCount }} {{ Str::plural('review', $reviewCount) }}</div>
                                    </div>
                                    <div style="flex:1;min-width:200px;">
                                        @foreach([5,4,3,2,1] as $star)
                                        @php $cnt = $product_detail->reviews->where('rate', $star)->count(); $pct = $reviewCount ? round(($cnt/$reviewCount)*100) : 0; @endphp
                                        <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px;">
                                            <span style="font-size:12px;width:30px;text-align:right;color:#555;">{{ $star }} <i class="fa fa-star" style="color:#f5a623;font-size:10px;"></i></span>
                                            <div style="flex:1;background:#e0e0e0;border-radius:4px;height:8px;overflow:hidden;">
                                                <div style="width:{{ $pct }}%;background:#f5a623;height:100%;border-radius:4px;"></div>
                                            </div>
                                            <span style="font-size:12px;width:30px;color:#888;">{{ $cnt }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                {{-- Individual Reviews --}}
                                @forelse($product_detail->reviews as $review)
                                <div style="border-bottom:1px solid #eee;padding:18px 0;">
                                    <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:8px;">
                                        <div>
                                            <strong style="font-size:15px;">{{ $review->user_info->name ?? 'Anonymous' }}</strong>
                                            <div style="margin-top:3px;">
                                                @for($i=1;$i<=5;$i++)
                                                    <i class="fa fa-star{{ $i <= $review->rate ? '' : '-o' }}" style="color:#f5a623;font-size:13px;"></i>
                                                @endfor
                                                <span style="font-size:12px;color:#888;margin-left:5px;">{{ $review->rate }}/5</span>
                                            </div>
                                        </div>
                                        <span style="font-size:12px;color:#aaa;">{{ $review->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <p style="color:#555;font-size:14px;margin:0;">{{ $review->review }}</p>
                                </div>
                                @empty
                                <div style="text-align:center;padding:30px;color:#aaa;">
                                    <i class="fa fa-comment-o fa-2x mb-2"></i>
                                    <p>No reviews yet. Be the first to review this product!</p>
                                </div>
                                @endforelse

                                {{-- Write Review Form --}}
                                <div style="margin-top:30px;background:#f9f9f9;border-radius:10px;padding:25px;">
                                    <h6 style="font-weight:600;margin-bottom:20px;">Write a Review</h6>
                                    @auth
                                    @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif
                                    @if(session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif
                                    <form action="{{ route('user.productreview.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product_detail->id }}">
                                        <div class="form-group mb-3">
                                            <label style="font-weight:600;margin-bottom:8px;display:block;">Your Rating <span style="color:red;">*</span></label>
                                            <div class="star-rating" style="display:flex;gap:6px;">
                                                @for($i=5;$i>=1;$i--)
                                                <input type="radio" id="star{{ $i }}" name="rate" value="{{ $i }}" style="display:none;" {{ old('rate') == $i ? 'checked' : '' }}>
                                                <label for="star{{ $i }}" style="font-size:28px;color:#ddd;cursor:pointer;transition:color 0.2s;">&#9733;</label>
                                                @endfor
                                            </div>
                                            @error('rate')<span style="color:red;font-size:13px;">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label style="font-weight:600;margin-bottom:6px;display:block;">Your Review <span style="color:red;">*</span></label>
                                            <textarea name="review" class="form-control" rows="4" placeholder="Share your experience with this product..." required>{{ old('review') }}</textarea>
                                            @error('review')<span style="color:red;font-size:13px;">{{ $message }}</span>@enderror
                                        </div>
                                        <button type="submit" class="primary-btn">Submit Review</button>
                                    </form>
                                    @else
                                    <div style="text-align:center;padding:20px;border:2px dashed #ddd;border-radius:8px;">
                                        <p style="color:#777;margin-bottom:15px;">Please log in to write a review.</p>
                                        <a href="{{ route('login.form') }}" class="primary-btn" style="padding:10px 24px;">Login to Review</a>
                                    </div>
                                    @endauth
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Related Products --}}
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Related Products</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse($related_products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg"
                        data-setbg="{{ $product->photo ? asset($product->photo) : asset('img/product/product-1.jpg') }}">
                        <ul class="product__item__pic__hover">
                            <li><a href="{{ route('add-to-wishlist', $product->slug) }}"><i class="fa fa-heart"></i></a></li>
                            <li><a href="{{ route('product.detail', $product->slug) }}"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="{{ route('product.detail', $product->slug) }}">{{ $product->title }}</a></h6>
                        <h5>Rs {{ number_format($product->price, 2) }}</h5>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-12"><p>No related products found.</p></div>
            @endforelse
        </div>
    </div>
</section>

<style>
.star-rating { flex-direction: row-reverse; }
.star-rating input:checked ~ label,
.star-rating label:hover,
.star-rating label:hover ~ label { color: #f5a623 !important; }
.star-rating input:checked + label { color: #f5a623 !important; }
</style>

@endsection
