@props([
    'minute' => '',
    'action_image' => '',
    'player_name' => '',
])

<div class="flex flex-row justify-end items-center gap-2 awayPart">
    <p>{{$minute}}</p>
    <img width="20px" src="{{ asset($action_image) }}">
    <p>{{$player_name}}</p>
</div>
