@props([
    'condition' => 'show',
    'class' => '',
    'alt' => 'Toggle Password Visibility',
])

<img x-cloak :src="{{ $condition }} ? '{{ Vite::asset('resources/images/password-show-icon.svg') }}' :
    '{{ Vite::asset('resources/images/password-hide-icon.svg') }}'"
    alt="{{ $alt }}" @click="{{ $condition }} = !{{ $condition }}"
    {{ $attributes->merge(['class' => $class . ' cursor-pointer']) }} />
