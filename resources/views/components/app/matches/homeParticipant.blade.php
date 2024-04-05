@props([
    'minute' => '',
    'action_image' => '',
    'player_name' => '',
])

<div class="flex flex-row justify-start items-center gap-2 homePart">
    <p>{{$minute}}</p>
    <img width="20px" src="{{ asset($action_image) }}" alt="">
    <p>{{$player_name}}</p>
</div>
