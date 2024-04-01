<x-admin::layouts.dashboard title="Úprava ligy">
    <form method="post">
        <h1 class="text-center font-bold text-xl">Úprava ligy</h1>
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
                        :options="[
                    1 => 'Česká republika',
                  ]"
                    />
                </div>
                <div class="w-6/12">
                    <x-admin.forms.select
                        label="Sport"
                        id="sport"
                        name="sport"
                        :options="[
                    1 => 'Hokej',
                  ]"
                    />
                </div>
            </div>
            <div class="flex justify-center mt-5 ">
                <button type="button"
                        class="w-fit px-32 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Upravit
                </button>
            </div>
        </div>
    </form>
</x-admin::layouts.dashboard>
