<?php

namespace App\Modules\Stadiums\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCountryRequest;
use App\Http\Requests\StadiumRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Modules\Countries\Models\Country;
use App\Modules\Stadiums\Models\Stadium;

class StadiumsController extends Controller
{
    public function create(StadiumRequest $request)
    {
       $stadium = new Stadium();
       $stadium->name = $request->get('name');
       $stadium->capacity = $request->get('capacity');

        $stadium->save();

       return redirect()->route('admin.stadiums.show-update', $stadium->id);
    }

    public function showCreate()
    {
        return view('admin.stadiums.new');
    }

    public function showUpdate(Stadium $stadium)
    {
        return view('admin.stadiums.update')->with(['stadium' => $stadium]);
    }

    public function update(Stadium $stadium, StadiumRequest $request)
    {
        $stadium->name = $request->get('name');
        $stadium->capacity = $request->get('capacity');

        $stadium->save();

        return redirect()->route('admin.stadiums.show-update', $stadium->id);
    }
}
