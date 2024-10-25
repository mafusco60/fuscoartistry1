@props([
    "id",
    "name",
    "label" => null,
    "placeholder" => "",
    "value" => "",
    "rows" => 3,
    "cols" => 30,
    "required" => false,
    "readonly" => false,
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
        @if ($readonly)
            readonly
            class="block mt-1 w-full border border-gray-200 rounded p-2 focus:outline-none text-stone-800 focus:border-none form control bg-stone-200"
        @else
            class="text-sm border rounded p-2 w-full focus:outline-none font-bold @error($name)
         border-rose-500 @enderror



                                "
        @endif
        name="{{ $name }}"
        id="{{ $id }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? "required" : "" }}
    >
{{ old($name, $value) }}</textarea
    >

    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
