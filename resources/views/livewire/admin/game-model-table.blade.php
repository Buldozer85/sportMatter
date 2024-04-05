<div class="px-4 sm:px-6 lg:px-8" x-data="{
    openModal: false,
    params: {
        id: ''
    }
}">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Zápasy</h1>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{ route('admin.games.show-create') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Vytvořit zápas</a>
        </div>
    </div>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Id</th>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Datum konání</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Kolo</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Domácí tým</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Hostující tým</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Skóre</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Sport</th>

                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                            <span class="sr-only">Akce</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach($data as $game)
                    <tr>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $game->id }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $game->date_of_match->format('d.n.Y') }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $game->lap }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $game->homeTeam->name }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $game->awayTeam->name }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $game->score }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $game->league->sport->name }}</td>

                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                            <a href="{{ route('admin.games.show-update', $game->id) }}" class="text-indigo-600 hover:text-indigo-900">Upravit<span class="sr-only">, {{ $game->id }}</span></a>
                            <a @click="openModal = !openModal; params.id='{{$game->id}}'" class="text-indigo-600 hover:text-indigo-900">Smazat<span class="sr-only">, {{ $game->id }}</span></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <x-admin.modal show-variable="openModal" heading="Smazat " text="Opravdu si přejete tento záznam smazat?"/>
    {{ $data->links() }}
</div>
