@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-gray-100 dark:bg-gray-900 pt-16">
    <!-- Hero Section -->
    <header class="bg-white dark:bg-gray-800 shadow-lg py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-extrabold text-gray-900 dark:text-white sm:text-6xl lg:text-7xl leading-tight">
                Your <span class="text-blue-600">Digital Hustle</span> Starts Here
            </h1>
            <p class="mt-6 text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                Access premium software, templates, and digital tools at unbeatable prices. Power your projects, scale your business, and keep your edge.
            </p>
            <div class="mt-10 flex justify-center space-x-4">
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10 transition duration-150 ease-in-out shadow-lg">
                    Explore Tools
                </a>
                <a href="{{ route('categories.index') }}" class="inline-flex items-center justify-center px-8 py-3 border border-2 border-blue-600 text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 md:py-4 md:text-lg md:px-10 transition duration-150 ease-in-out shadow-md">
                    Browse Categories
                </a>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Why Hussle Tools?</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    The Smart Way to Acquire Software
                </p>
            </div>

            <div class="mt-10">
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Instant Access</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            No waiting. Purchase, download, and start using your new digital assets immediately.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3 .895 3 2s-1.343 2-3 2-3-.895-3-2 1.343-2 3-2zM21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Verified Reseller</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            All software and licenses are 100% legitimate and verified, ensuring you get authentic products.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.24a2 2 0 010 2.828l-6.828 6.828a2 2 0 01-2.828 0l-3.828-3.828a2 2 0 010-2.828l6.828-6.828a2 2 0 012.828 0l3.828 3.828z"></path>
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Lifetime Updates</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Many of our products come with guaranteed access to future updates and support from the original developer.
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </section>

    <!-- Call to Action Footer -->
    <footer class="bg-gray-800 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                Ready to Level Up Your Toolkit?
            </h2>
            <p class="mt-4 text-lg text-gray-300">
                Join thousands of hustlers who trust us for their digital needs.
            </p>
            <div class="mt-8 flex justify-center">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-gray-900 bg-yellow-400 hover:bg-yellow-500 md:py-4 md:text-lg md:px-10 transition duration-150 ease-in-out shadow-lg">
                    Create Free Account
                </a>
            </div>
        </div>
    </footer>
</div>
@endsection