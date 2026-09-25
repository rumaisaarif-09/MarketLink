<?php

namespace App\Http\Controllers;

use App\Models\Order;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $userId = auth()->id() ?? 1;

        $orders = Order::where('user_id', $userId)
            ->latest()
            ->get();

        return view('customer.orders', compact('orders'));
    }
}
