<x-app.app title="Šipky">
    <div class="calendar flex justify-end items-end">
        <x-app.forms.input type="date" id="date_of_match" name=""/>
    </div>
    <div class="content-wrapper">
        <x-app.add_panels.additional_panel text="Nejznámější ligy">
            <x-app.add_panels.panel_link img="img/football-ball-soccer-svgrepo-com.png" text="NHL"/>
            <x-app.add_panels.panel_link img="img/football-ball-soccer-svgrepo-com.png" text="Tipsport Extraliga"/>
            <x-app.add_panels.panel_link img="img/football-ball-soccer-svgrepo-com.png" text="Extraliga"/>
        </x-app.add_panels.additional_panel>
        <div class="result-content">

            <x-app.matches.matchesContainer date="21.11.2O24" day_name="Úterý" name_of_league="Liga mistrů" img_src="img/football-ball-soccer-svgrepo-com.png">
                <x-app.matches.match time="21:00" home_team_name="John Dick" away_team_name="Jan Svoboboda" home_team_score="2" away_team_score="0" detail="/zapas/1" />
            </x-app.matches.matchesContainer>

                <x-app.matches.matchesContainer date="22.11.2O24" day_name="Středa" name_of_league="Mistrostrví světa" img_src="img/football-ball-soccer-svgrepo-com.png">
                    <x-app.matches.match time="21:00" />
                    <x-app.matches.match time="21:00" />
                </x-app.matches.matchesContainer>
        </div>
    </div>
</x-app.app>
