@props(['route', 'width' => 132, 'height' => 48])

<a href="{{ $route }}" 
    style="width: {{ $width }}px; height: {{ $height }}px;"
   {{ $attributes->merge(['class' => 'btn btn-outline-primary sm:rounded-lg flex justify-center items-center fw-bold']) }}>
    {{ $slot ?? 'Hủy' }}
</a>

