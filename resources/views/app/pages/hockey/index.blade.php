<x-app.app title="Hokej">
    <div class="content-wrapper">
        <x-app.add_panels.additional_panel text="Nejznámější ligy">
            @foreach($hockeyLeagues as $league)
                <x-app.add_panels.panel_link href="{{ route('league.index', $league->id) }}" img="img/football-ball-soccer-svgrepo-com.png" text="{{ $league->name }}"/>
            @endforeach
        </x-app.add_panels.additional_panel>
        <div class="result-content">
                <livewire:app.matches-by-day></livewire:app.matches-by-day>

        </div>
    </div>
</x-app.app>
