<x-app.app title="Hráč: {{ $player->full_name }}">
    <div class="text-white max-w-7xl mx-auto pt-12">
        <h1 class="text-4xl">{{ $player->full_name }}</h1>

        <div class="mt-12 space-y-4">
            <h2 class="text-3xl">O hráči</h2>
            <ul>
                <li><b>Aktuální tým:</b> {{ $player->team->name }}</li>
                <li><b>Národnost:</b> {{ $player->country->name }}</li>
                <li><b>Věk:</b> {{ $player->birthdate->diffInYears(Carbon\Carbon::now()) }}</li>
            </ul>

        </div>

        @if(!is_null($player->transfers->first()))
            <div class="mt-12 space-y-4">
                <h2 class="text-3xl">Předchozí působiště</h2>
                <div class="mx-auto max-w-7xl ">
                    <div class="bg-gray-900 py-10 rounded-lg">
                        <div class="px-4 sm:px-6 lg:px-8">
                            <div class="mt-8 flow-root">
                                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                        <table class="min-w-full divide-y divide-gray-700">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">Tým</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Datum přestupu</th>
                                            </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-800">
                                            @foreach($player->transfers as $team)
                                                <tr>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">{{ $team->name }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">{{ \Carbon\Carbon::createFromDate($team->pivot->date_of_transfer)->format('j.n.Y') }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">    <a href="{{ route('team.detail', $team->id) }}">Detail</a></td>


                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        @endif

    </div>

</x-app.app>
