<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ asset('Blue.png') }}" class="w-20 h-20 fill-current text-gray-500" alt="VINTAGE" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Пожалуйста, подтвердите свой пароль, прежде чем продолжить.') }}
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <x-label for="password" :value="__('Пароль')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex flex-col justify-end mt-4">
                <x-button>
                    {{ __('Подтвердить') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>