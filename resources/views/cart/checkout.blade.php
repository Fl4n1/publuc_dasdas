<x-app-layout>
    <div class="container w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <h1 class="mb-4 text-center text-lg">Оформить заказ</h1>
        <div class="flex justify-center bg-white p-3 pb-5">
                <form method="POST" action="{{ route('cart.saveorder') }}">
                    @csrf
                    <div class="sm:col-span-6">
                        <label for="name" class="block text-sm font-medium text-gray-700">Имя, Фамилия</label>
                        <div class="mt-1">
                            <input type="text" id="name" name="name" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>
                        @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror

                        <label for="email" class="block text-sm font-medium text-gray-700">Адрес почты</label>
                        <div class="mt-1">
                            <input type="email" id="email" name="email" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>
                        @error('email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror

                        <label for="phone" class="block text-sm font-medium text-gray-700">Номер телефона</label>
                        <div class="mt-1">
                            <input type="text" id="phone" value="{{ old('phone') ?? '' }}" name="phone" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>
                        @error('phone') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                        <label for="address" class="block text-sm font-medium text-gray-700">Адрес доставки</label>
                        <div class="mt-1">
                            <input type="text" id="address" name="address" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>
                        @error('address') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror

                        <label for="comment" class="block text-sm font-medium text-gray-700">Коментарий к заказу</label>
                        <div class="mt-1">
                            <textarea class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="comment" placeholder="Комментарий" maxlength="255" rows="2">{{ old('comment') ?? '' }}</textarea>
                        </div>
                        @error('comment') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="sm:col-span-6 pt-5">
                        <button type="submit" class="px-4 py-2 w-full text-waite bg-blue-500 hover:bg-blue-700 rounded-md">Создать</button>
                    </div>
                </form>
            </div>
    </div>
</x-app-layout>