<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto px-8">
            <section class="container">
                <div class="flex p-2">
                    <a href="{{ route('admin.news.index') }}" class="px-4 py-2 duration-75 text-white hover:text-black bg-green-700 hover:bg-green-500 
                rounded-md">Посты</a>
                </div>
                @include('includes.flash-message')
                <!-- Contact Form -->
                <div class="contact-form">
                    <form action="{{route('admin.posts.update', $post)}}" class="flex flex-col" method="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <!-- Title -->
                        <x-label for="title"><span>Заголовок</span></x-label>
                        <x-input type="text" id="title" name="title" value="{{ $post->title }}" />
                        @error('title')
                        {{-- The $attributeValue field is/must be $validationRule --}}
                        <p style="color: red; margin-bottom:25px;">{{ $message }}</p>
                        @enderror
                        <!-- Image -->
                        <x-label for="img_prev" class="pt-5"><span>Превью изображение</span></x-label>
                        <input type="file" id="img_prev" name="img_prev" accept=".jpg, .jpeg, .png .webp .tiff" value="{{$post->img_prev}}" />
                        <x-label for="image" class="pt-5"><span>Изображение</span></x-label>
                        <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png .webp .tiff" value="{{$post->image}}" />
                        @error('image')
                        {{-- The $attributeValue field is/must be $validationRule --}}
                        <p style="color: red; margin-bottom:25px;">{{ $message }}</p>
                        @enderror
                        <!-- Body-->
                        <x-label for="body" class="pt-5"><span>Контент</span></x-label>
                        <textarea id="body" name="body">{{ $post->body }}</textarea>
                        @error('body')
                        {{-- The $attributeValue field is/must be $validationRule --}}
                        <p style="color: red; margin-bottom:25px;">{{ $message }}</p>
                        @enderror
                        <!-- Button -->
                        <div class="pt-5 w-auto">
                            <x-button type="submit" class="float-right">Создать</x-button>
                        </div>
                    </form>
                </div>
            </section>
        </div>

    </div>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('body');
    </script>
</x-admin-layout>