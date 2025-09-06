@props([
    'type' => 'submit',
    'class' => '',
    'disabled' => false,
])

<button type="{{ $type }}" {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge(['class' => 'cursor-pointer ' . $class]) }}>
    {{ $slot }}
</button>
