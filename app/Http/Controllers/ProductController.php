<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET /products
    public function index()
    {
        // paginate to avoid huge pages
        $products = Product::with('categories')->paginate(12);
        return view('products.index', compact('products'));
    }

    // GET /products/{product:slug}
    public function show(Product $product)
    {
        $product->load('categories');
        return view('products.show', compact('product'));
    }
}
