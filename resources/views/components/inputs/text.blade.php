@props([
    "id",
    "name",
    "label" => null,
    "type" => "text",
    "placeholder" => "",
    "value" => "",
    "required" => false,
    "readonly" => false,
    "textClass" => "block mt-1 w-full rounded p-2 focus:outline-none text-stone-800 border border-stone-200 form control text-sm",
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
        class
        ="{{ $textClass }}"
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
