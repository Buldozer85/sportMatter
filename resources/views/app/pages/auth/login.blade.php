<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SportMatter: Přihlášení</title>
    @vite(['resources/css/app.css'])
</head>
<body>
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Přihlásit se do svého účtu</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="{{ route('login') }}" method="POST">
            @csrf

            <div>
                <x-admin.forms.input id="email" name="email" type="email" required label="E-mail"></x-admin.forms.input>
            </div>

            <div>
                <x-admin.forms.input id="password" name="password" type="password" required label="Heslo"></x-admin.forms.input>
            </div>

            @error('login-error')
            <div>
                <p class="text-red-400">{{ $message }}</p>
            </div>
            @enderror

            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Přihlásit se</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
