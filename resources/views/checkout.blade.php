@extends('layouts.app')

@section('content')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="frontend/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Checkout</h2>
                    <div class="breadcrumb__option">
                        <a href="/">Home</a>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Flash Messages -->
@if(session('success'))
    <div class="container mt-3">
        <div class="alert alert-success">{{ session('success') }}</div>
    </div>
@endif
@if(session('error'))
    <div class="container mt-3">
        <div class="alert alert-danger">{{ session('error') }}</div>
    </div>
@endif

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Billing Details</h4>
            <form name="checkout-form" method="POST" action="{{ route('cart.order') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>First Name<span>*</span></p>
                                    <input type="text" name="first_name" value="{{ old('first_name') }}" required>
                                    @error('first_name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Last Name<span>*</span></p>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                                    @error('last_name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Email<span>*</span></p>
                            <input type="email" name="email" value="{{ old('email') }}" required>
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" name="address1" placeholder="Street Address" class="checkout__input__add" value="{{ old('address1') }}" required>
                            @error('address1')<span class="text-danger">{{ $message }}</span>@enderror
                            <input type="text" name="address2" placeholder="Apartment, suite, unit etc (optional)" value="{{ old('address2') }}">
                        </div>
                        <div class="checkout__input">
                            <p>Town/City<span>*</span></p>
                            <input type="text" name="city" value="{{ old('city') }}" required>
                            @error('city')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="checkout__input">
                            <p>Country/State<span>*</span></p>
                            <input type="text" name="country" value="{{ old('country') }}" required>
                            @error('country')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="checkout__input">
                            <p>Postcode / ZIP<span>*</span></p>
                            <input type="text" name="post_code" value="{{ old('post_code') }}" required>
                            @error('post_code')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input type="text" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Landmark</p>
                                    <input type="text" name="landmark" value="{{ old('landmark') }}">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Order Notes</p>
                            <input type="text" name="order_notes" placeholder="Notes about your order, e.g. special notes for delivery." value="{{ old('order_notes') }}">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Your Order</h4>

                            @if(Helper::getAllProductFromCart())
                                @php
                                    $subtotal = 0;
                                @endphp

                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @foreach(Helper::getAllProductFromCart() as $cart)
                                        @php
                                            $itemTotal = $cart->price * $cart->quantity;
                                            $subtotal += $itemTotal;
                                        @endphp
                                        <li>{{ $cart->product->title }} x {{ $cart->quantity }} <span>Rs {{ number_format($itemTotal, 2) }}</span></li>
                                    @endforeach
                                </ul>

                                @php
                                    $total = $subtotal;
                                    if(session()->has('coupon')){
                                        $total = $subtotal - session('coupon')['value'];
                                    }
                                @endphp

                                <div class="checkout__order__subtotal">Subtotal <span>Rs {{ number_format($subtotal, 2) }}</span></div>
                                @if(session()->has('coupon'))
                                    <div class="checkout__order__subtotal">Coupon ({{ session('coupon')['code'] }}) <span>- Rs {{ number_format(session('coupon')['value'], 2) }}</span></div>
                                @endif
                                <div class="checkout__order__total">Total <span>Rs {{ number_format($total, 2) }}</span></div>
                            @else
                                <p>Your cart is empty.</p>
                            @endif

                            <div class="checkout__input__checkbox">
                                <label for="cash">
                                    Cash on Delivery
                                    <input type="radio" name="checkout_payment_method" id="cash" value="cash" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="esewa">
                                    eSewa
                                    <input type="radio" name="checkout_payment_method" id="esewa" value="esewa">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <button type="submit" id="checkout-btn" class="site-btn">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#checkout-btn').on('click', function (e) {
        var selectedPaymentMethod = $('input[name="checkout_payment_method"]:checked').val();

        if (selectedPaymentMethod === 'esewa') {
            e.preventDefault();

            // Validate required fields before submitting
            var form = $('form[name="checkout-form"]');
            var isValid = true;

            form.find('input[required]').each(function () {
                if (!$(this).val().trim()) {
                    isValid = false;
                    $(this).css('border-color', 'red');
                } else {
                    $(this).css('border-color', '');
                }
            });

            if (!isValid) {
                alert('Please fill in all required fields.');
                return;
            }

            // Create a hidden form to POST to esewa pay route
            var esewaForm = $('<form>', {
                method: 'POST',
                action: '{{ route("esewa.pay") }}'
            });

            esewaForm.append($('<input>', {
                type: 'hidden',
                name: '_token',
                value: '{{ csrf_token() }}'
            }));

            // Copy all form fields
            form.find('input, select, textarea').each(function () {
                if ($(this).attr('name')) {
                    esewaForm.append($('<input>', {
                        type: 'hidden',
                        name: $(this).attr('name'),
                        value: $(this).val()
                    }));
                }
            });

            $('body').append(esewaForm);
            esewaForm.submit();
        }
        // For cash on delivery, the form submits normally to cart.order
    });
</script>

@endsection