@props(['item', 'inSetting' => false])

@php
    $isActive = request()->routeIs(...$item['active_routes']);
@endphp

<li class="{{ $inSetting ? 'mt-2' : 'mb-2' }}">
    <x-nav-link 
        :href="route($item['base_route'])"
        :active-text="$inSetting ? $isActive : null"
        :active="$inSetting ? null : $isActive">
        {{ $item['label'] }}
    </x-nav-link>
</li>