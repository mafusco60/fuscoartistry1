@props (['url' => '/',  'icon' => null, 'bgClass'=>'bg-rose-500', 'hoverClass'=>'bg-rose-600', 'textClass' => 'text-black'])

<a href="{{$url}}" class="{{$bgClass}} {{$hoverClass}} {{$textClass}} py-3 px-2 rounded-lg">
@if ($icon)
<i class="fa fa-{{$icon}} mr-1 inline "></i>
@endif

{{$slot}}
</a>