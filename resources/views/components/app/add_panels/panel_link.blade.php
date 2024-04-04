@props([
    'img' => '',
    'text' => '',
    'href' => '#'
])

<div class="flex items-center gap-2 font-bold">
    <img class="h-4" src="{{ asset($img) }}">
    <a href="{{$href}}">{{$text}}</a>
</div>

