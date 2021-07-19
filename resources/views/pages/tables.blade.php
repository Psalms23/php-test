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
                                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#exportModal">
                                  Search
                                </button>
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
                                        <th>Games exarted</th>
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
                                        <th>Assiexs</th>
                                        <th>exeals</th>
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
                                    @foreach($exports as $ex)
                                    <tr>
                                        <td>{{ $ex->player_name }}</td>
                                        <td>{{ $ex->age }}</td>
                                        <td>{{ $ex->games }}</td>
                                        <td>{{ $ex->games_started }}</td>
                                        <td>{{ $ex->minutes_played }}</td>
                                        <td>{{ $ex->field_goals }}</td>
                                        <td>{{ $ex->field_goals_attempted }}</td>
                                        <td>{{ $ex->{'3pt'} }}</td>
                                        <td>{{ $ex->{'3pt_attempted'} }}</td>
                                        <td>{{ $ex->{'2pt'} }}</td>
                                        <td>{{ $ex->{'2pt_attempted'} }}</td>
                                        <td>{{ $ex->free_throws }}</td>
                                        <td>{{ $ex->free_throws_attempted }}</td>
                                        <td>{{ $ex->offensive_rebounds }}</td>
                                        <td>{{ $ex->defensive_rebounds }}</td>
                                        <td>{{ $ex->assists }}</td>
                                        <td>{{ $ex->steals }}</td>
                                        <td>{{ $ex->blocks }}</td>
                                        <td>{{ $ex->turn_overs }}</td>
                                        <td>{{ $ex->personal_fouls }}</td>
                                        <td>{{ $ex->{'2pt'} + $ex->{'3pt'} + $ex->free_throws }}</td>
                                        <td>{{ ($ex->field_goals * 100) / $ex->field_goals_attempted }}</td>
                                        <td>{{ ($ex->{'3pt'} != 0 ) ? ($ex->{'3pt'} * 100) / $ex->{'3pt_attempted'} : 0 }}</td>
                                        <td>{{ ($ex->{'2pt'} != 0 ) ? ($ex->{'2pt'} * 100) / $ex->{'2pt_attempted'} : 0 }}</td>
                                        <td>{{ ($ex->free_throws != 0) ? ($ex->free_throws * 100) / $ex->free_throws_attempted : 0 }}</td>
                                        <td>{{ $ex->defensive_rebounds + $ex->offensive_rebound }}</td>
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

@push('modals')
<!-- The Modal -->
<div class="modal" id="exportModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Export Options</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <form>
           <div class="form-group">
            <label>Team</label>
            <select class="form-control" name="team">
                <option value="null" selected>All</option>
                @foreach($teams as $team)
                <option value="{{$team->name}}">{{ $team->name }}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Player</label>
            <select class="form-control" name="player">
                <option value="null" selected>All</option>
                @foreach($rosters as $ros)
                <option value="{{$ros->name}}">{{ $ros->name }}</option>
                @endforeach              
            </select>
          </div>
           <div class="form-group">
            <label>Position</label>
            <select class="form-control" name="pos">
                <option value="null" selected>All</option>
                @foreach($pos as $p)
                <option value="{{$p->pos}}">{{ $p->pos }}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>File type</label>
            <select class="form-control" name="type">
                <option value="json">json</option>
                <option value="xml">xml</option>
                <option value="csv">csv</option>
            </select>
            <button type="submit" class="btn btn-danger">Export</button>
          </div>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
@endpush