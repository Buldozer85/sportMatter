<div class="space-y-8">
    <div class="calendar flex justify-end items-end">
        <x-app.forms.input type="date" id="date_of_match" wire:model.live="inputDate" name="date"/>
    </div>

    @foreach($leaguesWithMatches as $leagueWithMatches)
        <x-app.matches.matchesContainer date="{{ $date->format('d.n.Y') }}" day_name="{{ getDayName($date) }}" name_of_league="{{ $leagueWithMatches->name }}" img_src="img/football-ball-soccer-svgrepo-com.png">
            @foreach($leagueWithMatches->matches as $match)
                <x-app.matches.match time="{{ $match->date_of_match->format('H:i') }}" home_team_name="{{ $match->homeTeam->name }}" away_team_name="{{ $match->awayTeam->name }}" home_team_score="{{ $match->home_score }}" away_team_score="{{ $match->away_score }}" detail="{{ route('match.detail', $match->id) }}" />
            @endforeach
        </x-app.matches.matchesContainer>

    @endforeach

</div>
