@props(['active'])

@php
$classes = ($active ?? false)
? 'inline-flex items-center h-fit self-center px-1 pt-1 text-sm font-medium leading-5 text-black focus:outline-none transition duration-150 ease-in-out'
: 'inline-flex items-center h-fit self-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>