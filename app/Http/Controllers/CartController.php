<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * The cart service instance.
     */
    protected CartService $cartService;

    /**
     * Create a new controller instance.
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display the shopping cart.
     */
    public function index()
    {
        $items = $this->cartService->items();
        $total = $this->cartService->total();
        $count = $this->cartService->count();

        return view('cart.index', compact('items', 'total', 'count'));
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1',
        ]);

        $productId = $validated['product_id'];
        $quantity = $validated['quantity'] ?? 1;

        // Check if product exists and has sufficient stock
        $product = Product::findOrFail($productId);

        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', 'Insufficient stock available.');
        }

        $this->cartService->add($productId, $quantity);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Update the quantity of a cart item.
     */
    public function update(Request $request, $productId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $quantity = $validated['quantity'];

        // Check stock availability if quantity > 0
        if ($quantity > 0) {
            $product = Product::findOrFail($productId);

            if ($product->stock < $quantity) {
                return redirect()->back()->with('error', 'Insufficient stock available.');
            }
        }

        $this->cartService->update($productId, $quantity);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    /**
     * Remove a product from the cart.
     */
    public function remove($productId)
    {
        $this->cartService->remove($productId);

        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }

    /**
     * Clear all items from the cart.
     */
    public function clear()
    {
        $this->cartService->clear();

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }
}
