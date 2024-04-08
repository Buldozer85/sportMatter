<x-app.app title="Ročník">
    <h1 class="text-white text-center text-3xl pt-12">Ročník: {{ $season->league->name . ' ' . $season->season_years }}</h1>
    <div class="content-wrapper">
        <div class="result-content">
            @for($i = 1; $i <= $season->matches->max('lap');  $i++)
                @php
                    $matches = $season->matches->where('lap', '=', $i);
                @endphp

                <x-app.matches.matchesContainer date="{{ $matches->first()->date_of_match->format('d.n.Y') }}" day_name="{{ getDayName($matches->first()->date_of_match) }}" name_of_league="{{$matches->first()->season_league_label }}" img_src="img/football-ball-soccer-svgrepo-com.png">
                    @foreach($matches as $match)
                        <x-app.matches.match time="{{ $match->date_of_match->format('H:i') }}" home_team_name="{{ $match->homeTeam->name }}" away_team_name="{{ $match->awayTeam->name }}" home_team_score="{{ $match->home_score }}" away_team_score="{{ $match->away_score }}" detail="{{ route('match.detail', $match->id) }}" />
                    @endforeach
                </x-app.matches.matchesContainer>
            @endfor
        </div>
    </div>
</x-app.app>
