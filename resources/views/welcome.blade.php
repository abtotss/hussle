@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-500">
    <!-- Header/Navigation (Assuming it's in layouts.app or navigation) -->

    <!-- Theme Toggle (Placeholder - requires JS/CSS setup) -->
    <div class="absolute top-4 right-4 z-50">
        <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 00-.707-.293h-1.414a1 1 0 000 2h1.414a1 1 0 00.707-.293zM3 10a1 1 0 011-1h1a1 1 0 110 2H4a1 1 0 01-1-1zm14 0a1 1 0 011-1h1a1 1 0 110 2h-1a1 1 0 01-1-1zm-4.586 4.586a1 1 0 001.414 0l.707-.707a1 1 0 00-1.414-1.414l-.707.707a1 1 0 000 1.414zM10 15a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM4.95 14.536a1 1 0 10-1.414 1.414l.707.707a1 1 0 001.414-1.414l-.707-.707z"></path></svg>
        </button>
    </div>

    <!-- Hero Section - Modern & Clean -->
    <header class="pt-20 pb-32 bg-gray-50 dark:bg-gray-800 transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-6xl font-extrabold text-gray-900 dark:text-white sm:text-7xl lg:text-8xl leading-tight tracking-tight">
                <span class="block">Welcome to HussleTools</span>
                <span class="block text-blue-600 dark:text-blue-400">Empowering Your Hustle</span>
            </h1>
            <p class="mt-6 text-xl text-gray-600 dark:text-gray-300 max-w-4xl mx-auto">
                The curated marketplace for software licenses, templates, and digital assets. Get instant access to the tools you need to build, grow, and succeed.
            </p>
            <div class="mt-12 flex justify-center space-x-4">
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-10 py-4 border border-transparent text-lg font-medium rounded-full text-white bg-blue-600 hover:bg-blue-700 shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
                    Explore 100+ Tools
                </a>
                <a href="route('login')" class="inline-flex items-center justify-center px-10 py-4 border-2 border-blue-600 dark:border-blue-400 text-lg font-medium rounded-full text-blue-600 dark:text-blue-400 bg-transparent hover:bg-blue-50 dark:hover:bg-gray-700 transition duration-300 ease-in-out">
                    How It Works
                </a>
            </div>
        </div>
    </header>

    <!-- Featured Products Section -->
    <section class="py-20 bg-white dark:bg-gray-900 transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white text-center mb-12">
                Featured Digital Tools
            </h2>
            
            <!-- Placeholder for Featured Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @for ($i = 1; $i <= 3; $i++)
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl shadow-lg p-6 text-center border border-gray-200 dark:border-gray-700">
                        <div class="h-16 w-16 mx-auto bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mb-4">
                            <svg class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-1.25-3M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Tool Name {{ $i }}</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">A brief description of this top-selling digital product and its key benefit.</p>
                        <p class="mt-4 text-2xl font-bold text-blue-600 dark:text-blue-400">$49.99</p>
                        <a href="{{ route('products.index') }}" class="mt-4 inline-block text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 transition">View Details →</a>
                    </div>
                @endfor
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('products.index') }}" class="text-lg font-medium text-gray-600 dark:text-gray-400 hover:text-blue-600 transition">
                    See All Tools →
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-gray-50 dark:bg-gray-800 transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white text-center mb-12">
                Trusted by Digital Creators
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                    <p class="text-lg italic text-gray-700 dark:text-gray-300">"Hussle Tools provided the exact software license I needed instantly. The price was unbeatable and the process was seamless. Highly recommend!"</p>
                    <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <p class="font-semibold text-gray-900 dark:text-white">Alex R.</p>
                        <p class="text-sm text-blue-600 dark:text-blue-400">Freelance Developer</p>
                    </div>
                </div>
                <!-- Testimonial 2 -->
                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                    <p class="text-lg italic text-gray-700 dark:text-gray-300">"The best place to find discounted digital assets. It saved my startup hundreds of dollars on essential tools. A true game-changer for hustlers."</p>
                    <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <p class="font-semibold text-gray-900 dark:text-white">Maria K.</p>
                        <p class="text-sm text-blue-600 dark:text-blue-400">Marketing Agency Owner</p>
                    </div>
                </div>
                <!-- Testimonial 3 -->
                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                    <p class="text-lg italic text-gray-700 dark:text-gray-300">"Fantastic selection and the instant download feature is perfect. I got my template and was working on my project within minutes."</p>
                    <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <p class="font-semibold text-gray-900 dark:text-white">Ben S.</p>
                        <p class="text-sm text-blue-600 dark:text-blue-400">E-commerce Entrepreneur</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Security and Support Callouts -->
    <section class="py-20 bg-white dark:bg-gray-900 transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Security -->
                <div class="p-8 bg-gray-50 dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-4">
                        <div class="h-12 w-12 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                            <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.24a2 2 0 010 2.828l-6.828 6.828a2 2 0 01-2.828 0l-3.828-3.828a2 2 0 010-2.828l6.828-6.828a2 2 0 012.828 0l3.828 3.828z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Secure & Verified Purchases</h3>
                    </div>
                    <p class="mt-4 text-gray-600 dark:text-gray-400">
                        Every license and digital product is verified for authenticity. Your payment information is protected with industry-leading encryption. Shop with confidence knowing you're getting legitimate tools.
                    </p>
                </div>
                
                <!-- Support -->
                <div class="p-8 bg-gray-50 dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center space-x-4">
                        <div class="h-12 w-12 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center">
                            <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 0A5.002 5.002 0 0112 10.5v1.5m0 0v1.5m0 0A5.002 5.002 0 0115.899 18.364m-3.536-3.536l3.536 3.536m-3.536-3.536l-3.536 3.536m3.536-3.536l-3.536-3.536m7.072 7.072l-3.536-3.536m0 0l-3.536 3.536m3.536-3.536l3.536-3.536m-7.072 7.072l3.536-3.536M12 21a9 9 0 100-18 9 9 0 000 18z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Dedicated Customer Support</h3>
                    </div>
                    <p class="mt-4 text-gray-600 dark:text-gray-400">
                        Our support team is here to help with any questions regarding your purchase, download, or license activation. We ensure a smooth experience from click to completion.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Footer -->
    <footer class="py-16 bg-gray-800 dark:bg-gray-900 transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-extrabold text-white sm:text-5xl">
                Ready to Start Hustling?
            </h2>
            <p class="mt-4 text-xl text-gray-300">
                Join our community and get instant access to powerful digital tools today.
            </p>
            <div class="mt-8 flex justify-center">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-10 py-4 border border-transparent text-lg font-medium rounded-full text-gray-900 bg-yellow-400 hover:bg-yellow-500 shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
                    Create Free Account
                </a>
            </div>
        </div>
    </footer>
</div>

<script>
    // Simple Dark/Light Mode Toggle Logic
    const themeToggleBtn = document.getElementById('theme-toggle');
    const htmlElement = document.documentElement;

    // Check for saved theme preference or system preference
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        htmlElement.classList.add('dark');
        document.getElementById('theme-toggle-light-icon').classList.remove('hidden');
    } else {
        htmlElement.classList.remove('dark');
        document.getElementById('theme-toggle-dark-icon').classList.remove('hidden');
    }

    themeToggleBtn.addEventListener('click', function() {
        // Toggle icons
        document.getElementById('theme-toggle-dark-icon').classList.toggle('hidden');
        document.getElementById('theme-toggle-light-icon').classList.toggle('hidden');

        // Toggle theme
        if (htmlElement.classList.contains('dark')) {
            htmlElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            htmlElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    });
</script>
@endsection