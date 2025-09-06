@props([
    'value' => null,
    'for' => null,
    'required' => false,
    'class' => '',
])

<label @if ($for) for="{{ $for }}" @endif
    {{ $attributes->merge(['class' => 'block mb-1 text-sm font-medium ' . $class]) }}>
    @if ($value)
        {{ $value }}
    @else
        {{ $slot }}
    @endif

    @if ($required)
        <span class="text-red-500">*</span>
    @endif
</label>
