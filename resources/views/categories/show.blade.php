@extends("layouts.app")

@section("title", $category->name)

@section("content")
<div class="bg-white dark:bg-gray-900">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Page Header & Breadcrumbs -->
        <div class="mb-8">
            <nav class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                <a href="{{ route("home") }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route("categories.index") }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">Categories</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900 dark:text-white">{{ $category->name }}</span>
            </nav>
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight">{{ $category->name }}</h1>
            @if($category->description)
                <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">{{ $category->description }}</p>
            @endif
        </div>

        <!-- Products Grid -->
        @if($products->isEmpty())
            <div class="text-center py-16">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h2 class="mt-4 text-2xl font-semibold text-gray-900 dark:text-white">No Products in this Category Yet</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400">We are constantly adding new products. Please check back soon!</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($products as $product)
                    <div class="group relative bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md overflow-hidden transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">
                        <a href="{{ route("products.show", $product->slug) }}">
                            <!-- Product Image -->
                            <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden">
                                @if($product->image)
                                    <img src="{{ asset("storage/" . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover object-center">
                                @else
                                    <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Product Details -->
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate" title="{{ $product->name }}">{{ $product->name }}</h3>
                                <p class="mt-2 text-2xl font-bold text-indigo-600 dark:text-indigo-400">${{ number_format($product->price, 2) }}</p>
                            </div>
                        </a>

                        <!-- Add to Cart Button -->
                        <div class="p-4 pt-0">
                            <form action="{{ route("cart.add") }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150 ease-in-out flex items-center justify-center">
                                    <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        @endif

    </div>
</div>
@endsection