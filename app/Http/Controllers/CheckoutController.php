<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class CheckoutController
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Aapka cart khali hai!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'phone'   => 'required',
            'address' => 'required',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Cart khali hai!');
        }

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Check karte hain ki database table mein address ya shipping_address mein se konsa column exist karta hai
        $orderData = [
            'user_id'        => Auth::id() ?? null,
            'payment_method' => 'COD',
            'phone'          => $request->phone,
            'status'         => 'pending',
        ];

        // Total price column dynamically set kar rahe hain
        if (Schema::hasColumn('orders', 'total_amount')) {
            $orderData['total_amount'] = $totalPrice;
        } elseif (Schema::hasColumn('orders', 'grand_total')) {
            $orderData['grand_total'] = $totalPrice;
        } else {
            $orderData['total_price'] = $totalPrice;
        }

        // Address column dynamically handle kar rahe hain
        if (Schema::hasColumn('orders', 'address')) {
            $orderData['address'] = $request->address;
        } elseif (Schema::hasColumn('orders', 'shipping_address')) {
            $orderData['shipping_address'] = $request->address;
        }

        $order = Order::create($orderData);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }

        // Clear Cart Session
        session()->forget('cart');

        return redirect()->route('products.index')->with('success', 'Order Place Ho Gaya Hai!');
    }
}