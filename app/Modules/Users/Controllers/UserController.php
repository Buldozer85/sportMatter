<?php

namespace App\Modules\Users\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Modules\Users\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(CreateUserRequest $request)
    {
       $user = new User();

       $user->first_name = $request->get('first_name');
       $user->last_name = $request->get('last_name');
       $user->email = $request->get('email');
       $user->password = Hash::make($request->get('password'));
       $user->access = $request->get('access');

       $user->save();

       return redirect()->route('admin.users.show-update', $user->id);
    }

    public function showCreate()
    {
        return view('admin.users.new');
    }

    public function showUpdate(User $user)
    {
        return view('admin.users.update')->with(['user' => $user]);
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');

        if(!is_null($request->get('password'))) {
            $user->password = Hash::make($request->get('password'));
        }

        $user->access = $request->get('access');

        $user->save();

        return redirect()->route('admin.users.show-update', $user->id);
    }

    public function delete(User $model, Request $request)
    {
        // TODO: Implement delete() method.
    }
}
