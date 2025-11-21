@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb Navigation -->
    <nav class="flex mb-6 text-sm text-gray-600">
        <a href="{{ route('home') }}" class="hover:text-indigo-600">Home</a>
        <span class="mx-2">/</span>
        <a href="{{ route('products.index') }}" class="hover:text-indigo-600">Products</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">{{ $product->name }}</span>
    </nav>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Product Image Section -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-96 object-cover">
            @else
                <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                    <div class="text-center">
                        <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="mt-2 text-gray-500">No Image Available</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Product Details Section -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <!-- Product Name -->
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>

            <!-- Category Badge -->
            @if($product->category)
                <a href="{{ route('categories.show', $product->category->slug) }}" 
                   class="inline-block bg-indigo-100 text-indigo-800 text-sm px-3 py-1 rounded-full mb-4 hover:bg-indigo-200">
                    {{ $product->category->name }}
                </a>
            @endif

            <!-- Price -->
            <div class="mb-6">
                <span class="text-4xl font-bold text-indigo-600">${{ number_format($product->price, 2) }}</span>
            </div>

            <!-- Stock Status -->
            <div class="mb-6">
                @if($product->stock > 0)
                    <div class="flex items-center text-green-600">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">In Stock ({{ $product->stock }} available)</span>
                    </div>
                @else
                    <div class="flex items-center text-red-600">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">Out of Stock</span>
                    </div>
                @endif
            </div>

            <!-- Product Description -->
            <div class="mb-6 border-t border-b border-gray-200 py-4">
                <h2 class="text-lg font-semibold text-gray-900 mb-2">Description</h2>
                <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
            </div>

            <!-- Add to Cart Form -->
            @if($product->stock > 0)
                <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <!-- Quantity Selector -->
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
                            Quantity
                        </label>
                        <div class="flex items-center space-x-4">
                            <input type="number" 
                                   id="quantity"
                                   name="quantity" 
                                   value="1" 
                                   min="1" 
                                   max="{{ $product->stock }}"
                                   class="w-24 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <span class="text-sm text-gray-500">Max: {{ $product->stock }}</span>
                        </div>
                        @error('quantity')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Add to Cart Button -->
                    <button type="submit" 
                            class="w-full bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150 ease-in-out flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Add to Cart
                    </button>
                </form>
            @else
                <div class="bg-gray-100 border border-gray-300 rounded-lg p-4 text-center">
                    <p class="text-gray-600 font-medium">This product is currently out of stock.</p>
                </div>
            @endif

            <!-- Additional Actions -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <a href="{{ route('products.index') }}" 
                   class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Products
                </a>
            </div>
        </div>
    </div>

    <!-- Additional Product Information (Optional) -->
    <div class="mt-12 bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Product Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-indigo-600 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
                <div>
                    <h3 class="font-semibold text-gray-900">Free Shipping</h3>
                    <p class="text-sm text-gray-600">On orders over $50</p>
                </div>
            </div>
            <div class="flex items-start">
                <svg class="w-6 h-6 text-indigo-600 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <div>
                    <h3 class="font-semibold text-gray-900">Secure Payment</h3>
                    <p class="text-sm text-gray-600">100% secure transactions</p>
                </div>
            </div>
            <div class="flex items-start">
                <svg class="w-6 h-6 text-indigo-600 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <div>
                    <h3 class="font-semibold text-gray-900">Easy Returns</h3>
                    <p class="text-sm text-gray-600">30-day return policy</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
