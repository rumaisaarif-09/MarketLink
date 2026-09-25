<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();

        $totalFarmers = 0;

        $totalProducts = Product::count();

        $pendingProducts = Product::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalFarmers',
            'totalProducts',
            'pendingProducts'
        ));
    }

    public function products()
    {
        $products = Product::with('category', 'farmer')
            ->latest()
            ->get();

        return view('admin.products.index', compact('products'));
    }

    public function approveProduct(string $id)
    {
        $product = Product::findOrFail($id);

        $product->status = 'approved';
        $product->save();

        return redirect()
            ->route('admin.products')
            ->with('success', 'Product approved successfully.');
    }

    public function rejectProduct(string $id)
    {
        $product = Product::findOrFail($id);

        $product->status = 'rejected';
        $product->save();

        return redirect()
            ->route('admin.products')
            ->with('success', 'Product rejected successfully.');
    }
}
