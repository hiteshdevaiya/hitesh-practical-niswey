@props(['name', 'class' => ''])
<img src="{{ Vite::asset('resources/images/' . $name) }}" alt="{{ $name }}"
    {{ $attributes->merge(['class' => $class]) }} />
