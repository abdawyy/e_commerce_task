<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\GuestUser;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    /**
     * Display dashboard stats.
     */
    public function index()
    {
        $stats = [
            'total_orders'      => Order::count(),
            'completed_orders'  => Order::where('status', 'completed')->count(),
            'total_products'    => Product::count(),
            'total_admins'      => User::count(),
            'guest_users'       => GuestUser::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
