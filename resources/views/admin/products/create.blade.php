<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto px-8">
            <section class="container">
                <div class="flex p-2">
                    <a href="{{ route('admin.products.index') }}" class="px-4 py-2 duration-75 bg-green-700 hover:bg-green-500 text-slate-100 rounded-md">Все товары</a>
                </div>
                @include('includes.flash-message')
                <!-- Contact Form -->
                <div>
                    <form action="{{ route('admin.products.store') }}" class="flex flex-col" method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- Title -->
                        <x-label for="title"><span>Заголовок</span></x-label>
                        <x-input type="text" id="title" name="title" value="{{ old('title') }}" />
                        @error('title')
                        {{-- Поле $attributeValue есть/должно быть $validationRule --}}
                        <p style="color: red; margin-bottom:25px;">{{ $message }}</p>
                        @enderror
                        <!-- Price -->
                        <x-label class="mt-3" for="price"><span>Цена</span></x-label>
                        <x-input type="number" id="price" name="price" value="" />
                        @error('price')
                        {{-- Поле $attributeValue есть/должно быть $validationRule --}}
                        <p style="color: red; margin-bottom:25px;">{{ $message }}</p>
                        @enderror
                        <!-- Image -->
                        <x-label class="mt-3" for="image"><span>Изображение</span></x-label>
                        <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png .webp .tiff" />
                        @error('image')
                        {{-- Поле $attributeValue есть/должно быть $validationRule --}}
                        <p style="color: red; margin-bottom:25px;">{{ $message }}</p>
                        @enderror
                        <!-- Category -->
                        <x-label class="mt-3" for="categories">Выберите категорию</x-label>
                        <select name="category_id" id="categories" autocomplete="role-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        {{-- Поле $attributeValue есть/должно быть $validationRule --}}
                        <p style="color: red; margin-bottom:25px;">{{ $message }}</p>
                        @enderror
                        <!-- Body-->
                        <x-label class="mt-3" for="body"><span>Контент</span></x-label>
                        <textarea id="body" name="body">{{ old('body') }}</textarea>
                        @error('body')
                        {{-- Поле $attributeValue есть/должно быть $validationRule --}}
                        <p style="color: red; margin-bottom:25px;">{{ $message }}</p>
                        @enderror
                        <!-- Button -->
                        <div class="pt-5 w-auto">
                            <x-button type="submit" class="float-right">Создать</x-button>
                        </div>
                    </form>
                </div>

            </section>
            <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
            <script>
                CKEDITOR.replace('body');
            </script>
        </div>
    </div>
</x-admin-layout>