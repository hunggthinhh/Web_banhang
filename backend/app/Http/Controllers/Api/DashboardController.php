<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function stats()
    {
        return response()->json([
            'productsCount' => Product::count(),
            'ordersCount' => Order::count(),
            'usersCount' => User::where('role', 'user')->count(),
            'revenue' => Order::where('status', 'completed')->sum('total_amount'),
            'recentOrders' => Order::orderBy('created_at', 'desc')->take(5)->get()
        ]);
    }
}
