@extends('layouts.app')

@section('content')

<section class="hero">
    <div class="container">
        <div class="row">

            <!-- Categories -->
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All departments</span>
                    </div>
                    <ul>
                        @foreach($category_lists as $cat)
                        <li>
                            <a href="{{ route('product-grids', ['category' => $cat->slug]) }}">
                                {{ $cat->title }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-9">

                <!-- Search -->
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="{{ route('product.search') }}" method="POST">
                            @csrf
                            
                            <input type="text" name="search" placeholder="What do you need?" value="{{ request('search') }}">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                </div>

                <!-- Banners -->
                @foreach($banners as $banner)
                <div class="hero__item" style="background-image: url('{{ asset($banner->photo) }}'); background-size: cover; background-position: center;">
                    <div class="hero__text">
                        <span>{{ $banner->title }}</span>
                        <h2>{!! $banner->description !!}</h2>
                        <a href="{{ $banner->link ?? '#' }}" class="primary-btn">SHOP NOW</a>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>


<!-- Categories Section -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach($category_lists as $cat)
                <div class="col-lg-3">
                    <div class="categories__item"
                        style="background-image: url('{{ $cat->photo ? asset($cat->photo) : asset('frontend/img/categories/cat-1.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                        <h5>
                            <a href="{{ route('product-grids', ['category' => $cat->slug]) }}">{{ $cat->title }}</a>
                        </h5>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


<!-- Featured Products -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Featured Product</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        @foreach($category_lists as $cat)
                        <li data-filter=".{{ Str::slug($cat->title, '-') }}">{{ $cat->title }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            @foreach($product_lists as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mix {{ Str::slug($product->category->title ?? '', '-') }}">
                <div class="featured__item">
                    <div class="featured__item__pic" 
                        style="background-image: url('{{ $product->photo ? asset($product->photo) : asset('frontend/img/featured/feature-1.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                        <ul class="featured__item__pic__hover">
                            <li>
                                @auth
                                <a href="{{ route('add-to-wishlist', $product->slug) }}" title="Add to Wishlist"><i
                                        class="fa fa-heart"></i></a>
                                @else
                                <a href="{{ route('login.form') }}" title="Login to add to wishlist"><i
                                        class="fa fa-heart"></i></a>
                                @endauth
                            </li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li>
                                @auth
                                <a href="{{ route('add-to-cart', $product->slug) }}" title="Add to Cart"><i
                                        class="fa fa-shopping-cart"></i></a>
                                @else
                                <a href="{{ route('login.form') }}" title="Login to add to cart"><i
                                        class="fa fa-shopping-cart"></i></a>
                                @endauth
                            </li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="{{ route('product.detail', $product->slug) }}">{{ $product->title }}</a></h6>
                        <h5>Rs {{ number_format($product->price, 2) }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- Banner -->
<div class="banner">
    <div class="container">
        <div class="row">
            @foreach($featured as $index => $feat)
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{ asset($feat->photo) }}" alt="{{ $feat->title }}">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


<!-- Latest / Top Rated / Hot Products -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">

            <!-- Latest Products -->
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Latest Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            @foreach($product_lists->take(3) as $product)
                            <a href="{{ route('product.detail', $product->slug) }}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ $product->photo ? asset($product->photo) : asset('frontend/img/latest-product/lp-1.jpg') }}"
                                        alt="{{ $product->title }}" loading="lazy">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{ $product->title }}</h6>
                                    <span>Rs {{ number_format($product->price, 2) }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Rated Products -->
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Top Rated Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            @foreach($hotproducts->take(3) as $product)
                            <a href="{{ route('product.detail', $product->slug) }}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ $product->photo ? asset($product->photo) : asset('frontend/img/latest-product/lp-2.jpg') }}"
                                        alt="{{ $product->title }}" loading="lazy">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{ $product->title }}</h6>
                                    <span>Rs {{ number_format($product->price, 2) }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured / Review Products -->
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Review Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            @foreach($featured->take(3) as $product)
                            <a href="{{ route('product.detail', $product->slug) }}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ $product->photo ? asset($product->photo) : asset('frontend/img/latest-product/lp-3.jpg') }}"
                                        alt="{{ $product->title }}" loading="lazy">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{ $product->title }}</h6>
                                    <span>Rs {{ number_format($product->price, 2) }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection