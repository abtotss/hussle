<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HussleTool')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        header {
            background: #333;
            color: white;
            padding: 15px;
        }
        nav a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
        }
        main {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<header>
    <h1>HussleTools</h1>
    <nav>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('about') }}">About</a>
        <a href="{{ route('products.index') }}">Products</a>
        <a href="{{ route('categories.index') }}">Categories</a>
        <a href="#">Contact</a>
    </nav>
</header>

<main>
    {{-- This is where each page’s unique content goes --}}
    @yield('content')
</main>

</body>
</html>
