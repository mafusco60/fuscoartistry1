@props([
    'id',
    'name',
    'label' => null,
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
])

<div class="mb-2">
    @if ($label)
        <label class="inline-block text-sm" for="{{ $id }}">
            {{ $label }}
        </label>
    @endif

    <input
        id="{{ $id }}"
        type="{{ $type }}"
        class="text-sm border rounded p-2 w-full focus:outline-none @error($name) border-rose-500 @enderror"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($id) }}"
    />

    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
