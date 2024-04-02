<x-admin::layouts.dashboard title="Vytvoření uživatele">
    <form method="post">
        <h1 class="text-center font-bold text-xl">Vytvoření uživatele</h1>
        <div class="flex flex-col mb-4 mt-5">
        <div class="flex flex-row gap-5">
            <div class="w-6/12"><x-admin.forms.input type="text" name="first_name" id="first_name" label="Jméno"/></div>
                <div class="w-6/12"><x-admin.forms.input type="text" name="last_name" id="last_name" label="Přijmení"/></div>
        </div>
        <div class="flex flex-row gap-5">
            <div class="w-6/12"><x-admin.forms.input type="email" name="email" id="email" label="Email"/></div>
            <div class="w-6/12"><x-admin.forms.input type="password" name="password" id="password" label="Heslo"/></div>
        </div>
        <div class="flex flex-row gap-5">
            <div class="w-full">
            <x-admin.forms.select
                label="Role"
                id="role"
                name="role"
                :options="[
                    'superadministrator' => 'Super Administrátor',
                    'administrator' => 'Administrátor',
                    'editor' => 'Editor',
                    'user' => 'User',
                  ]"
            />
        </div>
        </div>
            <div class="flex justify-center mt-5 ">
                <button type="button" class="w-fit px-32 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Vytvořit</button>
            </div>
            </div>
    </form>
</x-admin::layouts.dashboard>
