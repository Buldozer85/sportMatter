<x-admin::layouts.dashboard title="Vytvoření zápasu">
    <form method="post">
        <h1 class="text-center font-bold text-xl">Vytvoření zápasu</h1>
        <div class="flex flex-col mb-4 mt-5" x-data="{
            selectedSport: {{ old('sport') ?? 1}}
        }">
            <div class="flex flex-row gap-5">
                <div class="w-6/12">
                    <x-admin.forms.select
                        label="Domácí tým/hráč"  {{--         TODO: měnit podle selected sportu, výsledky zapisovat v params           --}}
                        id="home_team"
                        name="home_team"
                        :options="[
                    1 => 'Real Madrid',
                  ]"
                    />
                </div>
                <div class="w-6/12">
                    <x-admin.forms.select
                        label="Venkovní tým/hráč"
                        id="away_team"
                        name="away_team"
                        :options="[
                    1 => 'Barcelona',
                  ]"
                    />
                </div>
            </div>
            <div class="flex flex-row gap-5">
                <div class="w-6/12">
                    <x-admin.forms.input type="date" name="date_of_match" id="date_of_match" label="Datum zápasu"/>
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input type="text" name="lap" id="lap" label="Kolo"/>
                </div>
            </div>
            <div class="flex flex-row gap-5">
                <div class="w-6/12">
                    <x-admin.forms.select
                        label="Liga"
                        id="league"
                        name="league"
                        :options="[
                    1 => 'Bundesliga',
                  ]"
                    />
                </div>
                <div class="w-6/12">
                    <x-admin.forms.select
                        label="Adminstrátor zápasu"
                        id="supervisor"
                        name="supervisor"
                        :options="[
                    1 => 'Jan Krupička',
                  ]"
                    />
                </div>

                <div class="w-6/12">
                    <x-admin.forms.select
                        x-model="selectedSport"
                        label="Sport"
                        id="sport"
                        name="sport"
                        :options="[
                    1 => 'Šipky',
                    2 => 'Fotbal',
                    3 => 'Hokej'
                  ]"
                    />
                </div>
            </div>
            <h2>Parametry</h2>
            <div>
                <div x-show="selectedSport == 1">   {{--         TODO: Jestli neudělat kontrolu spíš podle nějakého klíče idk           --}}
                    <x-admin.forms.input name="best_of" id="best_of" label="Nejlepší z x"/>  {{--         Myšlwno jako text input, bude se tam zadávat např. z 5 legů nebo 3 setů           --}}
                    <x-admin.forms.input name="count_of_legs_first_player"/> {{--        TODO: same pro druhého hráče, ještě i sety           --}}
                   <x-admin.forms.input name="avarage_player_one"></x-admin.forms.input> {{--        TODO: same pro druhého hráče          --}}
                </div>

                <div x-show="selectedSport == 2">   {{--         TODO: Jestli neudělat kontrolu spíš podle nějakého klíče idk           --}}
                    <x-admin.forms.input name="" id="best_of" label="Nejlepší z x"/>  {{--         Myšlwno jako text input, bude se tam zadávat např. z 5 legů nebo 3 setů           --}}

                </div>
            </div>
            <div class="flex justify-center mt-5 ">
                <button type="button"
                        class="w-fit px-32 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Vytvořit
                </button>
            </div>
        </div>
    </form>
</x-admin::layouts.dashboard>
