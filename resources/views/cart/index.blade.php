@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Shopping Cart</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if($items->isEmpty())
        <div class="bg-gray-100 border border-gray-300 rounded-lg p-8 text-center">
            <p class="text-gray-600 text-lg mb-4">Your cart is empty.</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                Continue Shopping
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Cart Items Section -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($items as $item)
                                <tr>
                                    <!-- Product Info -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if($item['product']->image)
                                                <img src="{{ asset('storage/' . $item['product']->image) }}" 
                                                     alt="{{ $item['product']->name }}" 
                                                     class="w-16 h-16 object-cover rounded mr-4">
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 rounded mr-4 flex items-center justify-center">
                                                    <span class="text-gray-400 text-xs">No Image</span>
                                                </div>
                                            @endif
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $item['product']->name }}</p>
                                                <p class="text-sm text-gray-500">{{ Str::limit($item['product']->description, 50) }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Price -->
                                    <td class="px-6 py-4 text-gray-900">
                                        ${{ number_format($item['product']->price, 2) }}
                                    </td>

                                    <!-- Quantity Update Form -->
                                    <td class="px-6 py-4">
                                        <form action="{{ route('cart.update', $item['product']->id) }}" method="POST" class="flex items-center space-x-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" 
                                                   name="quantity" 
                                                   value="{{ $item['quantity'] }}" 
                                                   min="0" 
                                                   max="{{ $item['product']->stock }}"
                                                   class="w-20 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <button type="submit" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                                Update
                                            </button>
                                        </form>
                                        <p class="text-xs text-gray-500 mt-1">Stock: {{ $item['product']->stock }}</p>
                                    </td>

                                    <!-- Subtotal -->
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        ${{ number_format($item['subtotal'], 2) }}
                                    </td>

                                    <!-- Remove Button -->
                                    <td class="px-6 py-4">
                                        <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST" onsubmit="return confirm('Remove this item from cart?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Clear Cart Button -->
                <div class="mt-4">
                    <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear your cart?');">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                            Clear Cart
                        </button>
                    </form>
                </div>
            </div>

            <!-- Cart Summary Section -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">Cart Summary</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Items:</span>
                            <span class="font-medium">{{ $count }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold border-t pt-3">
                            <span>Total:</span>
                            <span class="text-indigo-600">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <a href="{{ route('products.index') }}" 
                           class="block w-full text-center bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
                            Continue Shopping
                        </a>
                        <button class="block w-full bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                            Proceed to Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
