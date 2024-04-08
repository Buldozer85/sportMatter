<x-app.app title="{{ $league->name }}">
    <div class="content-wrapper">
        <div class="flex flex-col mx-auto space-y-4">
            <h1 class="text-center text-5xl">Ročníky</h1>
            <ul role="list" class="divide-y divide-gray-100 pt-12">
            @foreach($league->seasons as $season)
                <x-app.season-widget detail="{{ route('season.index', $season->id)}}" :name_of_league="$league->name . ' ' . $season->season_years"/>
            @endforeach
            </ul>
        </div>

    </div>
</x-app.app>
