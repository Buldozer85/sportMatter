<?php

namespace App\Modules\Sports\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSportRequest;
use App\Http\Requests\UpdateSportRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Modules\Sports\Models\Sport;

class SportController extends Controller
{
    public function create(CreateSportRequest $request)
    {
       $sport = new Sport();
       $sport->name = $request->get('name');

       $sport->save();

       return redirect()->route('admin.sports.show-update', $sport->id);
    }

    public function showCreate()
    {
        return view('admin.sports.new');
    }

    public function showUpdate(Sport $sport)
    {
        return view('admin.sports.update')->with(['sport' => $sport]);
    }

    public function update(Sport $sport, UpdateSportRequest $request)
    {
        $sport->name = $request->get('name');;

        $sport->save();

        return redirect()->route('admin.sports.show-update', $sport->id);
    }
}
