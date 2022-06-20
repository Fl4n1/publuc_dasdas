<nav x-data="{ open: false }" class="bg-white z-50 sticky border-b shadow border-gray-200 left-0 top-0">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto px-4 md:px-4 lg:px-8">
        <div class="flex justify-between gap-5">
            <div class="flex xl:gap-4 md:gap-2 ">
                <!-- Logo -->
                <div class="shrink-0 flex items-center py-3">
                    <a href="/">
                        <img src="{{ asset('Blue.png') }}" alt="Goodshop" style="width: 50px; "/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:-my-px md:flex lg:gap-8 md:gap-4 min-w-max">
                    <x-nav-link :href="route('index')" class="ml-0" :active="request()->routeIs('index')">
                        Главная
                    </x-nav-link>
                    <x-nav-link :href="route('blog.index')" class="ml-0" :active="request()->routeIs('blog.index')">
                        Новости
                    </x-nav-link>
                    <x-nav-link :href="route('products.list')" class="ml-0" :active="request()->routeIs('products.list')">
                        Каталог
                    </x-nav-link>
                </div>

            </div>
            
            <form action="{{ route('products.list') }}" class="flex my-auto mx-auto  hidden md:flex">
                <div class="relative  max-w-max">
                    <input name="search" type="text" id="search" class="block xl:w-96 rounded-full lg:w-80 md:w-64 p-3 pl-10 text-sm text-gray-900 bg-gray-50 rounded-lg border
                     border-gray-300 focus:ring-gray-500 focus:border-gray-500" placeholder="Поиск по товарам..." required>
                    <button type="submit" class="text-white flex rounded-full absolute right-6 px-3 py-1.5 bottom-1.5 bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm">Искать
                        <div class="px-1">
                            <svg class=" w-5 h-5  text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            
                        </div>
                    </button>
                </div>
            </form>
            <!-- Settings Dropdown -->
            <div class="hidden md:flex md:items-center min-w-max">
                <div class="hidden md:flex md:flex-1 md:items-center md:justify-end md:space-x-6">
                    @if (Auth::User())
                    <x-dropdown class="float-right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 
                        focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 
                                    0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            @role('admin')
                            <x-dropdown-link :href="route('admin.index')">
                                Управление
                            </x-dropdown-link>
                            @endrole
                            <x-dropdown-link :href="route('orders.index')">
                                {{ __('История заказов') }}
                            </x-dropdown-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Выйти') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                    @else
                    <div class="ml-auto flex items-center">
                        <div class="hidden md:flex md:flex-1 md:items-center md:justify-end md:space-x-3 lg:space-x-6">
                            @if (Route::has('login'))
                            <a href="{{route('login')}}" class="text-sm font-medium text-gray-700 hover:text-gray-800">
                                Войти
                            </a>
                            @endif
                            <span class="h-6 w-px bg-gray-200" aria-hidden="true"></span>
                            @if (Route::has('register'))
                            <a href="{{route('register')}}" class="text-sm font-medium text-gray-700 hover:text-gray-800">
                                Зарегистрироваться
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
                <div class="ml-2 my-auto flow-root lg:ml-6">
                    <a href="{{ route('cart.list') }}" class="group -m-2 p-2 flex items-center">                   
                        <svg class="flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">{{ Cart::getTotalQuantity()}}</span>
                    </a>
                </div>
            </div>
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center md:hidden">
                <button @click="open = ! open" class="inline-flex border border-gray-300 items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('index')" :active="request()->routeIs('index')">
                {{ __('Главная') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('blog.index')" :active="request()->routeIs('blog.index')">
                {{ __('Новости') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.list')" :active="request()->routeIs('products.list')">
                {{ __('Каталог') }}
            </x-responsive-nav-link>

        </div>
        <form action="{{ route('products.list') }}" class="my-3 mx-4">
            <label for="search" class="text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input name="search" type="text" id="search" class="block w-96 p-3 pl-10 text-sm text-gray-900 bg-gray-50 rounded-lg border
                     border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Поиск по товарам..." required>
                <button type="submit" class="text-white absolute right-1.5 px-3 py-1.5 bottom-1.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm">Искать</button>
            </div>
        </form>
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @if (Auth::User())
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                @role('admin')
                <x-responsive-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">
                    {{ __('Управление') }}
                </x-responsive-nav-link>
                @endrole
                <x-responsive-nav-link :href="route('orders.index')">
                    {{ __('История заказов') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Выйти') }}
                    </x-responsive-nav-link>
                </form>
            </div>
            @else
            <div class="mt-3 space-y-1">
                @if (Route::has('login'))
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Войти') }}
                    </x-responsive-nav-link>
                </form>

                <span class="h-6 w-px bg-gray-200" aria-hidden="true"></span>
                @if (Route::has('register'))
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Зарегистрироваться') }}
                    </x-responsive-nav-link>
                </form>
                @endif
                @endif
            </div>

            @endif
        </div>
    </div>
</nav>