<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roster extends Model
{
    use HasFactory;
    
    protected $table = 'roster';

    protected $fillable = [
    	'team_code',
    	'number',
    	'name',
    	'pos',
    	'height',
    	'weight',
    	'dob',
    	'nationality',
    	'years_exp',
    	'college'
    ];

    public function team(){
    	return $this->belongsTo('App\Models\Team', 'team_code', 'code');
    }
}
