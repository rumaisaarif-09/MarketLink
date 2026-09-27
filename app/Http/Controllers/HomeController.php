<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $categories = Category::query()->orderBy('name')->get();
        $products = Product::query()
            ->with('category')
            ->where('status', 'approved')
            ->latest()
            ->take(4)
            ->get();

        return view('landing', compact('categories', 'products'));
    }
}