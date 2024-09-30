@props (['url' => '/', 'active'=>false, 'icon' => null, 'mobile'=>false])

@if ($mobile)
<a href="{{$url}}" class="block px-4 py-2 hover:bg-indigo-700 {{$active ? 'text-rose-500 font-bold' : ''}}">
    @if ($icon)
        <i class="fa fa-{{$icon}} mr-1 inline "></i>
    @endif
    {{$slot}}
</a>
@else
<a href="{{$url}}" class="text-white hover:underline py-2 {{$active ? 'text-rose-500 font-bold' : ''}}"> 
    @if ($icon)
        <i class="fa fa-{{$icon}} mr-1 inline "></i>
    @endif

{{$slot}}
</a>
@endif