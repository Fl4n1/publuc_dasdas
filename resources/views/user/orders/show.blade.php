<x-app-layout>
    <div class="container">
        <div class="bg-white p-3 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="card-header">
                <h4 class="text-2xl font-medium text-left text-gray-700 mb-2">О заказе</h4>
            </div>
            <div class="card-body">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead>
                        <tr>
                            <th>Название товара</th>
                            <th class="text-center">Цена за шт.</th>
                            <th class="text-center">Количество</th>
                            <th class="text-right item-amount">Итого</th>
                        </tr>
                    </thead>
                    @foreach($order->items as $index => $item)
                    <tr>
                        <td class="product-info">
                            <div class="preview">
                                <a target="_blank" href="{{ route('products.show', [$item->product_id]) }}">
                                    <img class="max-w-lg w-40 border-inherit " src="{{ $item->product->image}}" alt="{{ $item->name}}" />
                                </a>
                            </div>
                            <div>
                                <span class="product-title">
                                    <a target="_blank" href="{{ route('products.show', [$item->product_id]) }}">{{ $item->product->name }}</a>
                                </span>
                            </div>
                        </td>
                        <td class="sku-price text-center vertical-middle">{{ $item->price }} &#8381</td>
                        <td class="sku-amount text-center vertical-middle">{{ $item->quantity }}</td>
                        <td class="item-amount text-right vertical-middle">{{ number_format($item->price * $item->amount, 2, '.', '') }} &#8381</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                </table>
                <div class="order-bottom">
                    <div class="my-4 mt-6 -mx-2 flex">
                        <div class="px-2 w-full">
                            <div class="p-4 bg-gray-100 rounded border">
                                <h1 class="ml-2 font-bold uppercase">Детали заказа</h1>
                            </div>
                            <div class="p-4 flex justify-between">
                                <h1 class="ml-2 font-bold uppercase text-left">Адрес доставки</h1>
                                <p>{{$order->address}}</p>
                            </div>
                            <div class="p-4 flex justify-between">
                                <h1 class="ml-2 font-bold uppercase text-left">Примечания к заказу</h1>
                                <p>{{ $order->remark ?: '-' }}</p>
                            </div>
                            <div class="p-4 flex justify-between">
                                <h1 class="ml-2 font-bold uppercase text-left">Номер заказа</h1>
                                <p>{{ $order->id }}</p>
                            </div>

                            <div class="p-4">
                                <div class="flex justify-between pt-4 border-b">
                                    <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                        Всего
                                    </div>
                                    <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                                        {{ $order->amount }} &#8381;
                                    </div>
                                </div>
                                <div class="flex justify-between pt-4 border-b">
                                    <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                        Статус
                                    </div>
                                    <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                                        @if($order->paid_at)
                                        @if($order->refund_status === \App\Models\Order::REFUND_STATUS_PENDING)
                                        Оплачено
                                        @else
                                        {{ \App\Models\Order::$refundStatusMap[$order->refund_status] }}
                                        @endif
                                        @elseif($order->closed)
                                        Закрыт
                                        @else
                                        Ожидает оплаты
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>