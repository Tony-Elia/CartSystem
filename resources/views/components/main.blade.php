<!-- resources/views/components/main.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-white text-black dark:bg-[#212121] dark:text-white pt-[60px]">

<div class="min-h-screen">
    <!-- Navigation -->
    <nav class="bg-[#333333] p-4 px-6 fixed top-0 left-0 w-full h-[60px] flex flex-row items-center justify-between">
        <a href="/" class="text-white font-bold text-2xl">{{ config('app.name', 'Laravel') }}</a>
        <div class="flex flex-row items-center">
            @auth
                <a href="{{ route('profile.edit') }}" class="text-white">Profile</a>
                <a href="{{ route('order.index') }}" class="text-white mx-3">My Orders</a>
            @else
                <a href="{{ route('login') }}" class="text-white">Login</a>
                <a href="{{ route('register') }}" class="text-white mx-3">Register</a>
            @endauth
            <a href="{{ route('cart.index') }}" class="mx-5 relative">
                <img class="h-[35px]" src="{{ asset('storage/cart.png') }}" alt="cart">
                <span id="cart-counter" class="cart-badge">{{ session('total_cart_items', 0) }}</span>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>
</div>

</body>
</html>
