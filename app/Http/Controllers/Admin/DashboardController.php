<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function users()
    {
        return view('admin.users.index');
    }

    public function countries()
    {
        return view('admin.countries.index');
    }

    public function games()
    {
        return view('admin.games.index');
    }

    public function leagues()
    {
        return view('admin.leagues.index');
    }

    public function players()
    {
        return view('admin.players.index');
    }

    public function referees()
    {
        return view('admin.referees.index');
    }

    public function seasons()
    {
        return view('admin.seasons.index');
    }

    public function sports()
    {
        return view('admin.sports.index');
    }

    public function stadiums()
    {
        return view('admin.stadiums.index');
    }

    public function teams()
    {
        return view('admin.teams.index');
    }
}
