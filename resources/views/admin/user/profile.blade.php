<x-admin.layouts.dashboard title="Profil uživatele">
    <div class="space-y-10 divide-y divide-gray-900/10">
        <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 max-w-2xl mx-auto">
            <form action="" method="POST" class="profileAdmin profile shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                <div class="flex justify-center items-center mt-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-14 h-14">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
                <h1 class="text-xl font-bold mt-2 text-center text-white">Profil uživatele</h1>
                <h2 class="text-center mt-1">{{user()->full_name}}</h2>
                @csrf
                <div class="px-4 py-6 sm:p-8">
                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <x-admin.forms.input label="Jméno" name="first_name" id="first_name" placeholder="Pepa" required value="{{user()->getFirstName()}}"/>
                        </div>

                        <div class="sm:col-span-3">
                            <x-admin.forms.input label="Příjmení" name="last_name" id="last_name" placeholder="Jandač" required value="Jandač"/>
                        </div>

                        <div class="sm:col-span-6">
                            <x-admin.forms.input label="E-mail" name="email" id="email" placeholder="pepa@seznam.cz" required value="pepa@seznam.cz"/>
                        </div>

                        <div class="sm:col-span-3">
                            <x-admin.forms.input label="Heslo" name="password" id="password" required type="password"/>
                        </div>

                        <div class="sm:col-span-3">
                            <x-admin.forms.input label="Heslo znovu" name="password_confirmation" id="password_confirmation" required type="password"/>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                    <button type="button" class="text-sm font-semibold leading-6">Zpět</button>
                    <button class="text-sm font-semibold leading-6" type="submit">Uložit</button>
                </div>
            </form>
        </div>
    </div>
</x-admin.dashboard_link>
