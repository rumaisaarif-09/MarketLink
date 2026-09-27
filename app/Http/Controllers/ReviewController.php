<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function store(Request $request, string $productId): RedirectResponse
    {
        $product = Product::where('status', 'approved')->findOrFail($productId);
        $purchased = Order::where('user_id', Auth::id())
            ->whereIn('status', ['delivered', 'completed'])
            ->whereHas('items', fn ($query) => $query->where('product_id', $product->id))
            ->exists();

        if (! $purchased) {
            return back()->with('error', 'Reviews are available after delivery of this product.');
        }

        if (Review::where('product_id', $product->id)->where('user_id', Auth::id())->exists()) {
            return back()->with('error', 'You have already reviewed this product.');
        }

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['nullable', 'string', 'max:2000'],
        ]);

        Review::create([
            ...$validated,
            'product_id' => $product->id,
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Review submitted successfully.');
    }

    public function vendorIndex(): View
    {
        $reviews = Review::with(['product', 'user'])
            ->whereHas('product', fn ($query) => $query->where('user_id', Auth::id()))
            ->latest()
            ->get();

        return view('vendor.reviews.index', compact('reviews'));
    }

    public function respond(Request $request, string $reviewId): RedirectResponse
    {
        $review = Review::whereHas('product', fn ($query) => $query->where('user_id', Auth::id()))
            ->findOrFail($reviewId);

        $validated = $request->validate([
            'vendor_response' => ['required', 'string', 'max:2000'],
        ]);

        $review->update($validated);

        return back()->with('success', 'Response posted successfully.');
    }

    public function adminIndex(): View
    {
        $reviews = Review::with(['product', 'user'])->latest()->get();

        return view('admin.reviews.index', compact('reviews'));
    }

    public function toggleVisibility(string $reviewId): RedirectResponse
    {
        $review = Review::findOrFail($reviewId);
        $review->update(['is_visible' => ! $review->is_visible]);

        return back()->with('success', 'Review visibility updated.');
    }
}