@extends('layouts.app')

@section('content')

<section class="breadcrumb-section set-bg" data-setbg="{{asset('frontend/img/breadcrumb.jpg')}}"
    style="background-image: url(&quot;img/breadcrumb.jpg&quot;);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Organi Shop</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ route('home') }}">Home</a>
                        <span>Shop</span>
                        @if(isset($search_term))
                            <span class="search-badge">Search: "{{ $search_term }}"</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product spad">
    <div class="container">
        <div class="row">
            <!-- SIDEBAR FILTERS -->
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <!-- Search Box -->
                    <div class="sidebar__item">
                        <h4>Quick Search</h4>
                        <form action="{{ route('product.search') }}" method="POST" class="search-form">
                            @csrf
                            <div class="search-input-group">
                                <input type="text" name="search" placeholder="Search products..." 
                                    value="{{ isset($search_term) ? $search_term : '' }}" class="form-control" required>
                                <button type="submit" class="btn-search">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Department Filter -->
                    <div class="sidebar__item">
                        <h4>Department</h4>
                        <form id="categoryForm" class="filter-form">
                            <div class="category-list">
                                @php
                                    $categories = \App\Models\Category::where('status', 'active')->get();
                                @endphp
                                @forelse($categories as $category)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input category-checkbox" 
                                            name="category[]" value="{{ $category->slug }}" 
                                            id="cat_{{ $category->id }}">
                                        <label class="form-check-label" for="cat_{{ $category->id }}">
                                            {{ $category->title }}
                                            <span class="product-count">({{ $category->products->count() }})</span>
                                        </label>
                                    </div>
                                @empty
                                    <p class="text-muted">No categories available</p>
                                @endforelse
                            </div>
                        </form>
                    </div>

                    <!-- Price Range Filter -->
                    <div class="sidebar__item">
                        <h4>Price Range</h4>
                        <div class="price-range-wrap">
                            <form id="priceForm" class="filter-form">
                                <div class="price-inputs">
                                    <div class="input-group">
                                        <label>Min Price: Rs<span id="minVal">0</span></label>
                                        <input type="range" name="price_min" id="priceMin" min="0" max="1000" value="0" 
                                            class="price-slider">
                                    </div>
                                    <div class="input-group">
                                        <label>Max Price: Rs<span id="maxVal">1000</span></label>
                                        <input type="range" name="price_max" id="priceMax" min="0" max="1000" value="1000" 
                                            class="price-slider">
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary" id="applyPrice">Apply Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Brand Filter -->
                    <div class="sidebar__item">
                        <h4>Brands</h4>
                        <form id="brandForm" class="filter-form">
                            <div class="brand-list">
                                @php
                                    $brands = \App\Models\Brand::where('status', 'active')->get();
                                @endphp
                                @forelse($brands as $brand)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input brand-checkbox" 
                                            name="brand[]" value="{{ $brand->slug }}" 
                                            id="brand_{{ $brand->id }}">
                                        <label class="form-check-label" for="brand_{{ $brand->id }}">
                                            {{ $brand->title }}
                                        </label>
                                    </div>
                                @empty
                                    <p class="text-muted">No brands available</p>
                                @endforelse
                            </div>
                        </form>
                    </div>

                    <!-- Latest Products Widget -->
                    <div class="sidebar__item">
                        <div class="latest-product__text">
                            <h4>Latest Products</h4>
                            <div class="latest-products-list">
                                @forelse($recent_products as $product)
                                    <div class="latest-product__item">
                                        <a href="{{ route('product.detail', $product->slug) }}" 
                                            class="latest-product__link">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ $product->photo ? asset($product->photo) : asset('frontend/img/featured/feature-1.jpg') }}" 
                                                    alt="{{ $product->title }}" class="product-thumb">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{ Str::limit($product->title, 20) }}</h6>
                                                <span class="price">Rs {{ number_format($product->price, 2) }}</span>
                                            </div>
                                        </a>
                                    </div>
                                @empty
                                    <p class="text-muted">No recent products</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Clear Filters Button -->
                    <div class="sidebar__item">
                        <button type="button" class="btn btn-block btn-outline-danger" id="clearFilters">
                            <i class="fa fa-times"></i> Clear All Filters
                        </button>
                    </div>
                </div>
            </div>

            <!-- PRODUCTS SECTION -->
            <div class="col-lg-9 col-md-7">
                <!-- Filter Controls Bar -->
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>Sort By</span>
                                <select id="sortSelect" class="form-control">
                                    <option value="">Default</option>
                                    <option value="newest">Newest</option>
                                    <option value="title">Title A-Z</option>
                                    <option value="price_low">Price: Low to High</option>
                                    <option value="price_high">Price: High to Low</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span id="productCount">{{ $products->total() }}</span> Products found</h6>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="filter__option">
                                <label class="view-toggle">
                                    <input type="radio" name="view" value="grid" checked>
                                    <span class="icon_grid-2x2"></span>
                                </label>
                                <label class="view-toggle">
                                    <input type="radio" name="view" value="list">
                                    <span class="icon_ul"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="products-container" id="productsContainer">
                    @forelse($products as $product)
                        <div class="col-lg-12 col-md-6 col-sm-6 product-item">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" 
                                    data-setbg="{{ $product->photo ? asset($product->photo) : asset('frontend/img/featured/feature-1.jpg') }}"
                                    style="background-image: url('{{ $product->photo ? asset($product->photo) : asset('frontend/img/featured/feature-1.jpg') }}');">
                                    
                                    @if($product->discount)
                                        <div class="product__discount__percent">-{{ $product->discount }}%</div>
                                    @endif

                                    <ul class="product__item__pic__hover">
                                        <li>
                                            @auth
                                                <a href="{{ route('add-to-wishlist', $product->slug) }}" title="Add to Wishlist">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('login.form') }}" title="Login to add to wishlist">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                            @endauth
                                        </li>
                                        <li>
                                            <a href="#" title="Compare">
                                                <i class="fa fa-retweet"></i>
                                            </a>
                                        </li>
                                        <li>
                                            @auth
                                                <a href="{{ route('add-to-cart', $product->slug) }}" title="Add to Cart">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('login.form') }}" title="Login to add to cart">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>
                                            @endauth
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>
                                        <a href="{{ route('product.detail', $product->slug) }}">
                                            {{ $product->title }}
                                        </a>
                                    </h6>
                                    <div class="product__item__price">
                                        <span class="current-price">Rs{{ number_format($product->price, 2) }}</span>
                                        @if($product->original_price)
                                            <span class="original-price">Rs{{ number_format($product->original_price, 2) }}</span>
                                        @endif
                                    </div>
                                    <div class="product__item__rating">
                                        @php $rating = rand(3, 5); @endphp
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        @if($rating >= 4)
                                            <span class="fa fa-star"></span>
                                        @endif
                                        <span class="rating-count">({{ rand(10, 200) }})</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info">
                                <h5>No products found</h5>
                                <p>Try adjusting your filters or search terms.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="product__pagination">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- STYLES -->
