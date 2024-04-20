<x-app.app title="Tým">
    <div class="space-y-4 max-w-7xl mx-auto pt-12">
    <h1 class="text-white text-3xl">Tým: {{ $team->name }}</h1>

    <div class="text-white">
        <ul>
            <li>Stadion: {{ $team->stadium->name }}</li>
            <li>Kapacita: {{ $team->stadium->capacity }}</li>
        </ul>
    </div>

    @if(!is_null($latestHomeMatch))
        <div class="text-white space-y-4">
            <h2 class="text-2xl">Poslední domácí zápas</h2>
            <x-app.matches.matchesContainer date="{{ $latestHomeMatch->date_of_match->format('d.n.Y') }}" day_name="{{ getDayName($latestHomeMatch->date_of_match) }}" name_of_league="{{ $latestHomeMatch->season_league_label }}">
                <x-app.matches.match detail="{{ route('match.detail', [$latestHomeMatch->id]) }}" home_team_score="{{ $latestHomeMatch->home_score }}" away_team_score="{{ $latestHomeMatch->away_score }}" away_team_name="{{ $latestHomeMatch->awayTeam->name }}" home_team_name="{{ $latestHomeMatch->homeTeam->name }}" match_id="{{ $latestHomeMatch->id }}" time="{{ $latestHomeMatch->date_of_match->format('H:i') }}"></x-app.matches.match>
            </x-app.matches.matchesContainer>
        </div>
    @endif



    @if(!is_null($latestAwayMatch))

        <div class="text-white space-y-4">
            <h2 class="text-2xl">Poslední venkovní zápas</h2>
            <x-app.matches.matchesContainer date="{{ $latestAwayMatch->date_of_match->format('d.n.Y') }}" day_name="{{ getDayName($latestAwayMatch->date_of_match) }}" name_of_league="{{ $latestAwayMatch->season_league_label }}">
                <x-app.matches.match detail="{{ route('match.detail', [$latestAwayMatch->id]) }}" home_team_score="{{ $latestAwayMatch->home_score }}" away_team_score="{{ $latestAwayMatch->away_score }}" away_team_name="{{ $latestAwayMatch->awayTeam->name }}" home_team_name="{{ $latestAwayMatch->homeTeam->name }}" match_id="{{ $latestAwayMatch->id }}" time="{{ $latestAwayMatch->date_of_match->format('H:i') }}"></x-app.matches.match>
            </x-app.matches.matchesContainer>

        </div>
    @endif



    <div class="py-24 sm:py-32 text-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Tým</h2>

            </div>
            <ul role="list" class="mx-auto mt-20 grid max-w-2xl grid-cols-2 gap-x-8 gap-y-16 text-center sm:grid-cols-3 md:grid-cols-4 lg:mx-0 lg:max-w-none lg:grid-cols-5 xl:grid-cols-6">
                @foreach($team->players as $player)
                    <li>
                        <a href="{{ route('player.detail', $player->id) }}" class="flex flex-col justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-24 h-24 mx-auto">
                                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                            </svg>

                            <h3 class="mt-6 text-base font-semibold leading-7 tracking-tight text-white">{{ $player->full_name }}</h3>
                        </a>

                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    </div>
</x-app.app>
