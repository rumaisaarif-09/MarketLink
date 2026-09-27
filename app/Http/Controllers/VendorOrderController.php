<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VendorOrderController extends Controller
{
    public function index(): View
    {
        $vendorId = Auth::id();
        $vendorProducts = fn ($query) => $query->where('user_id', $vendorId);

        $orders = Order::whereHas('items.product', $vendorProducts)
            ->with([
                'user',
                'items' => fn ($query) => $query
                    ->whereHas('product', $vendorProducts)
                    ->with('product'),
            ])
            ->latest()
            ->get();

        return view('vendor.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:pending,accepted,ready_for_pickup,completed,cancelled'],
        ]);

        $vendorIds = $order->items()->with('product')->get()->pluck('product.user_id')->filter();

        if (! $vendorIds->contains(Auth::id())) {
            abort(403);
        }

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}