@props([
    'id',
    'name',
    'label' => null,
    'placeholder' => '',
    'value' => '',
    'rows' => 3,
    'cols' => 30,
    'required' => false,
])

<div class="mb-2">
    @if ($label)
        <label class="inline-block text-sm" for="{{ $id }}">
            {{ $label }}
        </label>
    @endif

    <textarea
        rows="{{ $rows }}"
        cols="{{ $cols }}"
        type="textarea"
        class="text-sm border rounded p-2 w-full focus:outline-none font-bold @error($name) border-rose-500 @enderror"
        name="{{ $name }}"
        id="{{ $id }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
    >
{{ old($name, $value) }}</textarea
    >

    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
