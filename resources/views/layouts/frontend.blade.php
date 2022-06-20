<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>

<body class=" bg-gray-100">
    <div class="">
        <header class="sticky shadow border-b bg-white">
            <div class="container mx-auto">
                <nav class="p-6 flex justify-between items-center">
                    <div class="flex items-center flex-shrink-0 text-white mr-6">
                        <span class="font-semibold text-black text-xl tracking-tight"><img src="{{ asset('logo.svg') }}" alt="Goodshop" /></span>
                    </div>
                    <div class="flex gap-4 flex-col sm:flex-row">
                        <a class="mt-3 hover:underline sm:mx-3 sm:mt-0" href="/">Home</a>
                        <a class="mt-3 hover:underline sm:mx-3 sm:mt-0" href="{{ route('products.list')}}">Shop</a>
                        <a href="{{ route('cart.list') }}" class="flex items-center">
                            <svg class="w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            {{ Cart::getTotalQuantity()}}
                        </a>
                        @if (Route::has('login'))
                        @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Личный кабинет</a>
                        @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Войти</a>

                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Зарегистрироваться</a>
                        @endif
                        @endauth
                        @endif
                    </div>

                </nav>
            </div>
        </header>
        <main class="my-8">
            @yield('content')
        </main>
    </div>
</body>

</html>