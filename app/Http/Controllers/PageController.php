<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Team;
use App\Models\Roster;
use App\Models\PlayerTotals;
use LSS\Array2Xml;

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
        try {
            //base query for export page
            $query = Roster::join('player_totals', 'player_totals.player_id', '=', 'roster.id')
                    ->join('team', 'team.code', '=', 'roster.team_code');
            if($request->has('team') || $request->has('player') || $request->has('position')){

                $query->when(request('team') != 'null', function($q) use ($request){
                    return $q->where('team.name', $request->team);
                });
                $query->when(request('player') != 'null', function($q) use ($request){
                    return $q->where('roster.name', $request->player);
                });
                $query->when(request('pos') != 'null', function($q) use ($request){
                    return $q->where('roster.pos', $request->pos);
                });

                $data = $query->orderBy('player_name', 'ASC')->get(['roster.name as player_name', 'roster.*', 'player_totals.*', 'team.*']);

                switch ($request->type) {
                    case 'json':
                        return $data;
                        break;
                    case 'csv':
                        $csv = $this->array2csv($data->toArray());
                        return response($csv,200)->header("Content-type","text/csv")
                            ->header('Content-Disposition',' attachment; filename="NBAstats.csv";');
                    case 'xml':
                        $arr['title'] = 'NBA Statistics';
                        $arr['players'] = $data->toArray();
                        // dd($arr);
                        $xml = $this->createXML($arr);
                        echo $xml;
                        break;
                    default:
                        #
                        break;
                }

            }

            //default exports query for html data
            $exports = $query->orderBy('player_name', 'ASC')->get(['roster.name as player_name', 'roster.*', 'player_totals.*', 'team.*']);

            //get all teams with the roster
            $teams = Team::with('roster')->get();
            
            //top shooting teams query
            $topShootingTeams = $teams->map(function($q){
                $data['name'] = $q->name;
                $data['points'] = $q->roster->sum('stats.3pt');

                return $data;
            });

            //get all rosters query
            $rosters = Roster::orderBy('name', 'ASC')->get();

            //get all player stats by 3pt DESC
            $stats = PlayerTotals::orderBy('3pt', 'DESC')->get();

            //get all player positions
            $pos = Roster::groupBy('pos')->get('pos');

            //dynamic page renderer
            if (view()->exists("pages.{$page}")) {
                return view("pages.{$page}")->with(
                    [
                        'teams' => $teams,
                        'rosters' => $rosters,
                        'stats' => $stats,
                        'topShootingTeams' => $topShootingTeams->sortByDesc('points'),
                        'pos' => $pos,
                        'exports' => $exports
                    ]
                );
            }

            return abort(404); 
        } catch (Exception $e) {
            return dd($e);
        }
        
    }

    public function createXML($data) {
        $title = $data['title'];
        $rowCount = count($data['players']);
        
        //create the xml document
        $xmlDoc = new \DOMDocument();
        
        $root = $xmlDoc->appendChild($xmlDoc->createElement("user_info"));
        $root->appendChild($xmlDoc->createElement("title",$title));
        $root->appendChild($xmlDoc->createElement("totalRows",$rowCount));
        $tabPlayers = $root->appendChild($xmlDoc->createElement('rows'));
        
        foreach($data['players'] as $player){
            if(!empty($player)){
                $tabPlayer = $tabPlayers->appendChild($xmlDoc->createElement('player'));
                foreach($player as $key=>$val){
                    // fix any keys starting with numbers
                    $keyMap = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
               
                    $key = preg_replace_callback('(\d)', function($matches) use ($keyMap) {
                        return $keyMap[$matches[0]] . '_';
                    }, $key);
            
                    $tabPlayer->appendChild($xmlDoc->createElement($key, $val));
                }

            }
        }
        
        header("Content-Type: text/xml");
        
        //make the output pretty
        $xmlDoc->formatOutput = true;
        
        //save xml file
        $file_name = str_replace(' ', '_',$title).'_'.time().'.xml';
        $xmlDoc->save($file_name);
        
        //return xml file name
        return $file_name;
    }

    public function array2csv($data, $delimiter = ',', $enclosure = '"', $escape_char = "\\")
    {
        $f = fopen('php://memory', 'r+');
        foreach ($data as $item) {
            fputcsv($f, $item, $delimiter, $enclosure, $escape_char);
        }
        rewind($f);
        return stream_get_contents($f);
    }
}
