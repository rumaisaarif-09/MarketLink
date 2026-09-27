<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->where('status', 'approved');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('market')) {
            $query->where('user_id', $request->market);
        }

        if ($request->filled('day')) {
            $query->whereHas('farmer', function ($farmerQuery) use ($request) {
                $farmerQuery->where('market_day', $request->day);
            });
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', (float) $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', (float) $request->price_max);
        }

        $products = $query->with('category', 'farmer')->paginate(6)->withQueryString();
        $categories = Category::all();
        $markets = \App\Models\User::whereIn('role', ['vendor', 'farmer'])->where('is_active', true)->orderBy('market_name')->get();

        return view('customer.products', compact('products', 'categories', 'markets'));
    }

    public function dashboard()
    {
        $products = Product::where('status', 'approved')->latest()->get();

        return view('customer.dashboard', compact('products'));
    }

    public function product(string $id)
    {
        $product = Product::where('status', 'approved')->with('category')->findOrFail($id);
        $reviews = Review::with('user')
            ->where('product_id', $product->id)
            ->where('is_visible', true)
            ->latest()
            ->get();
        $canReview = false;
        if (Auth::check() && Auth::user()->role === 'buyer') {
            $purchasedAndDelivered = Order::where('user_id', Auth::id())
                ->whereIn('status', ['delivered', 'completed'])
                ->whereHas('items', fn ($query) => $query->where('product_id', $product->id))
                ->exists();
            $alreadyReviewed = Review::where('product_id', $product->id)
                ->where('user_id', Auth::id())
                ->exists();

            $canReview = $purchasedAndDelivered && ! $alreadyReviewed;
        }

        return view('customer.product', compact('product', 'reviews', 'canReview'));
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

    public function toggleFavorite(Request $request, string $type, string $id): \Illuminate\Http\RedirectResponse
    {
        if (! in_array($type, ['product', 'farmer'], true)) {
            return back()->with('error', 'Favorite type not supported.');
        }

        $favorite = Favorite::where('user_id', Auth::id())
            ->where('favorite_type', $type)
            ->where('favorite_id', $id)
            ->first();

        if ($favorite) {
            $favorite->delete();

            return back()->with('success', 'Removed from favorites.');
        }

        Favorite::create([
            'user_id' => Auth::id(),
            'favorite_type' => $type,
            'favorite_id' => $id,
        ]);

        return back()->with('success', 'Added to favorites.');
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
