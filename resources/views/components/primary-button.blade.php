@props(['width' => 132, 'height' => 48])

<button style="width: {{ $width }}px; height: {{ $height }}px"
    {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary sm:rounded-lg flex justify-center items-center']) }}>
    {{ $slot }}
</button>

