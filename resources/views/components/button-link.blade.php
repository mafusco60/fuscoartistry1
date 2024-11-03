@props([
  'url' => '/',
  'icon' => null,
  'bgClass' => 'bg-yellow-500',
  'hoverClass' => 'hover:bg-yellow-400',
  'textClass' => 'text-indigo-900',
  'block' => 'false',
])

<a
  href="{{ $url }}"
  class="{{ $bgClass }} {{ $hoverClass }} {{ $textClass }} py-4 px-6 rounded-lg text-center text-md"
>
  @if ($icon)
    <i class="fa fa-{{ $icon }} mr-1 inline"></i>
  @endif

  {{ $slot }}
</a>
