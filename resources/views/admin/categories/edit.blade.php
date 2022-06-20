<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex p-2">
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 text-white hover:text-black bg-green-700 hover:bg-green-500 
                rounded-md">Категории</a>
            </div>
            <div class="flex flex-col p-2 bg-slate-100">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                        @csrf
                        @method('PUT')
                        <div class="sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Название</label>
                            <div class="mt-1">
                                <input type="text" id="name" name="name" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" value="{{ $category->name }}" />
                            </div>
                            @error('name')
                            <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Обновить</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>