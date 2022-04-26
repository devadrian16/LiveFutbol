@extends('layouts.api')

@section('title', $league['name'])

@section('css')
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="card my-4">
        <div class="card-header">JORNADAS</div>

        <div class="card-body">
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
                    <tr>
                        <td class="text-center">{{ date('j F, Y', strtotime($round['fixture']['date'])) }}</td>
                        <td class="text-end">
                            {{ $round['teams']['home']['name'] }}
                            <a style="text-decoration: none; color: black;">
                                <img src="{{ $round['teams']['home']['logo'] }}" alt="{{ $round['teams']['home']['name'] }}" style="width: 25px; height: 25px;">
                            </a>
                        </td>
                        <td class="text-center">{{ $round['goals']['home'] }} - {{ $round['goals']['away'] }}</td>
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
    </div>
</div>

<div class="container">
    <div class="card my-4">
        <div class="card-header">CLASIFICACION</div>

        <div class="card-body">
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
                    <tr>

                        @switch($team['rank'])
                        @case(1) @case(2) @case(3) @case(4)
                        <td class="text-center">
                            <div class="bg-primary redondeo">
                                {{ $team['rank'] }}.
                            </div>
                        </td>
                        @break
                        @case(5)
                        <td class="text-center">
                            <div class="bg-danger redondeo">
                                {{ $team['rank'] }}.
                            </div>
                        </td>
                        @break
                        @case(6)
                        <td class="text-center">
                            <div class="bg-warning redondeo">
                                {{ $team['rank'] }}.
                            </div>
                        </td>
                        @break
                        @case(count($ranking[0])-2) @case(count($ranking[0])-1) @case(count($ranking[0]))
                        <td class="text-center">
                            <div style="background-color: #ff0000;" class="redondeo">
                                {{ $team['rank'] }}.
                            </div>
                        </td>
                        @break
                        @default
                        <td class="text-center">
                            {{ $team['rank'] }}.
                        </td>
                        @endswitch

                        <td class="text-left">
                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $team['team']['id'] }}">
                                <img src="{{ $team['team']['logo'] }}" alt="{{ $team['team']['name'] }}" style="width: 25px; height: 25px;">
                                {{ $team['team']['name'] }}
                            </a>
                        </td>

                        <th class="text-center">{{ $team['points'] }}</th>
                        <td class="text-center">{{ $team['all']['played'] }}</td>
                        <td class="text-center">{{ $team['all']['win'] }}</td>
                        <td class="text-center">{{ $team['all']['draw'] }}</td>
                        <td class="text-center">{{ $team['all']['lose'] }}</td>
                        <td class="text-center">{{ $team['all']['goals']['for'] }}:{{ $team['all']['goals']['against'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container">
    <div class="card my-4">
        <div class="card-header">
            DESTACADOS
            <nav class="navbar navbar-expand-lg navbar-light bg-light my-0">
                <div>
                    <ul class="nav">
                        <li id="goles" class="nav-item activo">
                            <a style="color: black;" class="nav-link" href="#">GOLES</a>
                        </li>
                        <li id="asistencias" class="nav-item">
                            <a style="color: black;" class="nav-link" href="#">ASISTENCIAS</a>
                        </li>
                        <li id="amarillas" class="nav-item">
                            <a style="color: black;" class="nav-link" href="#">TAR. AMARILLAS</a>
                        </li>
                        <li id="rojas" class="nav-item">
                            <a style="color: black;" class="nav-link" href="#">TAR. ROJAS</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="card-body">
            <div id="tgoles">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-left">Nombre</th>
                            <th class="text-center">Goles</th>
                            <th class="text-center">Posicion</th>
                            <th class="text-left">Equipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($goals); $i++) <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
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
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-left">Nombre</th>
                            <th class="text-center">Asistencias</th>
                            <th class="text-center">Posicion</th>
                            <th class="text-left">Equipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($assists); $i++) <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>
                                <a style="text-decoration: none; color: black;">
                                    <img src="{{ $assists[$i]['player']['photo'] }}" alt="{{ $assists[$i]['player']['name'] }}" style="width: 35px; height: 35px;">
                                </a>
                                {{ $assists[$i]['player']['name'] }}
                            </td>
                            <th class="text-center">{{ $assists[$i]['statistics'][0]['goals']['assists'] }}</th>
                            <td class="text-center">{{ $assists[$i]['statistics'][0]['games']['position'] }}</td>
                            <td>
                                {{ $assists[$i]['statistics'][0]['team']['name'] }}
                                <a style="text-decoration: none; color: black;">
                                    <img src="{{ $assists[$i]['statistics'][0]['team']['logo'] }}" alt="{{ $assists[$i]['statistics'][0]['team']['name'] }}" style="width: 25px; height: 25px;">
                                </a>
                            </td>
                            </tr>
                            @endfor
                    </tbody>
                </table>
            </div>
            <div id="tamarillas" class="d-none">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-left">Nombre</th>
                            <th class="text-center">Amarillas</th>
                            <th class="text-center">Posicion</th>
                            <th class="text-left">Equipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($yellowcards); $i++) <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>
                                <a style="text-decoration: none; color: black;">
                                    <img src="{{ $yellowcards[$i]['player']['photo'] }}" alt="{{ $yellowcards[$i]['player']['name'] }}" style="width: 35px; height: 35px;">
                                </a>
                                {{ $yellowcards[$i]['player']['name'] }}
                            </td>
                            <th class="text-center">{{ $yellowcards[$i]['statistics'][0]['cards']['yellow'] }}</th>
                            <td class="text-center">{{ $yellowcards[$i]['statistics'][0]['games']['position'] }}</td>
                            <td>
                                {{ $yellowcards[$i]['statistics'][0]['team']['name'] }}
                                <a style="text-decoration: none; color: black;">
                                    <img src="{{ $yellowcards[$i]['statistics'][0]['team']['logo'] }}" alt="{{ $yellowcards[$i]['statistics'][0]['team']['name'] }}" style="width: 25px; height: 25px;">
                                </a>
                            </td>
                            </tr>
                            @endfor
                    </tbody>
                </table>
            </div>
            <div id="trojas" class="d-none">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-left">Nombre</th>
                            <th class="text-center">Rojas</th>
                            <th class="text-center">Posicion</th>
                            <th class="text-left">Equipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($redcards); $i++) <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>
                                <a style="text-decoration: none; color: black;">
                                    <img src="{{ $redcards[$i]['player']['photo'] }}" alt="{{ $redcards[$i]['player']['name'] }}" style="width: 35px; height: 35px;">
                                </a>
                                {{ $redcards[$i]['player']['name'] }}
                            </td>
                            <th class="text-center">{{ $redcards[$i]['statistics'][0]['cards']['red'] }}</th>
                            <td class="text-center">{{ $redcards[$i]['statistics'][0]['games']['position'] }}</td>
                            <td>
                                {{ $redcards[$i]['statistics'][0]['team']['name'] }}
                                <a style="text-decoration: none; color: black;">
                                    <img src="{{ $redcards[$i]['statistics'][0]['team']['logo'] }}" alt="{{ $redcards[$i]['statistics'][0]['team']['name'] }}" style="width: 25px; height: 25px;">
                                </a>
                            </td>
                            </tr>
                            @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/scriptsLigas.js') }}"></script>
@endsection