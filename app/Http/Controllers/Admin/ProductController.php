<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->orderByDesc('id')->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);

        if (!empty($data['categories'])) {
            $product->categories()->sync($data['categories']);
        }

        return redirect()->route('admin.products.index')->with('success','Product created.');
    }

    public function show(Product $product)
    {
        $product->load('categories');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        if ($request->hasFile('image')) {
            // delete old image if exists
            if ($product->image) { Storage::disk('public')->delete($product->image); }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        $product->categories()->sync($data['categories'] ?? []);

        return redirect()->route('admin.products.index')->with('success','Product updated.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) { Storage::disk('public')->delete($product->image); }
        $product->categories()->detach();
        $product->delete();

        return redirect()->route('admin.products.index')->with('success','Product deleted.');
    }
}