<style>
    /* Search Form */
    .search-form {
        margin-bottom: 20px;
    }

    .search-input-group {
        display: flex;
        gap: 5px;
    }

    .search-input-group input {
        flex: 1;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .btn-search {
        padding: 10px 15px;
        background: #7fad39;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-search:hover {
        background: #6b9030;
    }

    /* Filter Forms */
    .filter-form {
        margin-bottom: 10px;
    }

    .category-list,
    .brand-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-check {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .form-check-input {
        margin-right: 8px;
        cursor: pointer;
    }

    .form-check-label {
        cursor: pointer;
        flex: 1;
        margin-bottom: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .product-count {
        color: #999;
        font-size: 12px;
        margin-left: 5px;
    }

    /* Price Range */
    .price-inputs {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .input-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .input-group label {
        font-size: 12px;
        font-weight: 600;
        color: #666;
    }

    .price-slider {
        width: 100%;
        height: 5px;
        cursor: pointer;
    }

    #applyPrice {
        margin-top: 10px;
    }

    /* Latest Products */
    .latest-products-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .latest-product__item {
        display: flex;
        gap: 10px;
        padding: 10px;
        border: 1px solid #f0f0f0;
        border-radius: 4px;
        transition: all 0.3s;
    }

    .latest-product__item:hover {
        border-color: #7fad39;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .latest-product__link {
        display: flex;
        gap: 10px;
        text-decoration: none;
        width: 100%;
    }

    .latest-product__item__pic {
        flex-shrink: 0;
        width: 70px;
        height: 70px;
        overflow: hidden;
        border-radius: 4px;
    }

    .product-thumb {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .latest-product__item__text {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .latest-product__item__text h6 {
        margin: 0;
        font-size: 13px;
        color: #1c1c1c;
    }

    .latest-product__item__text .price {
        color: #7fad39;
        font-weight: 600;
        font-size: 13px;
    }

    /* Products Container */
    .products-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    @media (max-width: 768px) {
        .products-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .products-container {
            grid-template-columns: 1fr;
        }
    }

    /* Product Item */
    .product__item {
        transition: all 0.3s ease;
        position: relative;
    }

    .product__item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .product__item__pic {
        position: relative;
        overflow: hidden;
        border-radius: 4px;
        height: 250px;
    }

    .product__discount__percent {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #ff5757;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 13px;
        z-index: 2;
    }

    .product__item__pic__hover {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        gap: 10px;
        background: rgba(0,0,0,0.7);
        padding: 15px;
        list-style: none;
        margin: 0;
        transform: translateY(100%);
        transition: transform 0.3s ease;
    }

    .product__item:hover .product__item__pic__hover {
        transform: translateY(0);
    }

    .product__item__pic__hover li a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: #7fad39;
        color: white;
        border-radius: 50%;
        font-size: 18px;
        transition: all 0.3s;
        text-decoration: none;
    }

    .product__item__pic__hover li a:hover {
        background: #6b9030;
        transform: scale(1.1);
    }

    .product__item__text {
        padding: 15px 0;
    }

    .product__item__text h6 {
        margin: 0 0 10px 0;
        font-size: 15px;
    }

    .product__item__text h6 a {
        color: #1c1c1c;
        transition: color 0.3s;
        text-decoration: none;
    }

    .product__item__text h6 a:hover {
        color: #7fad39;
    }

    .product__item__price {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-bottom: 8px;
    }

    .current-price {
        color: #7fad39;
        font-weight: 600;
        font-size: 16px;
    }

    .original-price {
        color: #ccc;
        text-decoration: line-through;
        font-size: 14px;
    }

    .product__item__rating {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
    }

    .product__item__rating .fa-star {
        color: #ffc107;
    }

    .rating-count {
        color: #999;
        margin-left: 5px;
    }

    /* Filters Bar */
    .filter__item {
        margin-bottom: 30px;
        padding: 15px;
        background: #f9f9f9;
        border-radius: 4px;
    }

    .filter__sort select,
    #sortSelect {
        border: 1px solid #ddd;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
    }

    .filter__option {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
    }

    .view-toggle {
        cursor: pointer;
        font-size: 20px;
        padding: 5px 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        transition: all 0.3s;
    }

    .view-toggle input {
        display: none;
    }

    .view-toggle input:checked + span {
        background: #7fad39;
        color: white;
    }

    /* Alerts */
    .alert {
        padding: 20px;
        margin: 20px 0;
        border-radius: 4px;
    }

    .alert-info {
        background: #d1ecf1;
        border: 1px solid #bee5eb;
        color: #0c5460;
    }

    .alert h5 {
        margin-bottom: 10px;
        font-weight: 600;
    }

    .alert p {
        margin: 0;
    }

    /* Clear Button */
    #clearFilters {
        width: 100%;
        padding: 10px;
        border: 1px solid #dc3545;
        background: transparent;
        color: #dc3545;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 600;
    }

    #clearFilters:hover {
        background: #dc3545;
        color: white;
    }

    .breadcrumb__option .search-badge {
        display: inline-block;
        background: #7fad39;
        color: white;
        padding: 3px 8px;
        border-radius: 3px;
        margin-left: 10px;
        font-size: 12px;
    }

    /* Loading State */
    .loading {
        opacity: 0.6;
        pointer-events: none;
    }

    .spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid #f3f3f3;
        border-top: 3px solid #7fad39;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<!-- JAVASCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Price Range Handler
    const priceMin = document.getElementById('priceMin');
    const priceMax = document.getElementById('priceMax');
    const minVal = document.getElementById('minVal');
    const maxVal = document.getElementById('maxVal');
    const applyPrice = document.getElementById('applyPrice');

    if (priceMin && priceMax) {
        priceMin.addEventListener('change', function() {
            minVal.textContent = this.value;
        });

        priceMax.addEventListener('change', function() {
            maxVal.textContent = this.value;
        });

        applyPrice.addEventListener('click', function() {
            const minPrice = priceMin.value;
            const maxPrice = priceMax.value;

            if (parseInt(minPrice) >= parseInt(maxPrice)) {
                alert('Min price must be less than max price');
                return;
            }

            const url = new URL('{{ route("product-grids") }}', window.location.origin);
            const current = new URL(window.location);
            ['category', 'brand', 'sortBy', 'show'].forEach(key => {
                if (current.searchParams.has(key)) url.searchParams.set(key, current.searchParams.get(key));
            });
            url.searchParams.set('price', minPrice + '-' + maxPrice);
            window.location = url.toString();
        });
    }

    // Sort Handler
    const sortSelect = document.getElementById('sortSelect');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const url = new URL('{{ route("product-grids") }}', window.location.origin);
            const current = new URL(window.location);
            ['category', 'brand', 'price', 'show'].forEach(key => {
                if (current.searchParams.has(key)) url.searchParams.set(key, current.searchParams.get(key));
            });
            if (this.value) url.searchParams.set('sortBy', this.value);
            window.location = url.toString();
        });
    }

    // Category Filter
    const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
    categoryCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', applyFilters);
    });

    // Brand Filter
    const brandCheckboxes = document.querySelectorAll('.brand-checkbox');
    brandCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', applyFilters);
    });

    // Apply Filters Function — always navigates to product-grids, never back to /product/search
    function applyFilters() {
        const selectedCategories = Array.from(
            document.querySelectorAll('.category-checkbox:checked')
        ).map(cb => cb.value);

        const selectedBrands = Array.from(
            document.querySelectorAll('.brand-checkbox:checked')
        ).map(cb => cb.value);

        const url = new URL('{{ route("product-grids") }}', window.location.origin);

        // Preserve current sort/price/show params
        const current = new URL(window.location);
        ['sortBy', 'price', 'show'].forEach(key => {
            if (current.searchParams.has(key)) {
                url.searchParams.set(key, current.searchParams.get(key));
            }
        });

        if (selectedCategories.length > 0) {
            url.searchParams.set('category', selectedCategories.join(','));
        }
        if (selectedBrands.length > 0) {
            url.searchParams.set('brand', selectedBrands.join(','));
        }

        window.location = url.toString();
    }

    // Clear Filters
    const clearFiltersBtn = document.getElementById('clearFilters');
    if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener('click', function() {
            window.location = '{{ route("product-grids") }}';
        });
    }

    // Add to Cart Handler (Example)
    const addToCartBtns = document.querySelectorAll('.add-to-cart-btn');
    addToCartBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.dataset.productId;
            console.log('Add to cart:', productId);
            // Implement your add to cart logic here
        });
    });

    // Wishlist Handler (Example)
    const wishlistBtns = document.querySelectorAll('.wishlist-btn');
    wishlistBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.dataset.productId;
            this.classList.toggle('active');
            console.log('Wishlist toggle:', productId);
            // Implement your wishlist logic here
        });
    });
});
</script>

@endsection