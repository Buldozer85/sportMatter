<?php

namespace App\Modules\Seasons\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSeasonRequest;
use App\Http\Requests\UpdateSeasonRequest;
use App\Modules\Leagues\Models\League;
use App\Modules\Seasons\Models\Season;
use Illuminate\Support\Facades\DB;


class SeasonsController extends Controller
{
    public function create(CreateSeasonRequest $request)
    {
        $seasonId = null;

        DB::beginTransaction();

        try {
            $season = new Season();
            $season->yearStart = $request->get('yearStart');
            $season->yearEnd = $request->get('yearEnd');
            $season->league_id = $request->get('league');

            $season->save();

            foreach ($request->get('teams') as $team) {
                $season->teams()->attach($team);
            }

            $seasonId = $season->id;

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['create-error' => 'Při vytváření sezóny došlo k chybě']);
        }

        DB::commit();

        return redirect()->route('admin.seasons.show-update', $seasonId);

    }

    public function showCreate()
    {

        return view('admin.seasons.new');
    }

    public function showUpdate(Season $season)
    {


        return view('admin.seasons.update')->with(['season' => $season]);
    }

    public function update(Season $season, UpdateSeasonRequest $request)
    {
        DB::beginTransaction();

        try {
            $season->yearStart = $request->get('yearStart');
            $season->yearEnd = $request->get('yearEnd');
            $season->league_id = $request->get('league');

            $season->save();

            $season->teams()->detach();

            foreach ($request->get('teams') as $team) {
                $season->teams()->attach($team);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['create-error' => 'Při vytváření sezóny došlo k chybě']);
        }

        DB::commit();

        return redirect()->route('admin.seasons.show-update', $season->id);

    }
}
