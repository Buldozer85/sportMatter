<div class="space-y-8">
    <div class="flex flex-row justify-end items-baseline">
        @if(is_null($leaguesWithMatches->first()) && $hasNextMatches)
            <div class="calendar flex justify-end items-end">
                <button class="p-[5px] !px-4 text-center" type="button" id="move_to_next" wire:click="move()">Přejít na nejbližší hrací den </button>
            </div>
        @endif

        <div class="calendar flex justify-end items-end">
            <x-app.forms.input type="date" id="date_of_match" wire:model.live="inputDate" name="date"/>
        </div>
    </div>


    @foreach($leaguesWithMatches as $leagueWithMatches)
        <x-app.matches.matchesContainer date="{{ $date->format('d.n.Y') }}" day_name="{{ getDayName($date) }}" name_of_league="{{ $leagueWithMatches->name }}" img_src="img/football-ball-soccer-svgrepo-com.png">
            @foreach($leagueWithMatches->matches()->whereDate('date_of_match', '=', $date->format('Y-m-d'))->get() as $match)
                <x-app.matches.match time="{{ $match->date_of_match->format('H:i') }}" home_team_name="{{ $match->homeTeam->name }}" away_team_name="{{ $match->awayTeam->name }}" home_team_score="{{ $match->home_score }}" away_team_score="{{ $match->away_score }}" detail="{{ route('match.detail', $match->id) }}" match_id="{{ $match->id }}"/>
            @endforeach
        </x-app.matches.matchesContainer>
    @endforeach
</div>
