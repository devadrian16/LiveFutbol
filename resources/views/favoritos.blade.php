@extends('layouts.api')

@section('title', 'Favoritos de '.Auth::user()->name)

@section('css')
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')

<?php
$mes = ['-', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
?>

<div class="row justify-content-around">
    @if($status['response']['requests']['current'] < 100) 
    <div class="col-lg-10 my-4">
        @for ($i = 0; $i < count($favoritos); $i++) 
        <div class="card mb-3">
            <div class="card-header fs-5">{{ Str::upper( $favoritos[$i]->name_team ) }}</div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th colspan="6">Últimos partidos</th>
                            </tr>
                            @foreach($anteriores[$i] as $match)
                            <tr>
                                <td class="col-2 text-center">{{ date('j', strtotime($match['fixture']['date'])) }} {{ $mes[date('n', strtotime($match['fixture']['date']))] }}, {{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
                                <td class="col-2 text-center">
                                    <a style="text-decoration: none; color: black;" href="/liga/{{ $match['league']['id'] }}">
                                        {{ $match['league']['name'] }}
                                        <img id="logo" src="{{ $match['league']['logo'] }}" alt="">
                                    </a>
                                </td>
                                <td class="col-3 text-end">
                                    <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                        {{ $match['teams']['home']['name'] }}
                                        <img id="logo" src="{{ $match['teams']['home']['logo'] }}" alt="">
                                    </a>
                                </td>
                                <td class="col-1 text-center">
                                    @if( $match['teams']['home']['name'] == $favoritos[$i]->name_team )
                                    <b>{{ $match['goals']['home'] }}</b> : {{ $match['goals']['away'] }}
                                    @else
                                    {{ $match['goals']['home'] }} : <b>{{ $match['goals']['away'] }}</b>
                                    @endif
                                </td>
                                <td class="col-3">
                                    <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                        <img id="logo" src="{{ $match['teams']['away']['logo'] }}" alt="">
                                        {{ $match['teams']['away']['name'] }}
                                    </a>
                                </td>
                                <td class="col-1 text-end">
                                    <!-- Modal -->
                                            <div class="modal fade" id="estadisticas{{ $match['fixture']['id'] }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                            <div style="cursor: pointer;" onclick="clickModal('{{ $match['fixture']['id'] }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                </svg>
                                            </div>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <th colspan="6">Próximos partidos</th>
                            </tr>
                            @foreach($siguientes[$i] as $match)
                            <tr>
                                <td class="col-2 text-center">{{ date('j', strtotime($match['fixture']['date'])) }} {{ $mes[date('n', strtotime($match['fixture']['date']))] }}, {{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
                                <td class="col-2 text-center">
                                    <a style="text-decoration: none; color: black;" href="/liga/{{ $match['league']['id'] }}">
                                        {{ $match['league']['name'] }}
                                        <img id="logo" src="{{ $match['league']['logo'] }}" alt="">
                                    </a>
                                </td>
                                <td class="col-3 text-end">
                                    <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                        {{ $match['teams']['home']['name'] }}
                                        <img id="logo" src="{{ $match['teams']['home']['logo'] }}" alt="">
                                    </a>
                                </td>
                                <td class="col-2 text-center">
                                    {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                </td>
                                <td class="col-3">
                                    <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                        <img id="logo" src="{{ $match['teams']['away']['logo'] }}" alt="">
                                        {{ $match['teams']['away']['name'] }}
                                    </a>
                                </td>
                                <td class="col-1 tex-end">

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
    @else
    <div class="text-center fs-5 my-4">
        <em>Ha consumido el 100% de la API para poder utilizar esta aplicacion. Porfavor vuelva mañana.</em>
    </div>
    @endif
</div>

@endsection

@section('js')
<script type="module" src="https://widgets.api-sports.io/football/1.1.8/widget.js"></script>
<script>
    function clickModal(id) {
        $('#estadisticas'+id).modal('show');
    }
</script>
@endsection