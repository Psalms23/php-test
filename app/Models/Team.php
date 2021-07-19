<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'team';

    protected $fillable = ['code', 'name'];

    public function roster(){
    	return $this->hasMany('App\Models\Roster', 'team_code');
    }
}
