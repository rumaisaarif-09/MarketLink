<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $products = Product::where('status', 'approved')
            ->latest()
            ->get();

        return view('customer.dashboard', compact('products'));
    }

    public function product(string $id)
    {
        $product = Product::where('status', 'approved')
            ->with('category')
            ->findOrFail($id);

        return view('customer.product', compact('product'));
    }

    public function addToCart(string $id)
    {
        $product = Product::where('status', 'approved')
            ->findOrFail($id);

        $userId = auth()->id() ?? 1;

        $cart = Cart::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()
            ->route('customer.product', $product->id)
            ->with('success', 'Product added to cart successfully.');
    }
public function cart()
{
    $userId = auth()->id() ?? 1;

    $cartItems = Cart::where('user_id', $userId)
        ->with('product')
        ->latest()
        ->get();

    $total = $cartItems->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });

    return view('customer.cart', compact('cartItems', 'total'));
}

public function checkout()
{
    $userId = auth()->id() ?? 1;

    $cartItems = Cart::where('user_id', $userId)
        ->with('product')
        ->get();

    $total = $cartItems->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });

    return view('customer.checkout', compact('cartItems', 'total'));
}

public function placeOrder(\Illuminate\Http\Request $request)
{
    $request->validate([
        'shipping_address' => 'required|string|max:500',
        'phone' => 'required|string|max:30',
        'payment_method' => 'required|string|max:50',
    ]);

    $userId = auth()->id() ?? 1;

    $cartItems = Cart::where('user_id', $userId)
        ->with('product')
        ->get();

    if ($cartItems->isEmpty()) {
        return redirect()
            ->route('customer.cart')
            ->with('error', 'Your cart is empty.');
    }

    $total = $cartItems->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });

    \App\Models\Order::create([
        'user_id' => $userId,
        'total_amount' => $total,
        'payment_method' => $request->payment_method,
        'status' => 'pending',
        'shipping_address' => $request->shipping_address,
        'phone' => $request->phone,
    ]);

    Cart::where('user_id', $userId)->delete();

    return redirect()
        ->route('customer.dashboard')
        ->with('success', 'Order placed successfully.');
}
}
