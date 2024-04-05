@props([
    'text' => ''
])
    <div class="addition-content w-1/6 p-3">
        <h2 class="font-bold text-xl">{{$text}}</h2>
        <div class="list-of-leagues">
            {{ $slot }}
        </div>
    </div>

