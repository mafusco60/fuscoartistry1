@props([
  'id',
  'name',
  'label' => null,
  'type' => 'text',
  'options' => [],
  'value' => '',
])

@if ($label)
  <label for="{{ $id }}" class="inline-block text-sm mb-2">
    {{ $label }}
  </label>
@endif

<select
  class="text-sm border focus:outline-none rounded p-2 w-full font-bold @error($name) border-rose-500 @enderror"
  name="{{ $name }}"
  id="{{ $id }}"
>
  @foreach ($options as $optionValue => $optionLabel)
    <option
      value="{{ $optionValue }}"
      {{ old($name, $value) == $optionValue ? 'selected' : '' }}
    >
      {{ $optionLabel }}
    </option>
  @endforeach
</select>

@error($name)
  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror
