<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // GET /categories
    public function index()
    {
        // Get all categories with product count
        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Display the specified category and its products.
     */
    public function show(Category $category)
    {
        // Get paginated products for this category
        $products = $category->products()->paginate(12);

        return view('categories.show', compact('category', 'products'));
    }
}
