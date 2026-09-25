<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->where('status', 'approved')->paginate(12);
        $categories = Category::all();

        return view('customer.products', compact('products', 'categories'));
    }

    public function dashboard()
    {
        $products = Product::where('status', 'approved')->latest()->get();

        return view('customer.dashboard', compact('products'));
    }

    public function product(string $id)
    {
        $product = Product::where('status', 'approved')->with('category')->findOrFail($id);

        return view('customer.product', compact('product'));
    }

    public function addToCart(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->input('quantity', 1);
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => $request->input('quantity', 1),
                'price' => $product->price,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('customer.product', $product->id)->with('success', 'Product added to cart successfully.');
    }

    public function cart()
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

    public function checkout()
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

        return view('customer.checkout', compact('cartItems', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:30',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('customer.cart')->with('error', 'Your cart is empty.');
        }

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $orderData = [
            'user_id' => Auth::id(),
            'total_amount' => $total,
            'payment_method' => 'COD',
            'status' => 'pending',
            'phone' => $request->phone,
        ];

        if (Schema::hasColumn('orders', 'shipping_address')) {
            $orderData['shipping_address'] = $request->address;
        }

        if (Schema::hasColumn('orders', 'address')) {
            $orderData['address'] = $request->address;
        }

        $order = Order::create($orderData);

        foreach ($cart as $productId => $item) {
            $order->items()->create([
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('customer.dashboard')->with('success', 'Order placed successfully.');
    }
}
