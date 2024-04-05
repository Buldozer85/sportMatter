<x-admin::layouts.dashboard title="Vytvoření zápasu">
    <form action="{{ route('admin.games.create') }}" method="post">
        @csrf
        <h1 class="text-center font-bold text-xl">Vytvoření zápasu</h1>
        <div class="flex flex-col mb-4 mt-5">
            <livewire:admin.games-form/>

            <div class="flex justify-center mt-5 ">
                <button type="submit"
                        class="w-fit px-32 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Vytvořit
                </button>
            </div>
        </div>
    </form>
</x-admin::layouts.dashboard>
