@props(['active' => false, 'activeText' => false])

@php
    $classes = 'nav-link text-gray-500' . ($active ? ' active' : '');
    $textClasses = 'setting-text' . ($activeText ? ' active' : '');
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if ($activeText)
        <span class="{{ $textClasses }}">{{ $slot }}</span>
    @else
        {{ $slot }}
    @endif
</a>
