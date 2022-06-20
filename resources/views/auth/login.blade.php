<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo" class="items-center">
            <a href="/">
                <img src="{{ asset('Blue.png') }}" class="w-20 h-20 items-center fill-current text-gray-500" alt="VINTAGE" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Пароль')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 float-right hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Забыли свой пароль?') }}
                </a>
                @endif
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Запомнить меня') }}</span>
                </label>
            </div>

            <div class="flex flex-col  items-center justify-end mt-4 gap-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('Ещё нет аккаунта?') }}
                </a>



                <x-button>
                    {{ __('Войти') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>