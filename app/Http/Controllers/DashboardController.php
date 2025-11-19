<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts    = Product::count();
        $totalCategories  = Category::count();
        $totalUsers       = User::count();
        $lowStockProducts = Product::where('stock', '<=', 5)->count();
        $recentProducts   = Product::latest()->take(6)->get();
        $lowStockItems    = Product::where('stock', '<=', 5)->orderBy('stock', 'asc')->take(6)->get();

        // New: settings summary
        $totalSettings  = Setting::count();
        $recentSettings = Setting::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalUsers',
            'lowStockProducts',
            'recentProducts',
            'lowStockItems',
            'totalSettings',
            'recentSettings'
        ));
    }
}
