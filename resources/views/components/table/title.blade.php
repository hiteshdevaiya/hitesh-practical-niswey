@props(['name'])

<p {{ $attributes->merge(['class' => 'text-lg font-bold max-[767px]:mb-4']) }}>
    {{ $name }}
</p>
