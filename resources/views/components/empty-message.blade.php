@props(['message'])

<p {{ $attributes->merge(['class' => 'text-gray-500 font-semibold text-center w-full col-span-full']) }}>
    {{ $message }}
</p>
