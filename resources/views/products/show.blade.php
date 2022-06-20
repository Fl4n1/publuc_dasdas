<x-app-layout>
    <section class="container max-w-7xl bg-white overflow-hidden flex-auto p-4 rounded-lg border">
        <div class="md:flex md:items-center">
            <div class="w-full h-auto md:w-1/2 ">
                <img class="h-full w-auto rounded-md object-contain max-w-lg mx-auto" src="{{ url($product->image) }}" alt="{{$product->name}}">
            </div>
            <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
                <h3 class="text-2xl font-medium text-gray-700 uppercase">{{ $product->name }}</h3>
                <hr class="my-3">
                <div class="mt-2">
                    <span class="text-gray-900 text-xl"> Стоимость {{ $product->price }} &#8381;</span>
                </div>
                <hr class="my-3">
                <div class="descr">
                    {!! $product->description !!}
                </div>
                

                <div class="flex items-center mt-6">
                    <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" value="{{ $product->id }}" name="id">
                        <input type="hidden" value="{{ $product->name }}" name="name">
                        <input type="hidden" value="{{ $product->price }}" name="price">
                        <input type="hidden" value="{{ $product->image }}" name="image">
                        <input type="hidden" value="1" name="quantity">
                        <button class="px-10 py-3 bg-sky-600 rounded-full text-white text-sm font-medium rounded hover:bg-sky-500 focus:outline-none
            focus:bg-sky-500">
                            Добавить в корзину
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="my-3">
            <p class="p-4 text-2xl font-medium text-gray-700">Похожие на</p>
            <div class="related">
                <div class="swiper-wrapper">
                    @foreach ($relatedProducts as $relatedPost )
                    <div class="swiper-slide border rounded-md  shadow-md overflow-hidden">
                        <a class="w-full max-w-sm mx-auto" href="{{ route('products.show', ['product' => $relatedPost]) }}">
                            <div class="flex z-50 items-end justify-end h-96 w-full bg-no-repeat border-b bg-contain bg-center" style="background-image: url('{{asset($relatedPost->image)}}');">
                            </div>
                            <div class="px-5 py-3 ">
                                <h3 class="text-gray-700 ">{{$relatedPost->name}}</h3>
                                <span class="text-gray-500 mt-4">{{$relatedPost->price}}</span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="mt-6 bg-white relative border flex flex-col overflow-hidden rounded-lg px-4">
            <h2 class="pt-3 pb-2 text-gray-800 text-lg">Отзывы</h2>
            <form method="post" action="{{ route('review.add') }}" class="w-full">
                <div class="flex flex-wrap -mx-3 mb-6">
                    @csrf
                    <div class="w-full px-3 mb-2 mt-2">
                        <textarea name="review" required class="bg-gray-100 rounded border border-gray-300 leading-normal resize-none w-full h-20 py-2
                         px-3 font-medium
                         placeholder-gray-700 focus:outline-none focus:bg-white" placeholder="Написать отзыв...."></textarea>
                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                    </div>
                    <div class="w-full flex items-start justify-end md:w-full px-3">
                        <input type="submit" class="px-4 py-2 bg-sky-600 text-white text-md font-medium rounded hover:bg-sky-500 focus:outline-none 
                        focus:bg-sky-500" value="Отправить" />
                    </div>
                </div>
            </form>
            <div class="pt-3 mb-12 border-t border-gray-300">
                @include('includes.review', ['reviews' => $product->reviews, 'product_id' => $product->id])
            </div>
        </div>
    </section>
</x-app-layout>