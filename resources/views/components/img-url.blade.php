@props(['url', 'class' => ''])
<img src="{{ $url }}" alt="Image" {{ $attributes->merge(['class' => $class]) }} />
