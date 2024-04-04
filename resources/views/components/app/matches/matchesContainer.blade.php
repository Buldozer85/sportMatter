@props([
    'date' => false,
    'day_name' => '',
    'name_of_league' => '',
    'img_src' => '',
    'class' => ''
])

<div class="result {{$class}}">
    <div class="result-panel">
        <div class="result-headline flex flex-row justify-between">
            <div class="flex items-center gap-3 result-name font-bold">
                <img class="h-4" src="{{ asset($img_src) }}">
                <p>{{$name_of_league}}</p>
            </div>
            <div class="result-date font-bold">
                <p>{{$day_name}} | {{$date}}</p>
            </div>
        </div>
</div>
    {{$slot}}
</div>
