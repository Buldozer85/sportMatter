<?php

use App\Modules\Users\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

if (! function_exists('user')) {
    function user(): User
    {
        return Auth::user();
    }
}

if(!function_exists('getDayName')) {
    function getDayName (Carbon $date): string {
        $days = ['Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota'];

        return $days[$date->dayOfWeek];

    }
}

if(!function_exists('merge_arrays_preserve_keys')) {
    function merge_arrays_preserve_keys (array $array1, array $array2): array
    {
        foreach ($array1 as $key => $value) {
            $array1[$key] = [$value];
        }

        $result = $array1;

        foreach ($array2 as $key => $value) {
            if (array_key_exists($key, $result)) {
                // Pokud klíč již existuje, sloučíme hodnoty do pole
                if (!is_array($result[$key])) {
                    $result[$key] = [$result[$key]];
                }
                $result[$key][] = $value;
            } else {
                // Pokud klíč neexistuje, přidáme ho s odpovídající hodnotou
                $result[$key][] = $value;
            }

        }
        return $result;
    }
}
