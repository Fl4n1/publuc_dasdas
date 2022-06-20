<x-app-layout>
    <div class="container max-w-7xl">    
        <div class="bg-white p-6 overflow-hidden sm:rounded-lg">
            <div class="pb-4 ">
            <!--  -->
            <div class="slider-content1 border">
                <div class="slider-wrapper1">
                    <div class="slider-container1">
                        <div class="slide active" data-order="1">
                            <div class="slide-content txt">
                                <div class="txt-wrapper pt-8 p-4 pb-2 flex flex-col flex-auto ">
                                    <span class="copy"></span>
                                    <h2><span>Новый</span><span style="padding-left: 35px;">Сезон!</span> </h2>
                                    <span class="text-xl uppercase mb-4" style="font-size: 24px; margin-bottom: 10px;">Успей купить выгодно!</span>
                                    <p class="excerpt text-2xl uppercase" style="padding-top: 15px;"> Выбери образ от VINTAGE и погрузись в атмосферу большого города</p>
                                    <a href="{{ route('products.list') }}" class="px-4 py-2 bg-sky-600 text-g text-sm font-bold float-right ">Подробнее</a>
                                </div>
                            </div>
                            <div class="slide-content img">
                                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/42764/slider1.jpg" class="rew" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->
                <h1 class="text-2xl p-4 font-medium text-left text-gray-700 mb-2">Последние новости</h1>               
                 <div class="swiper_news">
                    <div class="swiper-wrapper">
                        @foreach($posts as $post)
                        <div class="swiper-slide ">
                            <div class="hover:shadow  shadow-none bg-white overflow-hidden  ">
                                <a href="{{ route('blog.show', $post) }}" class="flex flex-col hover:shadow shadow-none">
                                    <img src="{{ asset($post->img_prev) }}" alt="{{$post->title}}" class="border-b h-56 border-gray-300" />
                                    <div  class="p-4 pb-2 flex flex-col flex-auto">
                                       <h4 style="padding-bottom:20px ;" class="text-md font-medium"> 
                                            {{ $post->title }}
                                        </h4> 
                                        <button class="px-4 py-2 bg-sky-600 text-white text-sm font-bold float-right ">Подробнее</button>
                                        <p class="p-4 grid text-sm mt-auto border-t text-gray-600 justify-end text-right">
                                            {{ $post->created_at->diffForHumans() }}
                                            <span class="card__by ">Автор <span class="card__author">Горбунов С.</span> </span>
                                        </p>                                   
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="flex justify-end pt-1">
                    <a href="{{ route('blog.index') }}" class="p-4 text-sm text-gray-600">Посмотреть всё</a>
                </div> 
            </div>
            
            <div class="pb-3">
                <h1 class="text-2xl p-4 font-medium text-left text-gray-700 mb-2">Последние продукты</h1>
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach($products as $product)
                        <div class="swiper-slide flex flex-col bg-white overflow-hidden rounded-md border hover:shadow">
                            <a href="{{ route('products.show', ['product' => $product->id]) }}" class="flex justify-center border-b">
                                <img src="{{ url($product->image) }}" alt="" class="w-auto h-70">
                            </a>
                            <div class="px-4 py-3 flex flex-col flex-auto">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex text-sm text-gray-400 pb-2 items-center">
                                        {{ $product->category->name }}
                                    </div>
                                </td>
                                <a class="mb-2 border-b" href="{{ route('products.show', ['product' => $product->id]) }}">
                                    <h3 class="text-gray-900 font-sm pb-4">{{ $product->name }}</h3>
                                </a>
                                
                                <form action="{{ route('cart.store') }}" method="POST" class="mt-auto" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="id">
                                    <input type="hidden" value="{{ $product->name }}" name="name">
                                    <input type="hidden" value="{{ $product->price }}" name="price">
                                    <input type="hidden" value="{{ $product->image }}" name="image">
                                    <input type="hidden" value="1" name="quantity">
                                    <div class="flex item-center justify-between">
                                        <h1 class=" mt-a font-medium text-md whitespace-nowrap float-right content-center">{{ $product->price }} &#8381;</h1>
                                        <button class="px-4 py-2 bg-sky-600 text-white text-xs font-bold float-right uppercase rounded-full rounded">Подробнее</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="flex justify-end pt-1">
                    <a href="{{ route('products.list') }}" class="p-4 text-sm text-gray-600">Посмотреть всё</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>