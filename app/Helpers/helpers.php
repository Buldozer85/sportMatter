<?php

use App\Modules\Users\Models\User;
use Illuminate\Support\Facades\Auth;

if (! function_exists('user')) {
    function user(): User
    {
        return Auth::user();
    }
}
