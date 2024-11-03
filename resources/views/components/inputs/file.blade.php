@props([
  'id',
  'name',
  'label' => null,
])

<div class="mb-2">
  @if ($label)
    <label class="inline-block text-sm" for="{{ $id }}">
      {{ $label }}
    </label>
  @endif

  <input
    id="{{ $id }}"
    type="file"
    class="text-sm border rounded p-2 w-full focus:outline-none font-bold @error($name) border-rose-500 @enderror"
    name="{{ $name }}"
  />

  @error($name)
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
  @enderror
</div>
