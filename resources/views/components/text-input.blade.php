@props(['disabled' => false, 'width' => 540, 'height' => 60])

<input 
style="width: {{ $width }}px; height: {{ $height }}px"
{{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
