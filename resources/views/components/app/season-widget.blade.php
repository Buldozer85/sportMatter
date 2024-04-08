@props([
    'name_of_league' => '',
    'detail' => '#'
])
    <li class="relative py-5 hover:bg-gray-800 bg-gray-900">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="mx-auto flex max-w-4xl justify-between gap-x-6">
                <div class="flex min-w-0 gap-x-4">
                    <div class="min-w-0 flex-auto">
                        <p class="text-sm font-semibold leading-6 text-white">
                            <a href="{{ $detail }}">
                                <span class="absolute inset-x-0 -top-px bottom-0"></span>
                                {{ $name_of_league }}
                            </a>
                        </p>

                    </div>
                </div>
                <div class="flex shrink-0 items-center gap-x-4 text-white">
                    <div class="hidden sm:flex sm:flex-col sm:items-end">
                        <a href="{{ $detail }}" class="text-sm leading-6 text-white">Detail</a>

                    </div>
                    <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>
    </li>
