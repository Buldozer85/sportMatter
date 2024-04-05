<x-app.app title="Zápas">
    <div class="text-white flex justify-center">
        <x-app.matches.matchesContainer class="mt-20 matchContainerDetail text-center" date="21.11.2024" day_name="Pondělí" name_of_league="Tipsport liga - 1.kolo" img_src="img/football-ball-soccer-svgrepo-com.png">
            <x-app.matches.matchDetail time="21:00" home_team_name="John Dick" away_team_name="Jan Svoboboda" home_team_score="2" away_team_score="0">
                <x-slot name="overview">
                    <x-app.matches.awayParticipant minute="20" action_image="img/football-ball-soccer-svgrepo-com.png" player_name="Jan Svoboda"/>
                    <x-app.matches.awayParticipant minute="40" action_image="img/football-ball-soccer-svgrepo-com.png" player_name="Jan Svoboda"/>
                    <x-app.matches.homeParticipant minute="41" action_image="img/football-ball-soccer-svgrepo-com.png" player_name="Šimon Hrdý"/>
                </x-slot>

                <x-slot name="statistics">
                    <x-app.matches.stat name="Držení míče" home_team="20" away_team="80"/>
                    <x-app.matches.stat name="Držení míče" home_team="20" away_team="80"/>
                    <x-app.matches.stat name="Držení míče" home_team="20" away_team="80"/>
                </x-slot>
            </x-app.matches.matchDetail>
        </x-app.matches.matchesContainer>
    </div>
</x-app.app>
