@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'tables'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="card-title"> Export Query </h4>
                            </div>
                           <div class="col-md-4">
                                <form class="pull-left">
                                    <div class="input-group no-border">
                                        <input type="text" value="" class="form-control" placeholder="Search...">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="nc-icon nc-zoom-split"></i>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                           </div>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Games</th>
                                        <th>Games Started</th>
                                        <th>Minutes Played</th>
                                        <th>Field Goals</th>
                                        <th>Field Goals Attempted</th>
                                        <th>3pt</th>
                                        <th>3pt Attempted</th>
                                        <th>2pt</th>
                                        <th>2pt Attempted</th>
                                        <th>Free Throws</th>
                                        <th>Free Throws Attempted</th>
                                        <th>Offensive Rebounds</th>
                                        <th>Defensive Rebounds</th>
                                        <th>Assists</th>
                                        <th>Steals</th>
                                        <th>Blocks</th>
                                        <th>Turnovers</th>
                                        <th>Personal Fouls</th>
                                        <th>Total Points</th>
                                        <th>Field Goals Pct</th>
                                        <th>3pt Pct</th>
                                        <th>2pt Pct</th>
                                        <th>Free Throws Pct</th>
                                        <th>Total Rebounds</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stats as $st)
                                    <tr>
                                        <td>{{ $st->roster($st->player_id)->name }}</td>
                                        <td>{{ $st->age }}</td>
                                        <td>{{ $st->games }}</td>
                                        <td>{{ $st->games_started }}</td>
                                        <td>{{ $st->minutes_played }}</td>
                                        <td>{{ $st->field_goals }}</td>
                                        <td>{{ $st->field_goals_attempted }}</td>
                                        <td>{{ $st->{'3pt'} }}</td>
                                        <td>{{ $st->{'3pt_attempted'} }}</td>
                                        <td>{{ $st->{'2pt'} }}</td>
                                        <td>{{ $st->{'2pt_attempted'} }}</td>
                                        <td>{{ $st->free_throws }}</td>
                                        <td>{{ $st->free_throws_attempted }}</td>
                                        <td>{{ $st->offensive_rebounds }}</td>
                                        <td>{{ $st->defensive_rebounds }}</td>
                                        <td>{{ $st->assists }}</td>
                                        <td>{{ $st->steals }}</td>
                                        <td>{{ $st->blocks }}</td>
                                        <td>{{ $st->turn_overs }}</td>
                                        <td>{{ $st->personal_fouls }}</td>
                                        <td>{{ $st->{'2pt'} + $st->{'3pt'} + $st->free_throws }}</td>
                                        <td>{{ ($st->field_goals * 100) / $st->field_goals_attempted }}</td>
                                        <td>{{ ($st->{'3pt'} != 0 ) ? ($st->{'3pt'} * 100) / $st->{'3pt_attempted'} : 0 }}</td>
                                        <td>{{ ($st->{'2pt'} != 0 ) ? ($st->{'2pt'} * 100) / $st->{'2pt_attempted'} : 0 }}</td>
                                        <td>{{ ($st->free_throws != 0) ? ($st->free_throws * 100) / $st->free_throws_attempted : 0 }}</td>
                                        <td>{{ $st->defensive_rebounds + $st->offensive_rebound }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection