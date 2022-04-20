@extends('layouts.app')

@section('title', $league['name'])

@section('css')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>RESULTADOS</h2>
    <table class="table">
        <thead>
            <tr class="text-center">
                <th>FECHA</th>
                <th>LOCAL</th>
                <th>RESULTADO</th>
                <th>VISITANTE</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rounds as $round)
            <tr class="text-center">
                <td>{{ date('j F, Y', strtotime($round['fixture']['date'])) }}</td>
                <td class="text-rigth">
                    {{ $round['teams']['home']['name'] }}
                    <a style="text-decoration: none; color: black;">
                        <img src="{{ $round['teams']['home']['logo'] }}" alt="{{ $round['teams']['home']['name'] }}" style="width: 25px; height: 25px;">
                    </a>
                </td>
                <td>{{ $round['goals']['home'] }} - {{ $round['goals']['away'] }}</td>
                <td class="text-left">
                    <a style="text-decoration: none; color: black;">
                        <img src="{{ $round['teams']['away']['logo'] }}" alt="{{ $round['teams']['away']['name'] }}" style="width: 25px; height: 25px;">
                    </a>
                    {{ $round['teams']['away']['name'] }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="container">
    <h2>CLASIFICACION</h2>
    <table class="table">
        <thead>
            <tr class="text-center">
                <th></th>
                <th style="text-align: left;">Equipos</th>
                <th>Puntos</th>
                <th>J.</th>
                <th>G.</th>
                <th>E.</th>
                <th>P.</th>
                <th>G.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ranking[0] as $team)
            <tr class="text-center">

                @switch($team['rank'])
                @case(1) @case(2) @case(3) @case(4)
                <td>
                    <div class="bg-primary redondeo">
                        {{ $team['rank'] }}.
                    </div>
                </td>
                @break
                @case(5)
                <td>
                    <div class="bg-danger redondeo">
                        {{ $team['rank'] }}.
                    </div>
                </td>
                @break
                @case(6)
                <td>
                    <div class="bg-warning redondeo">
                        {{ $team['rank'] }}.
                    </div>
                </td>
                @break
                @case(count($ranking[0])-2) @case(count($ranking[0])-1) @case(count($ranking[0]))
                <td>
                    <div style="background-color: #ff0000;" class="redondeo">
                        {{ $team['rank'] }}.
                    </div>
                </td>
                @break
                @default
                <td>
                    {{ $team['rank'] }}.
                </td>
                @endswitch

                <td class="text-left">
                    <a style="text-decoration: none; color: black;" href="/equipo/{{ $team['team']['id'] }}">
                        <img src="{{ $team['team']['logo'] }}" alt="{{ $team['team']['name'] }}" style="width: 25px; height: 25px;">
                        {{ $team['team']['name'] }}
                    </a>
                </td>

                <th>{{ $team['points'] }}</th>
                <td>{{ $team['all']['played'] }}</td>
                <td>{{ $team['all']['win'] }}</td>
                <td>{{ $team['all']['draw'] }}</td>
                <td>{{ $team['all']['lose'] }}</td>
                <td>{{ $team['all']['goals']['for'] }}:{{ $team['all']['goals']['against'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="container">
    <div class="bg-white border rounded">
        <h2>DESTACADOS</h2>
        <nav class="navbar">
            <div>
                <ul class="nav nav-tabs">
                    <li id="goles" class="nav-item">
                        <a class="nav-link active" href="#">GOLES</a>
                    </li>
                    <li id="asistencias" class="nav-item">
                        <a class="nav-link active" href="#">ASISTENCIAS</a>
                    </li>
                    <li id="amarillas" class="nav-item">
                        <a class="nav-link active" href="#">TAR. AMARILLAS</a>
                    </li>
                    <li id="rojas" class="nav-item">
                        <a class="nav-link active" href="#">TAR. ROJAS</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="tgoles">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th></th>
                        <th>Nombre</th>
                        <th>Goles</th>
                        <th>Posicion</th>
                        <th>Equipo</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < $goals->count(); $i++)
                    <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td>
                                <a style="text-decoration: none; color: black;">
                                    <img src="{{ $goals[$i]['player']['photo'] }}" alt="{{ $goals[$i]['player']['name'] }}" style="width: 35px; height: 35px;">
                                </a>
                                {{ $goals[$i]['player']['name'] }}
                            </td>
                            <th class="text-center">{{ $goals[$i]['statistics'][0]['goals']['total'] }}</th>
                            <td class="text-center">{{ $goals[$i]['statistics'][0]['games']['position'] }}</td>
                            <td>
                                {{ $goals[$i]['statistics'][0]['team']['name'] }}
                                <a style="text-decoration: none; color: black;">
                                    <img src="{{ $goals[$i]['statistics'][0]['team']['logo'] }}" alt="{{ $goals[$i]['statistics'][0]['team']['name'] }}" style="width: 25px; height: 25px;">
                                </a>
                            </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <div id="tasistencias" class="d-none">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th></th>
                        <th>Nombre</th>
                        <th>Asistencias</th>
                        <th>Posicion</th>
                        <th>Equipo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assists as $player)
                    <tr>
                            <td class="text-center">{{ $i }}</td>
                            <td>
                                <a style="text-decoration: none; color: black;">
                                    <img src="{{ $player['player']['photo'] }}" alt="{{ $player['player']['name'] }}" style="width: 35px; height: 35px;">
                                </a>
                                {{ $player['player']['name'] }}
                            </td>
                            <th class="text-center">{{ $player['statistics'][0]['goals']['assists'] }}</th>
                            <td class="text-center">{{ $player['statistics'][0]['games']['position'] }}</td>
                            <td>
                                {{ $player['statistics'][0]['team']['name'] }}
                                <a style="text-decoration: none; color: black;">
                                    <img src="{{ $player['statistics'][0]['team']['logo'] }}" alt="{{ $player['statistics'][0]['team']['name'] }}" style="width: 25px; height: 25px;">
                                </a>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--
        <div id="tamarillas" class="d-none">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th></th>
                        <th>Nombre</th>
                        <th>Amarillas</th>
                        <th>Posicion</th>
                        <th>Equipo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($yellowcards as $player)
                    <tr>
                            <td class="text-center">{{ $i }}</td>
                            <td>
                                <a style="text-decoration: none; color: black;">
                                    <img src="{{ $player['player']['photo'] }}" alt="{{ $player['player']['name'] }}" style="width: 35px; height: 35px;">
                                </a>
                                {{ $player['player']['name'] }}
                            </td>
                            <th class="text-center">{{ $player['statistics'][0]['cards']['yellow'] }}</th>
                            <td class="text-center">{{ $player['statistics'][0]['games']['position'] }}</td>
                            <td>
                                {{ $player['statistics'][0]['team']['name'] }}
                                <a style="text-decoration: none; color: black;">
                                    <img src="{{ $player['statistics'][0]['team']['logo'] }}" alt="{{ $player['statistics'][0]['team']['name'] }}" style="width: 25px; height: 25px;">
                                </a>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="trojas" class="d-none">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th></th>
                        <th>Nombre</th>
                        <th>Rojas</th>
                        <th>Posicion</th>
                        <th>Equipo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($redcards as $player)
                    <tr>
                            <td class="text-center">{{ $i }}</td>
                            <td>
                                <a style="text-decoration: none; color: black;">
                                    <img src="{{ $player['player']['photo'] }}" alt="{{ $player['player']['name'] }}" style="width: 35px; height: 35px;">
                                </a>
                                {{ $player['player']['name'] }}
                            </td>
                            <th class="text-center">{{ $player['statistics'][0]['cards']['red'] }}</th>
                            <td class="text-center">{{ $player['statistics'][0]['games']['position'] }}</td>
                            <td>
                                {{ $player['statistics'][0]['team']['name'] }}
                                <a style="text-decoration: none; color: black;">
                                    <img src="{{ $player['statistics'][0]['team']['logo'] }}" alt="{{ $player['statistics'][0]['team']['name'] }}" style="width: 25px; height: 25px;">
                                </a>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        -->
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/app.js') }}"></script>
@endsection