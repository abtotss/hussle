<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get recent products for user dashboard
        $recentProducts = Product::with('categories')
            ->orderByDesc('created_at')
            ->take(6)
            ->get();

        $totalProducts = Product::count();
        $totalCategories = Category::count();

        return view('dashboard', compact('recentProducts', 'totalProducts', 'totalCategories'));
    }
}
