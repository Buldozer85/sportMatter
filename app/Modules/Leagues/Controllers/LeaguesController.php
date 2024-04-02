<?php

declare(strict_types=1);

namespace App\Modules\Leagues\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeagueRequest;
use App\Modules\Countries\Models\Country;
use App\Modules\Leagues\Models\League;
use App\Modules\Sports\Models\Sport;

final class LeaguesController extends Controller
{
    public function create(LeagueRequest $request)
    {
        $league = new League();
        $league->name = $request->get('name');
        $league->association = $request->get('association');
        $league->sport_id = $request->get('sport');
        $league->country_id = $request->get('country');

        $league->save();

        return redirect()->route('admin.leagues.show-update', $league->id);
    }

    public function showCreate()
    {
        $sports = Sport::all();
        $countries = Country::all();

        $sportOptions = [];

        foreach ($sports as $sport) {
            $sportOptions[$sport->id] = $sport->name;
        }

        $countryOptions = [];

        foreach ($countries as $country) {
            $countryOptions[$country->id] = $country->name;
        }

        return view('admin.leagues.new')->with(['sportsOptions' => $sportOptions, 'countryOptions' => $countryOptions]);
    }

    public function showUpdate(League $league)
    {
        $sports = Sport::all();
        $countries = Country::all();

        $sportOptions = [];

        foreach ($sports as $sport) {
            $sportOptions[$sport->id] = $sport->name;
        }

        $countryOptions = [];

        foreach ($countries as $country) {
            $countryOptions[$country->id] = $country->name;
        }

        return view('admin.leagues.update')->with(['league' => $league, 'sportsOptions' => $sportOptions, 'countryOptions' => $countryOptions]);
    }

    public function update(League $league, LeagueRequest $request)
    {
        $league->name = $request->get('name');
        $league->association = $request->get('association');
        $league->sport_id = $request->get('sport');
        $league->country_id = $request->get('country');

        $league->save();

        return redirect()->route('admin.leagues.show-update', $league->id);
    }
}
