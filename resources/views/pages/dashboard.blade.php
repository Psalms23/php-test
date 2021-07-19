@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Teams</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        Code
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    
                                </thead>
                                <tbody>
                                    @foreach($teams as $team)
                                    <tr>
                                        <td>
                                            {{ $team->code }}
                                        </td>
                                        <td>
                                            <a href="#">{{ $team->name }}</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header">
                        <h4 class="card-title"> Report 1</h4>
                        <p class="card-category"> Top 3pt shooters</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        Name
                                    </th>
                                    <th class="text-left">
                                        3PT
                                    </th>
                                    <th class="text-left">
                                        Team
                                    </th>
                                    <th class="text-left">
                                        POS
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach($stats as $stat)
                                    <tr>
                                        <td>
                                            {{ $stat->roster($stat->player_id)->name }} 
                                        </td>
                                        <td class="text-left">
                                            {{ $stat->{'3pt'} }}
                                        </td>
                                        <td class="text-left">
                                            {{ $stat->roster($stat->player_id)->team->name }}
                                        </td>
                                        <td>
                                            {{  $stat->roster($stat->player_id)->pos }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header">
                        <h4 class="card-title"> Report 2</h4>
                        <p class="card-category"> Top 3pt shooting team</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        Team
                                    </th>
                                    <th>
                                        Total 3PT
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach($topShootingTeams as $team)
                                    <tr>
                                        <td>{{ $team['name'] }}</td>
                                        <td>{{ $team['points'] }}</td>
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
