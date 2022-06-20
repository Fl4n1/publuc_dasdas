<footer class="bg-white p-6 sm:border-0 border-t">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/1app.css') }}">
    <link rel="stylesheet" href="{{ asset('js/1app.js') }}">


    <div class="flex container justify-center ">
        <div class="mb-6 md:mb-0 mr-6">
            <a href="/" class="flex items-center">
                <img src="{{ asset('Blue.png') }}" class="mr-3 h-12" alt="VINTAGE лого" />
                <span class="self-center text-2xl font-medium whitespace-nowrap mr-6">VINTAGE</span>
            </a>
        </div>
        <div>
            <h2 class="mb-6 text-sm font-semibold  uppercase">Ссылки</h2>
            <div class="grid grid-cols-1 gap-6">
                <ul class="text-gray-600 ">
                    <li class="mb-3">
                        <a href="/" class="hover:underline">Главная</a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('blog.index') }}" class="hover:underline">Новости</a>
                    </li>
                    <li>
                        <a href="{{ route('products.list') }}" class="hover:underline">Каталог</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
    <div class="sm:flex sm:items-center sm:justify-center">
        <span class="text-sm text-gray-600 sm:text-center">© 2022 <span>VINTAGE™</span>
        </span>
    </div>
</footer>