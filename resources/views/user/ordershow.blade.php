 @extends('layouts.app')

@section('content')
<style>
<style>.table> :not(caption)>tr>th {
    padding: 0.625rem 1.5rem 0.625rem !important;
    background-color: #6a6e51 !important;
}

.table>tr>td {
    padding: 0.625rem 1.5rem 0.625rem !important;
}

.table-bordered> :not(caption)>tr>th,
.table-bordered> :not(caption)>tr>td {
    border-width: 1px 1px;
    border-color: #6a6e51;
}

.table> :not(caption)>tr>td {
    padding: 0.8rem 1rem !important;
}

.bg-success {
    background-color: #40c710 !important;
}

.bg-danger {
    background-color: #f44032 !important;
}

.bg-warning {
    background-color: #f5d700 !important;
    color: #000;
}
</style>

<main class="pt-90" style="padding-top: 0px">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Orders</h2>
        <div class="row">
            <div class="col-lg-2">
                @include('user.include.sidebar')
            </div>
            <div class="col-lg-10">
                <div class="order-complete">
                    <div class="order-complete__message">

                        <h3>Order Details</h3>

                    </div>
                    <div class="order-info">
                        <div class="order-info__item">
                            <label>Order Number</label>
                            <span>{{ $order->order_number }}</span>
                        </div>
                        <div class="order-info__item">
                            <label>Date</label>
                            <span>{{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</span>
                        </div>

                        <div class="order-info__item">
                            <label>Payment Method</label>
                            <span>{{ $order->payment_method }}</span>
                        </div>
                    </div>
                    <div class="checkout__totals-wrapper">
                        <div class="checkout__totals">
                            <h3>Order Details</h3>
                            <table class="checkout-cart-items">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Item</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $totalAmount = 0; @endphp {{-- Initialize Total Amount --}}

                                    @foreach($order->orderItems as $key => $item)
                                    @php
                                  
                                    $itemTotal = $item->price * $item->quantity; 
                                    $totalAmount += $itemTotal; // Sum total price
                                    @endphp
                                    <tr>
                                        <td>
                                            {{ $key + 1 }}
                                        </td>
                                        <td>
                                            {{ $item->product->title }}
                                        </td>
                                        <td>
                                            <img src="{{ asset($item->product->photo) }}" alt="Product Image"
                                                class="img-thumbnail" style="width: 50px; height: 50px;">
                                        </td>
                                        <td>${{ number_format($item->price, 2) }}</td> {{-- Format price --}}
                                        <td>{{ $item->quantity }}</td>
                                        <td class="text-end">Rs{{ number_format($itemTotal, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="checkout-totals">
                                <tbody>
                                    <tr>
                                        <th>SUBTOTAL</th>
                                        <td>Rs{{ number_format($totalAmount, 2) }}</td>
                                    </tr>

                                    <tr>
                                        <th>TOTAL</th>
                                        <td>Rs{{ number_format($totalAmount, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection