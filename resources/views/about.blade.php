@extends('layouts.app')

@section('title', 'About HussleTools')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Hero Section -->
    <header class="text-center mb-16">
        <h1 class="text-5xl font-extrabold text-gray-900 dark:text-white mb-4">
            Our Mission: Powering Your Digital Hustle
        </h1>
        <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
            We connect ambitious entrepreneurs, developers, and creators with the premium digital tools they need, at prices that keep their projects profitable.
        </p>
    </header>

    <!-- Core Values Section -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-16">
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg text-center border border-gray-200 dark:border-gray-700">
            <div class="h-16 w-16 mx-auto bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mb-4">
                <svg class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.24a2 2 0 010 2.828l-6.828 6.828a2 2 0 01-2.828 0l-3.828-3.828a2 2 0 010-2.828l6.828-6.828a2 2 0 012.828 0l3.828 3.828z"></path></svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Authenticity</h3>
            <p class="text-gray-600 dark:text-gray-400">Every license and asset is verified and sourced ethically, guaranteeing legitimate and high-quality products.</p>
        </div>
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg text-center border border-gray-200 dark:border-gray-700">
            <div class="h-16 w-16 mx-auto bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mb-4">
                <svg class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Instant Access</h3>
            <p class="text-gray-600 dark:text-gray-400">Time is money. Our platform ensures immediate digital delivery so you can start using your tools right away.</p>
        </div>
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg text-center border border-gray-200 dark:border-gray-700">
            <div class="h-16 w-16 mx-auto bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mb-4">
                <svg class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3 .895 3 2s-1.343 2-3 2-3-.895-3-2 1.343-2 3-2zM21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Community Focus</h3>
            <p class="text-gray-600 dark:text-gray-400">We are built by hustlers, for hustlers. Our support and resources are tailored to the needs of digital creators.</p>
        </div>
    </section>

    <!-- History/Story Section -->
    <section class="mb-16">
        <div class="bg-gray-50 dark:bg-gray-800 p-10 rounded-xl shadow-inner border border-gray-200 dark:border-gray-700">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Our Story</h2>
            <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                HussleTools was founded on a simple principle: **great tools shouldn't break the bank.** We noticed a gap in the market where high-quality software licenses and digital assets were often inaccessible to independent creators and small businesses due to prohibitive costs. We built a platform that ethically sources and resells these licenses, creating a win-win situation for both the original developers and the hustlers who need them. Since our launch, we've helped thousands of users save money and accelerate their projects, proving that smart sourcing is the key to digital success.
            </p>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="text-center">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Ready to Find Your Next Tool?</h2>
        <a href="{{ route('products.index') }}" class="btn-blue text-lg">
            Browse the Catalog
        </a>
    </section>
</div>
@endsection