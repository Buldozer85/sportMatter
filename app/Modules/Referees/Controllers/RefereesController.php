<?php

declare(strict_types=1);

namespace App\Modules\Referees\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RefereeRequest;
use App\Modules\Referees\Models\Referee;
use App\Modules\Sports\Models\Sport;

final class RefereesController extends Controller
{
    public function create(RefereeRequest $request)
    {
        $referee = new Referee();
        $referee->first_name = $request->get('first_name');
        $referee->last_name = $request->get('last_name');
        $referee->sport_id = $request->get('sport');

        $referee->save();

        return redirect()->route('admin.referees.show-update', $referee->id);
    }

    public function showCreate()
    {
        $sports = Sport::all();

        $options = [];

        foreach ($sports as $sport) {
            $options[$sport->id] = $sport->name;
        }

        return view('admin.referees.new')->with(['sportsOptions' => $options]);
    }

    public function showUpdate(Referee $referee)
    {
        $sports = Sport::all();

        $options = [];

        foreach ($sports as $sport) {
            $options[$sport->id] = $sport->name;
        }

        return view('admin.referees.update')->with(['referee' => $referee, 'sportsOptions' => $options]);
    }

    public function update(Referee $referee, RefereeRequest $request)
    {
        $referee->first_name = $request->get('first_name');
        $referee->last_name = $request->get('last_name');
        $referee->sport_id = $request->get('sport');

        $referee->save();

        return redirect()->route('admin.referees.show-update', $referee->id);
    }
}
