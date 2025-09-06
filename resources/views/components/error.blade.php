@props([
    'field',
    'class' => '',
])

@error($field)
    <span {{ $attributes->merge(['class' => 'text-red-500 text-sm ' . $class]) }}>
        {{ $message }}
    </span>
@enderror
