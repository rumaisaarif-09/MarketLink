<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminReportController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalSales = Order::sum('total_amount');
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $totalProducts = Product::count();
        $totalUsers = User::count();

        return view('admin.reports.index', compact(
            'totalOrders',
            'totalSales',
            'pendingOrders',
            'completedOrders',
            'totalProducts',
            'totalUsers'
        ));
    }
}
