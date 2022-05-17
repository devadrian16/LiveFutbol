@extends('layouts.api')

@section('title', 'LiveScore')

@section('css')
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')

<?php
    //header('Refresh: 240');
    $semana = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
    $mes = ['-', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    $periodo = ['1H' => 'Primera Parte', 'HT' => 'Descanso', '2H' => 'Segunda Parte', 'ET' => 'Prórroga', 'P' => 'Penaltis'];
?>

<div class="row justify-content-around">
    @if($status['response']['requests']['current'] < 100)
    <div class="col-lg-10 my-4">
        <div class="card">
            <div class="card-header fs-4">
                Partidos {{ $semana[date('w', strtotime($fecha))] }}, {{ $dia }} {{ $mes[date('n', strtotime($fecha))] }} {{ $anno }}
            </div>

            <div class="card-body" style="border: none;">
            @if(count($champions) != 0 || count($laliga) != 0 || count($segunda) != 0 || count($premier))
                @if(count($champions) != 0)
                <div class="card mb-3">
                    <div class="card-header fs-5">
                        <img src="{{ $champions[0]['league']['flag'] }}" alt="" style="width: 25px; height: 25px;">
                        <a style="text-decoration: none;" href="/liga/{{ $champions[0]['league']['id'] }}">
                            {{ $champions[0]['league']['name'] }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    @foreach($champions as $match)
                                    @if($match['fixture']['status']['short'] == '1H' or $match['fixture']['status']['short'] == 'HT' or $match['fixture']['status']['short'] == '2H' || $match['fixture']['status']['short'] == 'ET' || $match['fixture']['status']['short'] == 'P')
                                    <tr>
                                        <td class="col-2 text-center">{{ $periodo[ $match['fixture']['status']['short'] ] }}</td>
                                        <td class="col-2 text-center parpadeo">{{ $match['fixture']['status']['elapsed'] }}'</td>
                                        <td class="col-3 text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img id="logo" src="{{ $match['teams']['home']['logo'] }}" alt="">
                                            </a>
                                        </td>
                                        <td class="col-1 text-center">
                                            <div class="livescore">
                                                {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                            </div>
                                        </td>
                                        <td class="col-3">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img id="logo" src="{{ $match['teams']['away']['logo'] }}" alt="">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
                                        </td>
                                        <td class="col-1 text-end">
                                            <!-- Modal -->
                                            <div class="modal fade" id="estadisticas{{ $loop->iteration+100 }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                            <div style="cursor: pointer;" onclick="clickModal('{{ $loop->iteration+100 }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                </svg>
                                            </div>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td class="col-2 text-center">{{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
                                        <td class="col-2 text-center">
                                            @if($match['fixture']['status']['short'] != 'NS')
                                            en {{ round( (strtotime( date('H:i', strtotime($match['fixture']['date'])) ) - strtotime($hora) ) / 3600, 0) }}h
                                            @else
                                            Finalizado
                                            @endif
                                        </td>
                                        <td class="col-3 text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img id="logo" src="{{ $match['teams']['home']['logo'] }}" alt="">
                                            </a>
                                        </td>
                                        <td class="col-1 text-center">
                                            {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                        </td>
                                        <td class="col-3">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img id="logo" src="{{ $match['teams']['away']['logo'] }}" alt="">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
                                        </td>
                                        <td class="col-1 text-end">
                                        @if($match['fixture']['status']['short'] != 'NS')
                                            <!-- Modal -->
                                            <div class="modal fade" id="estadisticas{{ $loop->iteration+100 }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                            <div style="cursor: pointer;" onclick="clickModal('{{ $loop->iteration+100 }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                </svg>
                                            </div>
                                        @endif
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                @if(count($laliga) != 0)
                <div class="card mb-3">
                    <div class="card-header fs-5">
                        <img src="{{ $laliga[0]['league']['flag'] }}" alt="" style="width: 25px; height: 25px;">
                        <a style="text-decoration: none;" href="/liga/{{ $laliga[0]['league']['id'] }}">
                            {{ $laliga[0]['league']['name'] }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    @foreach($laliga as $match)
                                    @if($match['fixture']['status']['short'] == '1H' or $match['fixture']['status']['short'] == 'HT' or $match['fixture']['status']['short'] == '2H' || $match['fixture']['status']['short'] == 'ET' || $match['fixture']['status']['short'] == 'P')
                                    <tr>
                                        <td class="col-2 text-center">{{ $periodo[ $match['fixture']['status']['short'] ] }}</td>
                                        <td class="col-2 text-center parpadeo">{{ $match['fixture']['status']['elapsed'] }}'</td>
                                        <td class="col-3 text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img id="logo" src="{{ $match['teams']['home']['logo'] }}" alt="">
                                            </a>
                                        </td>
                                        <td class="col-1 text-center">
                                            <div class="livescore">
                                                {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                            </div>
                                        </td>
                                        <td class="col-3">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img id="logo" src="{{ $match['teams']['away']['logo'] }}" alt="">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
                                        </td>
                                        <td class="col-1 text-end">
                                            <!-- Modal -->
                                            <div class="modal fade" id="estadisticas{{ $loop->iteration+200 }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                            <div style="cursor: pointer;" onclick="clickModal('{{ $loop->iteration+200 }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                </svg>
                                            </div>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td class="col-2 text-center">{{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
                                        <td class="col-2 text-center">
                                            @if($match['fixture']['status']['short'] == 'NS')
                                            en {{ round( (strtotime( date('H:i', strtotime($match['fixture']['date'])) ) - strtotime($hora) ) / 3600, 0) }}h
                                            @else
                                            Finalizado
                                            @endif
                                        </td>
                                        <td class="col-3 text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img id="logo" src="{{ $match['teams']['home']['logo'] }}" alt="">
                                            </a>
                                        </td>
                                        <td class="col-1 text-center">
                                            {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                        </td>
                                        <td class="col-3">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img id="logo" src="{{ $match['teams']['away']['logo'] }}" alt="">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
                                        </td>
                                        <td class="col-1 text-end">
                                        @if($match['fixture']['status']['short'] != 'NS')
                                            <!-- Modal -->
                                            <div class="modal fade" id="estadisticas{{ $loop->iteration+200 }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                            <div style="cursor: pointer;" onclick="clickModal('{{ $loop->iteration+200 }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                </svg>
                                            </div>
                                        @endif
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                @if(count($segunda) != 0)
                <div class="card mb-3">
                    <div class="card-header fs-5">
                        <img src="{{ $segunda[0]['league']['flag'] }}" alt="" style="width: 25px; height: 25px;">
                        <a style="text-decoration: none;" href="/liga/{{ $segunda[0]['league']['id'] }}">
                            {{ $segunda[0]['league']['name'] }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    @foreach($segunda as $match)
                                    @if($match['fixture']['status']['short'] == '1H' || $match['fixture']['status']['short'] == 'HT' || $match['fixture']['status']['short'] == '2H' || $match['fixture']['status']['short'] == 'ET' || $match['fixture']['status']['short'] == 'P')
                                    <tr>
                                        <td class="col-2 text-center">{{ $periodo[ $match['fixture']['status']['short'] ] }}</td>
                                        <td class="col-2 text-center parpadeo">{{ $match['fixture']['status']['elapsed'] }}'</td>
                                        <td class="col-3 text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img id="logo" src="{{ $match['teams']['home']['logo'] }}" alt="">
                                            </a>
                                        </td>
                                        <td class="col-1 text-center">
                                            <div class="livescore">
                                                {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                            </div>
                                        </td>
                                        <td class="col-3">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img id="logo" src="{{ $match['teams']['away']['logo'] }}" alt="">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
                                        </td>
                                        <td class="col-1 text-end">
                                            <!-- Modal -->
                                            <div class="modal fade" id="estadisticas{{ $loop->iteration+300 }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                            <div style="cursor: pointer;" onclick="clickModal('{{ $loop->iteration+300 }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                </svg>
                                            </div>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td class="col-2 text-center">{{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
                                        <td class="col-2 text-center">
                                            @if($match['fixture']['status']['short'] == 'NS')
                                            en {{ round( (strtotime( date('H:i', strtotime($match['fixture']['date'])) ) - strtotime($hora) ) / 3600, 0) }}h
                                            @else
                                            Finalizado
                                            @endif
                                        </td>
                                        <td class="col-3 text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img id="logo" src="{{ $match['teams']['home']['logo'] }}" alt="">
                                            </a>
                                        </td>
                                        <td class="col-1 text-center">
                                            {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                        </td>
                                        <td class="col-3">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img id="logo" src="{{ $match['teams']['away']['logo'] }}" alt="">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
                                        </td>
                                        <td class="col-1 text-end">
                                        @if($match['fixture']['status']['short'] != 'NS')
                                            <!-- Modal -->
                                            <div class="modal fade" id="estadisticas{{ $loop->iteration+300 }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                            <div style="cursor: pointer;" onclick="clickModal('{{ $loop->iteration+300 }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                </svg>
                                            </div>
                                        @endif
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                @if(count($premier) != 0)
                <div class="card mb-3">
                    <div class="card-header fs-5">
                        <img src="{{ $premier[0]['league']['flag'] }}" alt="" style="width: 25px; height: 25px;">
                        <a style="text-decoration: none;" href="/liga/{{ $premier[0]['league']['id'] }}">
                            {{ $premier[0]['league']['name'] }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    @foreach($premier as $match)
                                    @if($match['fixture']['status']['short'] == '1H' || $match['fixture']['status']['short'] == 'HT' || $match['fixture']['status']['short'] == '2H' || $match['fixture']['status']['short'] == 'ET' || $match['fixture']['status']['short'] == 'P')
                                    <tr>
                                        <td class="col-2 text-center">{{ $periodo[ $match['fixture']['status']['short'] ] }}</td>
                                        <td class="col-2 text-center parpadeo">{{ $match['fixture']['status']['elapsed'] }}'</td>
                                        <td class="col-3 text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img id="logo" src="{{ $match['teams']['home']['logo'] }}" alt="">
                                            </a>
                                        </td>
                                        <td class="col-1 text-center">
                                            <div class="livescore">
                                                {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                            </div>
                                        </td>
                                        <td class="col-3">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img id="logo" src="{{ $match['teams']['away']['logo'] }}" alt="">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
                                        </td>
                                        <td class="col-1 text-end">
                                            <!-- Modal -->
                                            <div class="modal fade" id="estadisticas{{ $loop->iteration+400 }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                            <div style="cursor: pointer;" onclick="clickModal('{{ $loop->iteration+400 }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                </svg>
                                            </div>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td class="col-2 text-center">{{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
                                        <td class="col-2 text-center">
                                            @if($match['fixture']['status']['short'] == 'NS')
                                            en {{ round( (strtotime( date('H:i', strtotime($match['fixture']['date'])) ) - strtotime($hora) ) / 3600, 0) }}h
                                            @else
                                            Finalizado
                                            @endif
                                        </td>
                                        <td class="col-3 text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img id="logo" src="{{ $match['teams']['home']['logo'] }}" alt="">
                                            </a>
                                        </td>
                                        <td class="col-1 text-center">
                                            {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                        </td>
                                        <td class="col-3">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img id="logo" src="{{ $match['teams']['away']['logo'] }}" alt="">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
                                        </td>
                                        <td class="col-1 text-end">
                                        @if($match['fixture']['status']['short'] != 'NS')
                                            <!-- Modal -->
                                            <div class="modal fade" id="estadisticas{{ $loop->iteration+400 }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                            <div style="cursor: pointer;" onclick="clickModal('{{ $loop->iteration+400 }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                </svg>
                                            </div>
                                        @endif
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            @else
                Hoy no hay partidos.
            @endif
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
<script src="{{ asset('js/scriptsLivescore.js') }}"></script>
<script type="module" src="https://widgets.api-sports.io/football/1.1.8/widget.js"></script>
<script>
    function clickModal(id) {
        $('#estadisticas'+id).modal('show');
    }
</script>
@endsection