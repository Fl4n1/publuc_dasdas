@props(['active'])

@php
$classes = 'bg-green-500 hover:bg-green-700 text-white duration-300 font-bold py-2 px-4 rounded';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>