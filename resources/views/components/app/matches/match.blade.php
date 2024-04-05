@props([
    'detail' => '',
    'home_team_score' => '',
    'away_team_score' => '',
    'home_team_name' => '',
    'away_team_name' => '',
    'time' => '',
    'star' => ''
])

<div class="result-main">
    <div class="result-match-date">
        {{$star}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
        </svg>
        <p id="time_of_match">{{$time}}</p>
        <div class="vertical-line"></div>
    </div>
    <div class="result-teams">
        <p id="home_team_name">{{$home_team_name}}</p>
        <p id="away_team_name">{{$away_team_name}}</p>
    </div>
    <div class="result-score">
        <p id="home_team_score">{{$home_team_score}}</p>
        <p id="away_team_score">{{$away_team_score}}</p>
    </div>
    <div class="result-detail">
        <a href="{{$detail}}">Detail</a>
    </div>
</div>

