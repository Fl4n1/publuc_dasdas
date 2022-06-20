<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ asset('Blue.png') }}" class="w-20 h-20 fill-current text-gray-500" alt="VINTAGE" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Спасибо, что зарегистрировались! Прежде чем приступить к работе, не могли бы вы подтвердить свой адрес электронной почты, перейдя по ссылке, которую мы только что отправили вам по электронной почте? Если вы не получили электронное письмо, мы с радостью вышлем вам другое.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Новая ссылка для подтверждения была отправлена на адрес электронной почты, который вы указали при регистрации.') }}
        </div>
        @endif

        <div class="mt-4 flex flex-col items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Отправить письмо повторно') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline mt-6 text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Выйти') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>