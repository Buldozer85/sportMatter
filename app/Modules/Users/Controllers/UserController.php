<?php

namespace App\Modules\Users\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Modules\Users\Models\User;
use http\Env\Request;

class UserController extends Controller
{
    public function create(CreateUserRequest $request)
    {
        // TODO: Implement create() method.
    }

    public function update(User $model, UpdateUserRequest $request)
    {
        // TODO: Implement update() method.
    }

    public function delete(User $model, Request $request)
    {
        // TODO: Implement delete() method.
    }
}
