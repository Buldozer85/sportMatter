<div>
    <div class="flex flex-row gap-5">
        <div class="w-full">
            <x-admin.forms.select
                label="Liga"
                id="league"
                name="league"
                :options="$leaguesOptions"
                wire:model.live="selectedLeague"
            />
        </div>
    </div>
    <div x-data="{ teamCount: {{ $leagueTeams->count() === 0 ? 1 : $leagueTeams->count()}} }">
        <div class="flex flex-row gap-5"/>
            <div class="w-full" x-ref="teamContainer">
                @empty($teamOptions)
                    <p class="mt-2 text-sm text-red-600">Pro danou ligu není založený žádný tým!</p>
                @else
                    @if(!empty($leagueTeams->first()))

                        @foreach($leagueTeams as $leagueTeam)
                            <x-admin.forms.select
                                label="Tým"
                                id="teams"
                                name="teams[]"
                                :options="$teamOptions"
                                :selected="$leagueTeam->id"
                            />
                        @endforeach
                    @else

                        <x-admin.forms.select
                            label="Tým"
                            id="teams"
                            name="teams[]"
                            :options="$teamOptions"
                        />
                    @endif
                @endempty


            </div>
        </div>
        <div class="mt-3">
            <button type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 @empty($teamOptions) !hidden @endempty" @click="teamCount++; $refs.teamContainer.appendChild($refs.teamContainer.children[0].cloneNode(true))"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </button>
            <button x-show="teamCount >= 2" type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="$refs.teamContainer.removeChild($refs.teamContainer.lastElementChild); teamCount--" x-ref="removeBtn" style="display: none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                </svg>
            </button>

        </div>
    </div>
</div>
