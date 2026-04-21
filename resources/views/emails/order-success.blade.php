<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #7fba00; color: #fff; text-align: center; padding: 20px; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { padding: 20px; background: #f9f9f9; }
        .order-info { background: #fff; padding: 15px; border-radius: 5px; margin-bottom: 15px; }
        .order-info h3 { margin-top: 0; color: #7fba00; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f5f5f5; }
        .total-row { font-weight: bold; font-size: 16px; }
        .footer { text-align: center; padding: 15px; color: #999; font-size: 12px; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 3px; font-size: 12px; color: #fff; }
        .badge-paid { background: #28a745; }
        .badge-unpaid { background: #ffc107; color: #333; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Order Confirmed!</h1>
        </div>
        <div class="content">
            <p>Dear {{ $order->first_name }} {{ $order->last_name }},</p>
            <p>Thank you for your order! We're happy to confirm that your order has been placed successfully.</p>

            <div class="order-info">
                <h3>Order Details</h3>
                <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
                <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                <p><strong>Payment Status:</strong>
                    <span class="badge {{ $order->payment_status === 'paid' ? 'badge-paid' : 'badge-unpaid' }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </p>
            </div>

            <div class="order-info">
                <h3>Items Ordered</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($order->orderItems && $order->orderItems->count() > 0)
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->product->title ?? 'N/A' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rs {{ number_format($item->price, 2) }}</td>
                                <td>Rs {{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">No items found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <table>
                    <tr>
                        <td><strong>Subtotal</strong></td>
                        <td align="right">Rs {{ number_format($order->sub_total, 2) }}</td>
                    </tr>
                    @if($order->coupon > 0)
                    <tr>
                        <td><strong>Coupon Discount</strong></td>
                        <td align="right">- Rs {{ number_format($order->coupon, 2) }}</td>
                    </tr>
                    @endif
                    <tr class="total-row">
                        <td><strong>Total</strong></td>
                        <td align="right">Rs {{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                </table>
            </div>

            <div class="order-info">
                <h3>Shipping Address</h3>
                <p>
                    {{ $order->first_name }} {{ $order->last_name }}<br>
                    {{ $order->address1 }}<br>
                    @if($order->address2) {{ $order->address2 }}<br> @endif
                    {{ $order->city ?? '' }}, {{ $order->country ?? '' }} {{ $order->post_code ?? '' }}<br>
                    Phone: {{ $order->phone }}<br>
                    Email: {{ $order->email }}
                </p>
            </div>

            @if($order->payment_method === 'cash')
                <p>Please keep the exact amount of <strong>Rs {{ number_format($order->total_amount, 2) }}</strong> ready at the time of delivery.</p>
            @else
                <p>Your payment of <strong>Rs {{ number_format($order->total_amount, 2) }}</strong> has been received via eSewa.</p>
            @endif

            <p>If you have any questions, feel free to contact us.</p>
            <p>Thank you for shopping with us!</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>