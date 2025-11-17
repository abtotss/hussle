<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User; // <-- New Import

class AdminController extends Controller
{
    public function index()
    {
        // 1. Total Counts (KPIs)
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();

        // 2. Low Stock and Recent Products (Dashboard Lists)
        $lowStockItems = Product::where('stock', '<=', 5)->get();
        $lowStockProducts = $lowStockItems->count();
        $recentProducts = Product::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalUsers',
            'lowStockProducts',
            'recentProducts',
            'lowStockItems'
        ));
    }
}