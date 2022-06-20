<x-app-layout>
    <div class="max-w-7xl mx-auto px-8">
        <div class="bg-white p-3 overflow-hidden shadow-sm sm:rounded-lg">
            <h4 class="text-2xl font-medium text-left text-gray-700 mb-2">История заказов</h4>

            <div class="relative overflow-x-auto sm:rounded-lg">

                @foreach($orders as $order)
                <div class="rounded-lg border border-gray-300 overflow-hidden mb-3">
                    <div class="border-b border-inherit px-4 py-2 flex justify-between">
                        <div class="flex gap-10">
                            <div class="flex flex-col">
                                <p>Заказ номер</p>
                                <p class="text-gray-600">{{ $order->id }}</p>
                            </div>
                            <div class="flex flex-col">
                                <p>Дата заказа</p>
                                <p>{{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                            </div>
                            <div class="flex flex-col">
                                <p>Итого</p>
                                <p>{{ $order->amount }} &#8381</p>
                            </div>
                        </div>
                        <a class="border border-inherit rounded p-3 text-center shadow" href="{{ route('orders.show', $order) }}">Проверить заказ</a>
                    </div>
                    <ul class="border-inherit">
                        @foreach($order->items as $index => $item)
                        <li class="p-4 border-b border-inherit flex flex-row gap-3 last:border-0">
                            <div class="border-inherit">
                                <img class="max-w-lg w-40 border-inherit " src="{{ $item->product->image}}" alt="{{ $item->name}}" />
                            </div>
                            <div class="flex-auto pl-4 flex flex-col">
                                <div class="flex justify-between mb-2">
                                    <h6 class="font-bold">{{ $item->name}}</h6>
                                    <p class="font-bold">{{ $item->product->price }} &#8381</p>
                                </div>
                                <!-- <p>{!! $item->product->description !!}</p> -->
                                <div>
                                    {!! stristr($item->product->description, '. ', true) !!}
                                </div>
                                <a class="mt-auto ml-auto text-indigo-600" href="{{ route('products.show', [$item->product_id]) }}">Перейти на страницу товара</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
            <br />
            <div>{{ $orders->render() }}</div>

        </div>
    </div>
</x-app-layout>