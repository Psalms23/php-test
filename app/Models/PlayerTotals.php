<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Roster;
class PlayerTotals extends Model
{
    use HasFactory;

    protected $fillable = [
    	'player_id',
		'age',
		'games',
		'games_started',
		'minutes_played',
		'field_goals',
		'field_goals_attempted',
		'3pt',
		'3pt_attempted',
		'2pt',
		'2pt_attempted',
		'free_throws',
		'free_throws_attempted',
		'offensive_rebounds',
		'defensive_rebounds',
		'assists',
		'steals',
		'blocks',
		'turnovers',
		'personal_fouls'
    ];

     public function roster($playerId){
        return Roster::where('id', $playerId)->first();
    }

}
