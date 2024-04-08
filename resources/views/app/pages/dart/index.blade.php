<x-app.app title="Šipky">

    <div class="content-wrapper">
        <x-app.add_panels.additional_panel text="Nejznámější ligy">
            @foreach($dartsLeagues as $league)
                <x-app.add_panels.panel_link href="{{ route('league.index', $league->id) }}" img="img/football-ball-soccer-svgrepo-com.png" text="{{ $league->name }}"/>
            @endforeach
        </x-app.add_panels.additional_panel>
        <div class="result-content">
            <livewire:app.matches-by-day></livewire:app.matches-by-day>
        </div>
    </div>
</x-app.app>
