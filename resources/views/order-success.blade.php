@extends('layouts.app')

@section('content')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="frontend/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Order Confirmed</h2>
                    <div class="breadcrumb__option">
                        <a href="/">Home</a>
                        <span>Order Success</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Order Success Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <!-- Success Message -->
                <div class="text-center mb-5">
                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="40" cy="40" r="40" fill="#7fba00" />
                        <path d="M52.9743 35.7612C52.9743 35.3426 52.8069 34.9241 52.5056 34.6228L50.2288 32.346C49.9275 32.0446 49.5089 31.8772 49.0904 31.8772C48.6719 31.8772 48.2533 32.0446 47.952 32.346L36.9699 43.3449L32.048 38.4062C31.7467 38.1049 31.3281 37.9375 30.9096 37.9375C30.4911 37.9375 30.0725 38.1049 29.7712 38.4062L27.4944 40.683C27.1931 40.9844 27.0257 41.4029 27.0257 41.8214C27.0257 42.24 27.1931 42.6585 27.4944 42.9598L33.5547 49.0201L35.8315 51.2969C36.1328 51.5982 36.5513 51.7656 36.9699 51.7656C37.3884 51.7656 37.8069 51.5982 38.1083 51.2969L40.385 49.0201L52.5056 36.8996C52.8069 36.5982 52.9743 36.1797 52.9743 35.7612Z" fill="white" />
                    </svg>
                    <h3 class="mt-3">Your order is completed!</h3>
                    <p>Thank you. Your order has been received.</p>
                </div>

                <!-- Order Info Summary -->
                <div class="row mb-4">
                    <div class="col-md-3 col-6 text-center mb-3">
                        <p style="color: #999; margin-bottom: 5px;">Order Number</p>
                        <strong>{{ $order->order_number }}</strong>
                    </div>
                    <div class="col-md-3 col-6 text-center mb-3">
                        <p style="color: #999; margin-bottom: 5px;">Date</p>
                        <strong>{{ $order->created_at->format('d M, Y') }}</strong>
                    </div>
                    <div class="col-md-3 col-6 text-center mb-3">
                        <p style="color: #999; margin-bottom: 5px;">Total</p>
                        <strong>Rs {{ number_format($order->total_amount, 2) }}</strong>
                    </div>
                    <div class="col-md-3 col-6 text-center mb-3">
                        <p style="color: #999; margin-bottom: 5px;">Payment Method</p>
                        <strong>{{ ucfirst($order->payment_method) }}</strong>
                        @if($order->payment_status === 'paid')
                            <span style="color: #28a745; font-size: 12px; display: block;">(Paid)</span>
                        @else
                            <span style="color: #ffc107; font-size: 12px; display: block;">(Cash on Delivery)</span>
                        @endif
                    </div>
                </div>

                <!-- Order Details Table -->
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
                                <th class="shoping__product">Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalAmount = 0; @endphp
                            @foreach($order->orderItems as $key => $item)
                                @php
                                    $itemTotal = $item->price * $item->quantity;
                                    $totalAmount += $itemTotal;
                                    $photo = explode(',', $item->product->photo ?? '');
                                @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ asset($photo[0]) }}" alt="{{ $item->product->title ?? '' }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                                    </td>
                                    <td class="shoping__cart__item">
                                        <h5>{{ $item->product->title ?? 'N/A' }}</h5>
                                    </td>
                                    <td class="shoping__cart__price">Rs {{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td class="shoping__cart__total">Rs {{ number_format($itemTotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Totals & Shipping -->
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <div class="shoping__checkout">
                            <h5>Shipping Details</h5>
                            <ul>
                                <li>Name <span>{{ $order->first_name }} {{ $order->last_name }}</span></li>
                                <li>Address <span>{{ $order->address1 }}{{ $order->address2 ? ', ' . $order->address2 : '' }}</span></li>
                                <li>City <span>{{ $order->city ?? 'N/A' }}</span></li>
                                <li>Country <span>{{ $order->country ?? 'N/A' }}</span></li>
                                <li>Post Code <span>{{ $order->post_code ?? 'N/A' }}</span></li>
                                <li>Phone <span>{{ $order->phone }}</span></li>
                                <li>Email <span>{{ $order->email }}</span></li>
                                @if($order->landmark)
                                    <li>Landmark <span>{{ $order->landmark }}</span></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="shoping__checkout">
                            <h5>Cart Total</h5>
                            <ul>
                                <li>Subtotal <span>Rs {{ number_format($order->sub_total, 2) }}</span></li>
                                @if($order->coupon > 0)
                                    <li>Coupon Discount <span>- Rs {{ number_format($order->coupon, 2) }}</span></li>
                                @endif
                                <li>Total <span><strong>Rs {{ number_format($order->total_amount, 2) }}</strong></span></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Cash on Delivery Notice -->
                @if($order->payment_method === 'cash')
                    <div style="background: #fff3cd; padding: 15px; border-radius: 5px; border: 1px solid #ffc107; margin-top: 20px;">
                        <strong><i class="fa fa-info-circle"></i> Cash on Delivery:</strong> Please keep Rs {{ number_format($order->total_amount, 2) }} ready at the time of delivery.
                    </div>
                @endif

                <!-- eSewa Payment Notice -->
                @if($order->payment_method === 'esewa' && $order->payment_status === 'paid')
                    <div style="background: #d4edda; padding: 15px; border-radius: 5px; border: 1px solid #28a745; margin-top: 20px;">
                        <strong><i class="fa fa-check-circle"></i> Payment Received:</strong> Your payment of Rs {{ number_format($order->total_amount, 2) }} has been successfully received via eSewa.
                    </div>
                @endif

                <!-- Email Confirmation Notice -->
                <div style="background: #e8f4fd; padding: 15px; border-radius: 5px; border: 1px solid #b8daff; margin-top: 15px;">
                    <strong><i class="fa fa-envelope"></i> Confirmation Email:</strong> A confirmation email has been sent to <strong>{{ $order->email }}</strong>
                </div>

                <!-- Continue Shopping -->
                <div class="text-center mt-5 mb-5">
                    <a href="/" class="primary-btn">CONTINUE SHOPPING</a>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Order Success Section End -->

@endsection