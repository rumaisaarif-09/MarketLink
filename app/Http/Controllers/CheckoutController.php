<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutController
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty.');
        }

        $cartItems = collect($cart)->map(function ($item, $id) {
            return [
                'id' => $id,
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'image' => $item['image'] ?? null,
            ];
        })->values();
        $total = $cartItems->sum(fn ($item) => $item['price'] * $item['quantity']);

        return view('customer.checkout', compact('cartItems', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:500'],
            'pickup_date' => ['nullable', 'date', 'after_or_equal:today'],
            'pickup_time' => ['nullable', 'string', 'max:50'],
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('customer.cart')->with('error', 'Your cart is empty.');
        }

        DB::transaction(function () use ($cart, $validated): void {
            $products = Product::whereIn('id', array_keys($cart))
                ->where('status', 'approved')
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            if ($products->count() !== count($cart)) {
                throw ValidationException::withMessages([
                    'cart' => 'One or more products are no longer available.',
                ]);
            }

            $total = 0;
            foreach ($cart as $productId => $item) {
                $quantity = filter_var($item['quantity'] ?? null, FILTER_VALIDATE_INT);
                $product = $products->get($productId);

                if (! $quantity || $quantity < 1 || $quantity > $product->stock) {
                    throw ValidationException::withMessages([
                        'cart' => "The requested quantity for {$product->name} is unavailable.",
                    ]);
                }

                $total += $product->price * $quantity;
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'payment_method' => 'COD',
                'status' => 'pending',
                'phone' => $validated['phone'],
                'shipping_address' => $validated['address'],
                'pickup_date' => $validated['pickup_date'] ?? null,
                'pickup_time' => $validated['pickup_time'] ?? null,
            ]);

            foreach ($cart as $productId => $item) {
                $product = $products->get($productId);
                $quantity = (int) $item['quantity'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ]);

                $product->decrement('stock', $quantity);
            }
        });

        session()->forget('cart');

        return redirect()->route('customer.orders')->with('success', 'Order placed successfully.');
    }
}