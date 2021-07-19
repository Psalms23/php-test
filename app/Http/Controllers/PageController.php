<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Roster;
use App\Models\PlayerTotals;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page, Request $request)
    {   

        $teams = Team::with('roster')->get();
        $topShootingTeams = $teams->map(function($q){
            $data['name'] = $q->name;
            $data['points'] = $q->roster->sum('stats.3pt');

            return $data;
        });
        //roster->sum('stats.3pt')
        $rosters = Roster::all();
        $stats = PlayerTotals::orderBy('3pt', 'DESC')->get();
        if (view()->exists("pages.{$page}")) {
            return view("pages.{$page}")->with(
                [
                    'teams' => $teams,
                    'rosters' => $rosters,
                    'stats' => $stats,
                    'topShootingTeams' => $topShootingTeams->sortByDesc('points')
                ]
            );
        }

        return abort(404);
    }
}
