@props([
    'detail' => '',
    'home_team_score' => '',
    'away_team_score' => '',
    'home_team_name' => '',
    'away_team_name' => '',
    'time' => '',
    'star' => '',
    'referees' => [],
    'stadium' => ''
])

<div class="detailMatchContainer text-center space-y-4">
        <p class="text-center font-bold">{{$time}}</p>
        <div class="score flex flex-row justify-center items-center mt-5">
            <p class="font-bold text-3xl flex-1">{{$home_team_name}}</p>
        <div class="flex flex-row justify-center items-center gap-3 flex-1">
            <p class="font-bold text-3xl">{{$home_team_score}}</p>
            <p class="font-bold text-3xl">:</p>
            <p class="font-bold text-3xl">{{$away_team_score}}</p>
        </div>
            <p class="font-bold text-3xl flex-1">{{$away_team_name}}</p>
        </div>
        <div class="line">

        </div>
    <div class="text-left">
        <div>
            <p class="border-b-2 solid border-white max-w-[100px] py-2">Rozhodčí</p>
            <ul class="ml-4 mt-4">
                @foreach($referees as $referee)
                    <li>{{ $referee->full_name }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="text-left border-b-2 solid border-white py-4">
        <div>
            <p class="border-b-2 solid border-white max-w-[100px] py-2">Stadión</p>
            <p class="ml-4 mt-4">
                {{ $stadium }}
            </p>
        </div>
    </div>
    <div x-data="{ tab: 'overview' }">
        <div class="control-panel flex gap-2 mt-4">
            <button class="font-bold" @click="tab = 'overview'" :class="{ 'bg-white text-black': tab === 'overview' }" type="button">Přehled</button>
            <button class="font-bold" @click="tab = 'statistics'" :class="{ 'bg-white text-black': tab === 'statistics' }" type="button">Statistiky</button>
        </div>

        <div x-show="tab === 'overview'" class="matchReport mt-10 flex flex-col gap-5 pb-5">
            {{$overview}}
        </div>

        <div x-show="tab === 'statistics'" class="stats  mt-10 flex justify-center flex-col gap-5 pb-5">
            {{$statistics}}
        </div>
    </div>

</div>
