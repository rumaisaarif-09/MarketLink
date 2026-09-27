<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartItems = collect($cart)->map(function ($item, $id) {
            return [
                'id' => $id,
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'image' => $item['image'] ?? null,
            ];
        })->values();

        $total = $cartItems->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('customer.cart', compact('cartItems', 'total'));
    }

    public function addToCart(Request $request, $id)
    {
        $validated = $request->validate([
            'quantity' => ['sometimes', 'integer', 'min:1'],
        ]);

        $product = Product::where('status', 'approved')->findOrFail($id);
        $cart = session()->get('cart', []);
        $quantity = (int) ($validated['quantity'] ?? 1);
        $existingQuantity = (int) ($cart[$id]['quantity'] ?? 0);

        if ($existingQuantity + $quantity > $product->stock) {
            return redirect()->back()->with('error', 'Requested quantity exceeds available stock.');
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart successfully.');
    }

    public function destroy(string $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('customer.cart')->with('success', 'Product removed from cart.');
    }
}
