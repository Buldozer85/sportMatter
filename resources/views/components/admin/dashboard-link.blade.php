@props([
    'route',
    'isCurrent' => false
])

<li>
    <!-- Current: "bg-indigo-700 text-white", Default: "text-indigo-200 hover:text-white hover:bg-indigo-700" -->
    <a href="{{ $route }}" class="@if($isCurrent) !bg-indigo-700 !text-white @endif text-indigo-200 hover:text-white hover:bg-indigo-700 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
        {{ $slot }}
    </a>
</li>
