@extends("layouts.app")

@section("title", "Categories")

@section("content")
<div class="bg-white dark:bg-gray-900">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Page Header -->
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight">Product Categories</h1>
            <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Browse our products by category</p>
        </div>

        <!-- Categories Grid -->
        @if($categories->isEmpty())
            <div class="text-center py-16">
                <svg class="mx-auto h-16 w-16 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h2 class="mt-4 text-2xl font-semibold text-gray-900 dark:text-white">No Categories Found</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400">We are working on organizing our products. Please check back soon!</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route("categories.show", $category->slug) }}" class="group block bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors duration-300">{{ $category->name }}</h3>
                                <span class="bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-300 text-sm font-semibold px-3 py-1 rounded-full">{{ $category->products_count }}</span>
                            </div>
                            @if($category->description)
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($category->description, 60) }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection