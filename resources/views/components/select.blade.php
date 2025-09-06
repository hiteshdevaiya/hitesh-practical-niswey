@props([
    'name' => '',
    'id' => '',
    'options' => [],
    'selected' => null,
    'class' => '',
    'model' => null,
    'modelType' => 'default'
])

<select
    id="{{ $id }}"
    name="{{ $name }}"
    @if($model)
        @if($modelType === 'lazy') wire:model.lazy="{{ $model }}"
        @elseif($modelType === 'defer') wire:model.defer="{{ $model }}"
        @else wire:model="{{ $model }}"
        @endif
    @endif
    {{ $attributes->merge([
        'class' => 'text-base block bg-white border border-[#E7E7E7] rounded-xl py-3.5 px-3 appearance-none focus:outline-0 w-full ' . $class
    ]) }}
>
    @foreach($options as $option)
        <option value="{{ $option['value'] }}" @selected($option['value'] == $selected)>
            {{ $option['label'] }}
        </option>
    @endforeach
</select>
