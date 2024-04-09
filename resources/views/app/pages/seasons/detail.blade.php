<x-app.app title="Ročník">
    <h1 class="text-white text-center text-3xl pt-12">Ročník: {{ $season->league->name . ' ' . $season->season_years }}</h1>
    <div class="content-wrapper">
        <div class="result-content" x-data="{
            tab: 'matches'
        }">
            <div class="control-panel flex gap-2 mt-4">
                <button class="font-bold" @click="tab = 'matches'" :class="{ 'bg-white text-black': tab === 'matches' }" type="button">Zápasy</button>
                <button class="font-bold" @click="tab = 'leaderboard'" :class="{ 'bg-white text-black': tab === 'leaderboard' }" type="button">Žebříček</button>
            </div>
            <div class="space-y-4" x-show="tab === 'matches'">


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

            <div x-show="tab === 'leaderboard'">

                <div class="mx-auto max-w-7xl ">
                    <div class="bg-gray-900 py-10 rounded-lg">
                        <div class="px-4 sm:px-6 lg:px-8">
                            <div class="mt-8 flow-root">
                                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                        <table class="min-w-full divide-y divide-gray-700">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">Umístění</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Tým</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Počet zápasů</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Body</th>
                                            </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-800">
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach($season->teams as $team)
                                            <tr>
                                                <a>
                                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">{{ $i }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">{{ $team->name }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">{{ $team->getMatchesCountInSeason($season->id) }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">{{ $team->pivot->points }}</td>
                                                </a>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
</x-app.app>
