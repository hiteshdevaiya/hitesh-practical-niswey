@props([
    'type' => null,
    'id' => null,
    'name' => null,
    'model' => null,
    'placeholder' => '',
    'class' => '',
    'maxlength' => 70,
])

@php
    $baseClass =
        'pl-4 py-3.5 placeholder-[#A0A0A0] bg-white border border-[rgba(41,41,41,0.2)] rounded-xl pr-10 focus:outline-none w-full';
@endphp

<input
    {{ $attributes->merge([
            'id' => $id,
            'name' => $name,
            'placeholder' => $placeholder,
            'class' => "$baseClass $class",
            'maxlength' => $maxlength,
        ])->when($type, fn($attr) => $attr->merge(['type' => $type])) }}
    @if ($model) wire:model.defer="{{ $model }}" @endif />
