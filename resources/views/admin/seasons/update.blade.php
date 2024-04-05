<x-admin::layouts.dashboard title="Úprava sezóny">
    <form action="{{ route('admin.seasons.update', $season->id) }}" method="post">
        @csrf
        <h1 class="text-center font-bold text-xl">Úprava sezóny</h1>
        <div class="flex flex-col mb-4 mt-5">
            <div class="flex flex-row gap-5">
                <div class="w-6/12">
                    <x-admin.forms.input type="date" name="yearStart" id="yearStart" label="Datum začátku sezóny" value="{{ $season->yearStart->format('Y-m-d') }}"/>
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input type="date" name="yearEnd" id="yearEnd" label="Datum konce sezóny" value="{{ $season->yearEnd->format('Y-m-d') }}"/>
                </div>
            </div>
            <livewire:admin.team-assigner :selected-teams="$season->teams" selected-league="{{ $season->league_id }}"/>

            <div class="flex justify-center mt-5 ">
                <button type="submit"
                        class="w-fit px-32 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Upravit
                </button>
            </div>
        </div>
    </form>
</x-admin::layouts.dashboard>
