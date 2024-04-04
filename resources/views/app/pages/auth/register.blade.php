<x-app.app title="Registrace">
    <div class="flex min-h-screen mx-auto max-w-screen-2xl mt-12">
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <img class="h-10 w-auto" src="{{ asset('img/logo-no-background.svg') }}" alt="Your Company">
                    <h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">Vytvoř si účet</h2>
                </div>

                <div class="mt-10">
                    <div>
                        <form action="{{ route('app.register') }}" method="POST" class="space-y-6">
                            @csrf

                           <x-app.forms.input name="email" id="email" label="E-mail" type="email" required></x-app.forms.input>

                            <div class="grid grid-cols-2">
                                <x-app.forms.input name="first_name" id="first_name" label="Křestní jméno" required></x-app.forms.input>

                                <x-app.forms.input name="last_name" id="last_name" label="Příjmení" type="last_name" required></x-app.forms.input>
                            </div>

                            <div class="grid grid-cols-2">
                                <x-app.forms.input name="password" id="password" label="Heslo" type="password" required></x-app.forms.input>

                                <x-app.forms.input name="password_confirmation" id="password_confirmation" label="Heslo znovu" type="password" required></x-app.forms.input>
                            </div>



                            <div class="flex items-center justify-between">
                                <div class="text-sm leading-6">
                                    <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Zapomněli jste heslo?</a>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Vytvořit účet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block">
            <img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1496917756835-20cb06e75b4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80" alt="">
        </div>
    </div>
</x-app.app>
