@props([
    'detail' => '',
    'home_team_score' => '',
    'away_team_score' => '',
    'home_team_name' => '',
    'away_team_name' => '',
    'time' => '',
    'star' => '',
    'match_id' => ''
])

<div class="result-main">
    <div class="result-match-date">
        <livewire:app.add-favorite-match match="{{ $match_id }}"/>
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

