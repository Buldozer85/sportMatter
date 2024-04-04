@props([
    'name' => '',
    'home_team' => '',
    'away_team' => '',
])


<div>
    <p>{{$name}}</p>
    <div class="flex flex-row justify-center items-center">
        <p class="font-bold">{{$home_team}}</p>
        <p class="bar font-bold"></p>
        <p class="font-bold">{{$away_team}}</p>
    </div>
</div>
