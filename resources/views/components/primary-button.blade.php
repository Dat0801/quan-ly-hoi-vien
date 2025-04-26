@props(['width' => 132, 'height' => 48, 'route' => null])

@if ($route)
    <a href="{{ $route }}" style="width: {{ $width }}px; height: {{ $height }}px"
        {{ $attributes->merge(['class' => 'btn btn-primary sm:rounded-lg flex justify-center items-center fw-bold']) }}>
        {{ $slot }}
    </a>
@else
    <button style="width: {{ $width }}px; height: {{ $height }}px"
        {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary sm:rounded-lg flex justify-center items-center fw-bold']) }}>
        {{ $slot }}
    </button>
@endif