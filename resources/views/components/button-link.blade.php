@props ([
    'url' => '/',  
    'icon' => null, 
    'bgClass'=>'bg-yellow-500', 
    'hoverClass'=>'bg-yellow-500', 
    'textClass' => 'text-black',
    'block' => 'false'
    ])

<a href="{{$url}}" class="{{$bgClass}} {{$hoverClass}} {{$textClass}} py-3 px-2 rounded-lg">
@if ($icon)
<i class="fa fa-{{$icon}} mr-1 inline "></i>
@endif

{{$slot}}
</a>