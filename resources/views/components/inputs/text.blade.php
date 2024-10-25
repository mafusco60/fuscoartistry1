@props([
    "id",
    "name",
    "label" => null,
    "type" => "text",
    "placeholder" => "",
    "value" => "",
    "required" => false,
    "readonly" => false,
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
        @if ($readonly)
            readonly
            class="block mt-1 w-full border border-gray-200 rounded p-2 focus:outline-none text-stone-800 focus:border-none form control bg-stone-200"
        @else
            class="text-sm border rounded p-2 w-full focus:outline-none font-bold @error($name)
         border-rose-500 @enderror
        "
        @endif
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? "required" : "" }}
        value="{{ old($name, $value) }}"
    />

    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
