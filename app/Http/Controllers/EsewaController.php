<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSuccessMail;
use Xentixar\EsewaSdk\Esewa;

class EsewaController extends Controller
{
    public function pay(Request $request)
    {
        $transactionUuid = uniqid('txn_' . microtime(true) . '_', true);

        session()->put('checkout_data', $request->except('_token'));

        $carts = Cart::where('user_id', Auth::id())->where('order_id', null)->get();
        $sum = 0;

        foreach ($carts as $cart) {
            $sum += $cart->price * $cart->quantity;
        }

        if (session()->has('coupon')) {
            $sum = $sum - session('coupon')['value'];
        }

        if ($sum > 0) {
            $esewa = new Esewa();
            $esewa->config(
                route('esewa.check'),
                route('esewa.check'),
                $sum,
                $transactionUuid
            );
            $esewa->init();
        } else {
            return redirect()->route('checkout')->with('error', 'Your cart is empty.');
        }
    }

    public function check(Request $request)
    {
        $esewa = new Esewa();
        $data = $esewa->decode();

        if ($data && $data['status'] === 'COMPLETE') {
            $carts = Cart::where('user_id', Auth::id())->where('order_id', null)->get();
            $checkoutData = session('checkout_data');

            if ($carts->isEmpty()) {
                return redirect()->route('home')->with('error', 'No items found in cart.');
            }

            $subtotal = 0;
            foreach ($carts as $cart) {
                $subtotal += $cart->price * $cart->quantity;
            }

            $couponDiscount = 0;
            if (session()->has('coupon')) {
                $couponDiscount = session('coupon')['value'];
            }

            $total = $subtotal - $couponDiscount;

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'sub_total' => $subtotal,
                'coupon' => $couponDiscount,
                'total_amount' => $total,
                'quantity' => $carts->sum('quantity'),
                'payment_method' => 'esewa',
                'payment_status' => 'paid',
                'status' => 'process',
                'first_name' => $checkoutData['first_name'] ?? '',
                'last_name' => $checkoutData['last_name'] ?? '',
                'email' => $checkoutData['email'] ?? '',
                'phone' => $checkoutData['phone'] ?? '',
                'address1' => $checkoutData['address1'] ?? '',
                'address2' => $checkoutData['address2'] ?? '',
                'city' => $checkoutData['city'] ?? '',
                'country' => $checkoutData['country'] ?? '',
                'post_code' => $checkoutData['post_code'] ?? '',
                'landmark' => $checkoutData['landmark'] ?? '',
                'order_notes' => $checkoutData['order_notes'] ?? '',
                'transaction_code' => $data['transaction_code'] ?? '',
            ]);

            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->price,
                    'total' => $cart->quantity * $cart->price,
                ]);

                $cart->update(['order_id' => $order->id]);
            }

            $email = $checkoutData['email'] ?? Auth::user()->email;
            Mail::to($email)->send(new OrderSuccessMail($order));

            session()->forget(['checkout_data', 'coupon']);

            return redirect()->route('order.success', $order->id);
        }

        session()->forget('checkout_data');
        return redirect()->route('checkout')->with('error', 'eSewa payment failed or was cancelled.');
    }
}