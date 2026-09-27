<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->latest()
            ->get();

        return view('customer.orders', compact('orders'));
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if (! $order->canBeCancelled()) {
            return back()->with('error', 'This order cannot be cancelled.');
        }

        $order->status = 'cancelled';
        $order->save();

        return redirect()->route('customer.orders')->with('success', 'Order cancelled successfully.');
    }
}
