@props([
    'url' => '/',
    'icon' => null,
    'bgClass' => 'bg-yellow-600',
    'hoverClass' => 'hover:bg-yellow-500',
    'textClass' => 'text-black',
    'block' => 'false',
])

<a
    href="{{ $url }}"
    class="{{ $bgClass }} {{ $hoverClass }} {{ $textClass }} py-4 px-2 rounded-lg w-full"
>
    @if ($icon)
        <i class="fa fa-{{ $icon }} mr-1 inline"></i>
    @endif

    {{ $slot }}
</a>
