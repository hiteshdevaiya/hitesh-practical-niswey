@props(['href', 'target' => null, 'class' => ''])

<a href="{{ $href }}" wire:navigate @if ($target) target="{{ $target }}" @endif
    {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</a>
