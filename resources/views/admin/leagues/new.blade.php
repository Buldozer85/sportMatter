<x-admin::layouts.dashboard title="Vytvoření ligy">
    <form action="{{ route('admin.leagues.create') }}" method="post">
        @csrf
        <h1 class="text-center font-bold text-xl">Vytvoření ligy</h1>
        <div class="flex flex-col mb-4 mt-5">
            <div class="flex flex-row gap-5">
                <div class="w-6/12">
                    <x-admin.forms.input type="text" name="name" id="name" label="Název"/>
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input type="text" name="association" id="association" label="Asociace"/>
                </div>
            </div>
            <div class="flex flex-row gap-5">
                <div class="w-6/12">
                    <x-admin.forms.select
                        label="Země"
                        id="country"
                        name="country"
                        :options="$countryOptions"
                    />
                </div>
                <div class="w-6/12">
                    <x-admin.forms.select
                        label="Sport"
                        id="sport"
                        name="sport"
                        :options="$sportsOptions"
                    />
                </div>
            </div>
            <div class="flex justify-center mt-5 ">
                <button type="submit"
                        class="w-fit px-32 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Vytvořit
                </button>
            </div>
        </div>
    </form>
</x-admin::layouts.dashboard>
