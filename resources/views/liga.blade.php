@extends('layouts.api')

@section('title', 'Ligas')

@section('css')
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')

<?php
$mes = ['-', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
?>

<div class="row justify-content-around">
    @if($status['response']['requests']['current'] < 100) <div class="col-lg-6 mt-4 mb-3">
        @for($i = 0; $i < count($jornadas); $i++) <div class="card mb-3">
            <div class="card-header fs-5">Jornada {{ $rounds[$i] }}</div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            @foreach($jornadas[$i] as $match)
                            <tr>
                                <td class="col-3 text-center">{{ date('j', strtotime($match['fixture']['date'])) }} {{ $mes[date('n', strtotime($match['fixture']['date']))] }} {{ date('Y', strtotime($match['fixture']['date'])) }}</td>
                                <td class="col-3 text-end">
                                    <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                        {{ $match['teams']['home']['name'] }}
                                        <img id="logo" src="{{ $match['teams']['home']['logo'] }}" alt="">
                                    </a>
                                </td>
                                <td class="col-2 text-center">{{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}</td>
                                <td class="col-3 text-left">
                                    <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                        <img id="logo" src="{{ $match['teams']['away']['logo'] }}" alt="">
                                        {{ $match['teams']['away']['name'] }}
                                    </a>
                                </td>
                                <td class="col-1 text-end">
                                    <!-- Modal -->
                                    <div class="modal fade" id="estadisticas" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                </div>
                                                <div class="modal-body">
                                                    <div id="wg-api-football-fixture"
                                                        data-host="v3.football.api-sports.io"
                                                        data-refresh="0"
                                                        data-id="{{ $match['fixture']['id'] }}"
                                                        data-key="{{ env('ApiFootball_API_KEY') }}"
                                                        data-theme=""
                                                        data-show-errors="true"
                                                        class="api_football_loader">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Button modal -->
                                    <div id="btn-estadisticas" style="cursor: pointer;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                        </svg>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
</div>
@endfor
</div>

<div class="col-lg-6 my-4">
    <div class="card">
        <div class="card-header fs-3">CLASIFICACION</div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
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
                                    <img id="logo" src="{{ $team['team']['logo'] }}" alt="">
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
</div>

<div class="col-lg-10 my-3">
    <div class="card">
        <div class="card-header fs-3">
            DESTACADOS
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent my-0 fs-6">
                <div>
                    <ul class="nav">
                        <li id="goles" class="nav-item activo">
                            <a style="color: white;" class="nav-link" href="#">GOLES</a>
                        </li>
                        <li id="asistencias" class="nav-item">
                            <a style="color: white;" class="nav-link" href="#">ASISTENCIAS</a>
                        </li>
                        <li id="amarillas" class="nav-item">
                            <a style="color: white;" class="nav-link" href="#">TAR. AMARILLAS</a>
                        </li>
                        <li id="rojas" class="nav-item">
                            <a style="color: white;" class="nav-link" href="#">TAR. ROJAS</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <?php
        $posicion = ['Attacker' => 'Delantero', 'Defender' => 'Defensa', 'Midfielder' => 'Centrocampista', 'Goalkeeper' => 'Portero'];
        ?>
        <div class="card-body">
            <div id="tgoles">
                <div class="table-responsive">
                    <table class="table table-striped">
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
                                    <img src="{{ $goals[$i]['player']['photo'] }}" alt="" style="width: 35px; height: 35px;">
                                    {{ $goals[$i]['player']['name'] }}
                                </td>
                                <th class="text-center">{{ $goals[$i]['statistics'][0]['goals']['total'] }}</th>
                                <td class="text-center">{{ $posicion[ $goals[$i]['statistics'][0]['games']['position'] ] }}</td>
                                <td>
                                    <a style="text-decoration: none; color: black;" href="/equipo/{{ $goals[$i]['statistics'][0]['team']['id'] }}">
                                        {{ $goals[$i]['statistics'][0]['team']['name'] }}
                                        <img id="logo" src="{{ $goals[$i]['statistics'][0]['team']['logo'] }}" alt="">
                                    </a>
                                </td>
                                </tr>
                                @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="tasistencias" class="d-none">
                <div class="table-responsive">
                    <table class="table table-striped">
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
                                    <img src="{{ $assists[$i]['player']['photo'] }}" alt="" style="width: 35px; height: 35px;">
                                    {{ $assists[$i]['player']['name'] }}
                                </td>
                                <th class="text-center">{{ $assists[$i]['statistics'][0]['goals']['assists'] }}</th>
                                <td class="text-center">{{ $posicion[ $assists[$i]['statistics'][0]['games']['position'] ] }}</td>
                                <td>
                                    <a style="text-decoration: none; color: black;" href="/equipo/{{ $assists[$i]['statistics'][0]['team']['id'] }}">
                                        {{ $assists[$i]['statistics'][0]['team']['name'] }}
                                        <img id="logo" src="{{ $assists[$i]['statistics'][0]['team']['logo'] }}" alt="">
                                    </a>
                                </td>
                                </tr>
                                @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="tamarillas" class="d-none">
                <div class="table-responsive">
                    <table class="table table-striped">
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
                                    <img src="{{ $yellowcards[$i]['player']['photo'] }}" alt="" style="width: 35px; height: 35px;">
                                    {{ $yellowcards[$i]['player']['name'] }}
                                </td>
                                <th class="text-center">{{ $yellowcards[$i]['statistics'][0]['cards']['yellow'] }}</th>
                                <td class="text-center">{{ $posicion[ $yellowcards[$i]['statistics'][0]['games']['position'] ] }}</td>
                                <td>
                                    <a style="text-decoration: none; color: black;" href="/equipo/{{ $yellowcards[$i]['statistics'][0]['team']['id'] }}">
                                        {{ $yellowcards[$i]['statistics'][0]['team']['name'] }}
                                        <img id="logo" src="{{ $yellowcards[$i]['statistics'][0]['team']['logo'] }}" alt="">
                                    </a>
                                </td>
                                </tr>
                                @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="trojas" class="d-none">
                <div class="table-responsive">
                    <table class="table table-striped">
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
                                    <img src="{{ $redcards[$i]['player']['photo'] }}" alt="" style="width: 35px; height: 35px;">
                                    {{ $redcards[$i]['player']['name'] }}
                                </td>
                                <th class="text-center">{{ $redcards[$i]['statistics'][0]['cards']['red'] }}</th>
                                <td class="text-center">{{ $posicion[ $redcards[$i]['statistics'][0]['games']['position'] ] }}</td>
                                <td>
                                    <a style="text-decoration: none; color: black;" href="/equipo/{{ $redcards[$i]['statistics'][0]['team']['id'] }}">
                                        {{ $redcards[$i]['statistics'][0]['team']['name'] }}
                                        <img id="logo" src="{{ $redcards[$i]['statistics'][0]['team']['logo'] }}" alt="">
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
</div>
@else
<div class="text-center fs-5 my-4">
    <em>Ha consumido el 100% de la API para poder utilizar esta aplicacion. Porfavor vuelva mañana.</em>
</div>
@endif
</div>

@endsection

@section('js')
<script src="{{ asset('js/scriptsLigas.js') }}"></script>
<script type="module" src="https://widgets.api-sports.io/football/1.1.8/widget.js"></script>
<script>
    $('#btn-estadisticas').on('click', function(e) {
        $('#estadisticas').modal('show');
    })
</script>
@endsection