@props([
    'name' => null,
    'model' => null,
    'placeholder' => 'Search...',
    'class' => '',
])

@php
    $baseClass = 'pl-4 py-2.5 xl:py-2.5 2xl:py-3.5 text-gray-700 bg-white border border-[rgba(41,41,41,0.2)] rounded-xl pr-10 focus:outline-none w-full';
@endphp

<input
    type="text"
    @if ($name) name="{{ $name }}" @endif
    placeholder="{{ $placeholder }}"
    class="{{ trim($baseClass . ' ' . $class) }}"
    @if ($model) wire:model.live.debounce.300ms="{{ $model }}" @endif
    {{ $attributes }} />
