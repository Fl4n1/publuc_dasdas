<x-app-layout>
    <div class="container bg-white max-w-7xl p-6 shadow-lg flex-auto">
        <h1 class="text-2xl font-extrabold">Корзина</h1>
        <div class="flex justify-center my-6">
            <div class="flex flex-col w-full p-4 border text-gray-800 bg-white md:w-4/5 lg:w-4/5  flex-grow">
                <div class="flex-1">
                    @if (isset($cartItems))
                    <table class="w-full text-sm lg:text-base flex-grow" cellspacing="0">
                        <thead>
                            <tr class="h-12 uppercase">
                                <th class="hidden md:table-cell"></th>
                                <th class="text-left">Наименование</th>
                                <th class="text-left pl-5 lg:pl-0">
                                    <span class="md:hidden" title="Quantity">Кол-во</span>
                                    <span class="hidden md:inline">Количество</span>
                                </th>
                                <th class="hidden text-right lg:table-cell">Цена за штуку</th>
                                <th class="text-right table-cell">Итого</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($cartItems as $item)
                            <tr>
                                <td class="hidden pb-4 md:table-cell">
                                    <a href="#">
                                        <img src="{{ $item->attributes->image }}" class="w-48 rounded" alt="Thumbnail">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('products.show', ['product' => $item->id]) }}">
                                        <p class="mb-2 md:ml-4">{{ $item->name }}</p>
                                    </a>
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $item->id }}" name="id">
                                        <button type="submit" class="text-red-700 md:ml-4">
                                            <small>(Удалить)</small>
                                        </button>
                                    </form>
                                </td>
                                <td class=" table-cell origin-center">
                                    <form action="{{ route('cart.update') }}" method="post" class="w-24 ">
                                        @csrf
                                        <div class="relative">
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" class="block p-3 w-24 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-sky-500 focus:border-ksy-500" placeholder="Поиск по сайту" required>
                                            <button type="submit" class="text-white absolute right-1.5 px-3 py-1.5 bottom-1.5 bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm"> <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fillRule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clipRule="evenodd" />
                        </svg></button>
                                        </div>
                                    </form>
                                </td>
                                <td class="hidden text-right lg:table-cell">
                                    <span class="text-sm font-medium lg:text-base">
                                        {{ $item->price }} &#8381;
                                    </span>
                                </td>
                                <td class="text-right table-cell">
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $item->id }}" name="id">
                                        {{ $item->price * $item->quantity}} &#8381;
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr class="pb-6 mt-6">
                    <div class="my-4 mt-6 -mx-2 flex">
                        <div class="px-2 w-full">
                           
                            <div class="p-4 ">
                                <div class="flex justify-between  border-t border-b">
                                    <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                        Всего
                                    </div>
                                    <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                                        {{ Cart::getTotal() }} &#8381;
                                    </div>
                                </div>
                                <form action="{{route('cart.checkout')}}" method="post">
                                    @csrf
                                    <button class="flex rounded-lg  px-10 py-3 mt-6 font-medium text-white bg-sky-500 shadow item-center hover:bg-sky-700 focus:shadow-outline focus:outline-none float-right">
                                        <!-- <svg aria-hidden="true" data-prefix="far" data-icon="credit-card" class="w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                            <path fill="currentColor" d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z" />
                                        </svg> -->
                                        <span class="ml-2 mt-5px">Перейти к оформлению</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    @else
                    <h4 class="text-2xl font-medium text-slate-700">Корзина пуста</h4>
                    <p class="text-lg">Воспользуйтесь поиском, чтобы найти всё что нужно.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>