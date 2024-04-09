<x-app.app title="Fotbal">

    <div class="content-wrapper">
        <x-app.add_panels.additional_panel text="Nejznámější ligy">
            @foreach($footballLeagues as $league)
                <x-app.add_panels.panel_link href="{{ route('league.index', $league->id) }}" img="img/football-ball-soccer-svgrepo-com.png" text="{{ $league->name }}"/>
            @endforeach

        </x-app.add_panels.additional_panel>
        <div class="result-content">
            <livewire:app.matches-by-day sport="{{$footballLeagues->first()->sport->id }}"></livewire:app.matches-by-day>
        </div>
    </div>
</x-app.app>
