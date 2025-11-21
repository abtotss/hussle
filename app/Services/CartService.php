<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class CartService
{
    /**
     * Session key for storing cart data.
     */
    protected const CART_SESSION_KEY = 'cart';

    /**
     * Add a product to the cart.
     *
     * @param int $productId
     * @param int $quantity
     * @return void
     */
    public function add(int $productId, int $quantity = 1): void
    {
        $cart = $this->getCart();

        // If product already exists in cart, increase quantity
        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        $this->saveCart($cart);
    }

    /**
     * Update the quantity of a product in the cart.
     *
     * @param int $productId
     * @param int $quantity
     * @return void
     */
    public function update(int $productId, int $quantity): void
    {
        $cart = $this->getCart();

        if ($quantity <= 0) {
            // If quantity is 0 or negative, remove the item
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $quantity;
        }

        $this->saveCart($cart);
    }

    /**
     * Remove a product from the cart.
     *
     * @param int $productId
     * @return void
     */
    public function remove(int $productId): void
    {
        $cart = $this->getCart();
        unset($cart[$productId]);
        $this->saveCart($cart);
    }

    /**
     * Get all items in the cart with product details.
     *
     * @return Collection
     */
    public function items(): Collection
    {
        $cart = $this->getCart();

        if (empty($cart)) {
            return collect([]);
        }

        // Fetch product details from database
        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get();

        // Map products with their quantities and calculate subtotals
        return $products->map(function ($product) use ($cart) {
            return [
                'product' => $product,
                'quantity' => $cart[$product->id],
                'subtotal' => $product->price * $cart[$product->id],
            ];
        });
    }

    /**
     * Get the total number of items in the cart.
     *
     * @return int
     */
    public function count(): int
    {
        $cart = $this->getCart();
        return array_sum($cart);
    }

    /**
     * Calculate the total price of all items in the cart.
     *
     * @return float
     */
    public function total(): float
    {
        return $this->items()->sum('subtotal');
    }

    /**
     * Clear all items from the cart.
     *
     * @return void
     */
    public function clear(): void
    {
        session()->forget(self::CART_SESSION_KEY);
    }

    /**
     * Get the raw cart data from session.
     *
     * @return array
     */
    protected function getCart(): array
    {
        return session()->get(self::CART_SESSION_KEY, []);
    }

    /**
     * Save the cart data to session.
     *
     * @param array $cart
     * @return void
     */
    protected function saveCart(array $cart): void
    {
        session()->put(self::CART_SESSION_KEY, $cart);
    }
}
