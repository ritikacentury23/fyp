@extends('layouts.app')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="frontend/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(Helper::getAllProductFromCart())
                                    @foreach(Helper::getAllProductFromCart() as $cart)
                                        @php
                                            $photo = explode(',', $cart->product['photo']);
                                        @endphp
                                        <tr>
                                            <td class="shoping__cart__item">
                                                <img src="{{ asset($photo[0]) }}" alt="{{ $cart->product['title'] }}">
                                                <h5>{{ $cart->product['title'] }}</h5>
                                            </td>
                                            <td class="shoping__cart__price">
                                                Rs {{ number_format($cart['price'], 2) }}
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="quantity">
                                                    <form action="{{ route('cart.update') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                                                        <div class="pro-qty">
                                                            <input type="text" name="quantity" value="{{ $cart->quantity }}">
                                                        </div>
                                                    </form>
                                                </div>
                                            </td>
                                            <td class="shoping__cart__total">
                                                Rs {{ number_format($cart['price'], 2) }}
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <a href="{{ route('cart-delete', $cart->id) }}">
                                                    <span class="icon_close"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <p>Your cart is empty. <a href="/">Continue Shopping</a></p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if(Helper::getAllProductFromCart())
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="/" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="" method="POST">
                                @csrf
                                <input type="text" name="code" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        @php
                            $subtotal = Helper::totalCartPrice();
                            $total = $subtotal;
                            if(session()->has('coupon')){
                                $total = $subtotal - session('coupon')['value'];
                            }
                        @endphp
                        <ul>
                            <li>Subtotal <span>Rs {{ number_format($subtotal, 2) }}</span></li>
                            @if(session()->has('coupon'))
                                <li>Coupon ({{ session('coupon')['code'] }}) <span>- Rs {{ number_format(session('coupon')['value'], 2) }}</span></li>
                            @endif
                            <li>Total <span>Rs {{ number_format($total, 2) }}</span></li>
                        </ul>
                        <a href="{{ route('checkout') }}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
    <!-- Shoping Cart Section End -->

@endsection