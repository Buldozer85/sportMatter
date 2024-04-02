<?php

namespace App\Modules\Countries\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Modules\Countries\Models\Country;

class CountriesController extends Controller
{
    public function create(CreateCountryRequest $request)
    {
       $country = new Country();
       $country->name = $request->get('name');
       $country->short_name = $request->get('short_name');

        $country->save();

       return redirect()->route('admin.countries.show-update', $country->id);
    }

    public function showCreate()
    {
        return view('admin.countries.new');
    }

    public function showUpdate(Country $country)
    {
        return view('admin.countries.update')->with(['country' => $country]);
    }

    public function update(Country $country, UpdateCountryRequest $request)
    {
        $country->name = $request->get('name');
        $country->short_name = $request->get('short_name');

        $country->save();

        return redirect()->route('admin.countries.show-update', $country->id);
    }
}
