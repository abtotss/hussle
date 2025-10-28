<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // GET /categories
    public function index()
    {
        // withCount avoids calling products()->count() in loop (N+1)
        $categories = Category::withCount('products')->orderBy('name')->get();

        return view('categories.index', compact('categories'));
    }

    // GET /categories/{category:slug}
    public function show(Category $category)
    {
        // eager-load paginated products to avoid huge payloads
        $products = $category->products()->select('products.*')->paginate(12);

        return view('categories.show', compact('category','products'));
    }
}
