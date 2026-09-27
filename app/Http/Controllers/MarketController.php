<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class MarketController extends Controller
{
    public function index(): View
    {
        $markets = User::query()
            ->whereIn('role', ['vendor', 'farmer'])
            ->where('is_active', true)
            ->whereNotNull('market_latitude')
            ->whereNotNull('market_longitude')
            ->whereNotNull('market_name')
            ->withCount(['products as available_products_count' => fn ($query) => $query->where('status', 'approved')])
            ->orderBy('market_name')
            ->get();

        $locations = $markets->map(fn (User $market) => [
            'name' => $market->market_name,
            'address' => $market->market_address ?: $market->name,
            'latitude' => (float) $market->market_latitude,
            'longitude' => (float) $market->market_longitude,
            'products' => $market->available_products_count,
            'url' => route('products.index'),
        ])->values();

        return view('markets', compact('markets', 'locations'));
    }
}