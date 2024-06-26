<x-admin::layouts.dashboard title="Úprava uživatele">
    <form action="{{ route('admin.users.update', $user->id) }}" method="post">
        @csrf
        <h1 class="text-center font-bold text-xl">Úprava uživatele {{ $user->full_name }}</h1>
        <div class="flex flex-col mb-4 mt-5">
            <div class="flex flex-row gap-5">
                <div class="w-6/12">
                    <x-admin.forms.input type="text" name="first_name" id="first_name" label="Jméno" value="{{ $user->first_name }}"/>
                </div>
                <div class="w-6/12">
                    <x-admin.forms.input type="text" name="last_name" id="last_name" label="Přijmení" value="{{ $user->last_name }}"/>
                </div>
            </div>
            <div class="flex flex-row gap-5">
                <div class="w-6/12"><x-admin.forms.input type="email" name="email" id="email" label="Email" value="{{ $user->email }}"/></div>
                <div class="w-6/12">
                    <x-admin.forms.select
                        label="Role"
                        id="access"
                        name="access"
                        :options="[
                    'superadministrator' => 'Super Administrátor',
                    'administrator' => 'Administrátor',
                    'editor' => 'Editor',
                    'user' => 'User',
                  ]"
                        selected="{{ $user->access->value }}"
                    />
                </div>
            </div>
            <div class="flex flex-row gap-5">
                <div class="w-6/12"><x-admin.forms.input type="password" name="password" id="password" label="Heslo"/></div>
                <div class="w-6/12"><x-admin.forms.input type="password" name="password_confirmation" id="password_confirmation" label="Heslo znovu"/></div>
            </div>
            <div class="flex justify-center mt-5 ">
                <button type="submit"
                        class="w-fit px-32 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Upravit
                </button>
            </div>
        </div>
    </form>
</x-admin::layouts.dashboard>
