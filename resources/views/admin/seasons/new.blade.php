<x-admin::layouts.dashboard title="Vytvoření sezóny">
    <form method="post">
        <h1 class="text-center font-bold text-xl">Vytvoření sezóny</h1>
        <div class="flex flex-col mb-4 mt-5">
            <div class="flex flex-row gap-5">
                <div class="w-6/12"><x-admin.forms.input type="date" name="yearStart" id="yearStart" label="Datum začátku sezóny"/></div>
                <div class="w-6/12"><x-admin.forms.input type="date" name="yearEnd" id="yearEnd" label="Datum konce sezóny"/></div>
            </div>
            <div class="flex flex-row gap-5">
                <div class="w-full">
                    <x-admin.forms.select
                        label="Liga"
                        id="league"
                        name="league"
                        :options="[
                    '1' => 'Bundesliga'
                  ]"
                    />
                </div>
            </div>
            <div x-data="{ teamCount: 1 }">
                <div class="flex flex-row gap-5"
                     x-init="$watch('teamCount', value => { if(value < 2) $refs.removeBtn.style.display = 'none'; else $refs.removeBtn.style.display = 'inline-block'; })">
                    <div class="w-full" x-ref="teamContainer">
                        <x-admin.forms.select
                                label="Tým"
                                id=""
                                name="teams[]"
                                :options="[
                    '1' => 'Real Madrid'
                ]"
                        />
                    </div>
                </div>
                <div class="mt-3">
                    <button type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="teamCount++; $refs.teamContainer.appendChild($refs.teamContainer.children[0].cloneNode(true))"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                    <button type="button" class="w-fit h-fit px-3 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" @click="$refs.teamContainer.removeChild($refs.teamContainer.lastElementChild); teamCount--" x-ref="removeBtn" style="display: none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                        </svg>
                    </button>

                </div>
            </div>

            <div class="flex justify-center mt-5 ">
                <button type="button" class="w-fit px-32 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Vytvořit</button>
            </div>
        </div>
    </form>
</x-admin::layouts.dashboard>
