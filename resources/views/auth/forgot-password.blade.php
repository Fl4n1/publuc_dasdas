<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ asset('Blue.png') }}" class="w-20 h-20 fill-current text-gray-500" alt="VINTAGE" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Забыли свой пароль? Мы вам поможем. Просто сообщите нам свой адрес электронной почты, и мы отправим вам ссылку для сброса пароля, которая позволит вам выбрать новый.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex flex-col items-center justify-end mt-4">
                <x-button>
                    {{ __('Отправить ссылку сброса пароля') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>