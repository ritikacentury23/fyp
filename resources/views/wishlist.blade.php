@extends('layouts.app')

@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="container" style="padding: 40px 15px;">
        <h2 class="page-title" style="font-size:26px;font-weight:700;margin-bottom:30px;">My Wishlist</h2>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }} <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(isset($wishlists) && $wishlists->count() > 0)
        <div class="row">
            @foreach($wishlists as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div style="background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 15px rgba(0,0,0,0.08);position:relative;transition:transform 0.2s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='none'">
                    {{-- Remove button --}}
                    <a href="{{ route('wishlist-delete', $item->id) }}"
                       title="Remove from Wishlist"
                       onclick="return confirm('Remove this item from wishlist?')"
                       style="position:absolute;top:10px;right:10px;background:#fff;color:#dc3545;width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 6px rgba(0,0,0,0.15);z-index:2;text-decoration:none;font-size:14px;">
                        <i class="fa fa-times"></i>
                    </a>

                    {{-- Product Image --}}
                    <a href="{{ route('product.detail', $item->product->slug) }}">
                        <img src="{{ $item->product->photo ? asset($item->product->photo) : asset('img/product/product-1.jpg') }}"
                             alt="{{ $item->product->title }}"
                             style="width:100%;height:200px;object-fit:cover;">
                    </a>

                    <div style="padding:16px;">
                        <h6 style="font-size:14px;font-weight:600;margin-bottom:8px;">
                            <a href="{{ route('product.detail', $item->product->slug) }}" style="color:#333;text-decoration:none;">
                                {{ Str::limit($item->product->title, 40) }}
                            </a>
                        </h6>

                        <div style="margin-bottom:12px;">
                            @if($item->product->discount && $item->product->discount > 0)
                                <span style="text-decoration:line-through;color:#aaa;font-size:13px;">Rs {{ number_format($item->product->price, 2) }}</span>
                                <span style="font-weight:700;color:#7fba00;font-size:16px;margin-left:6px;">Rs {{ number_format($item->price, 2) }}</span>
                                <span style="background:#fce4ec;color:#e83e8c;font-size:11px;padding:2px 8px;border-radius:20px;margin-left:5px;">{{ $item->product->discount }}% OFF</span>
                            @else
                                <span style="font-weight:700;color:#333;font-size:16px;">Rs {{ number_format($item->price, 2) }}</span>
                            @endif
                        </div>

                        @if($item->product->stock > 0)
                            <a href="{{ route('add-to-cart', $item->product->slug) }}"
                               style="display:block;background:#7fba00;color:#fff;text-align:center;padding:9px;border-radius:6px;font-size:13px;font-weight:600;text-decoration:none;">
                                <i class="fa fa-shopping-cart me-1"></i> Add to Cart
                            </a>
                        @else
                            <span style="display:block;background:#eee;color:#999;text-align:center;padding:9px;border-radius:6px;font-size:13px;">Out of Stock</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-3 d-flex justify-content-between align-items-center">
            <span style="font-size:14px;color:#666;">{{ $wishlists->count() }} item(s) in your wishlist</span>
            <a href="{{ route('product-grids') }}" class="primary-btn" style="padding:10px 22px;">Continue Shopping</a>
        </div>

        @else
        <div style="text-align:center;padding:80px 20px;background:#fff;border-radius:12px;box-shadow:0 2px 15px rgba(0,0,0,0.06);">
            <i class="fa fa-heart-o" style="font-size:60px;color:#ddd;display:block;margin-bottom:20px;"></i>
            <h4 style="color:#555;margin-bottom:10px;">Your wishlist is empty</h4>
            <p style="color:#aaa;margin-bottom:25px;">Save items you love and shop them whenever you're ready.</p>
            <a href="{{ route('product-grids') }}" class="primary-btn" style="padding:12px 30px;">Browse Products</a>
        </div>
        @endif
    </section>
</main>
@endsection
