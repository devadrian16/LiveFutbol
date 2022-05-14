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
                                        <td style="width: 150px;" class="text-center">{{ $periodo[ $match['fixture']['status']['short'] ] }}</td>
                                        <td style="width: 100px;" class="parpadeo text-center">{{ $match['fixture']['status']['elapsed'] }}'</td>
                                        <td style="width: 250px;" class="text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img id="logo" src="{{ $match['teams']['home']['logo'] }}" alt="">
                                            </a>
                                        </td>
                                        <td style="width: 125px;" class="text-center">
                                            <div class="livescore">
                                                {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                            </div>
                                        </td>
                                        <td style="width: 250px;">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img id="logo" src="{{ $match['teams']['away']['logo'] }}" alt="">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td style="width: 125px;" class="text-center">{{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
                                        <td style="width: 125px;" class="text-center">
                                            @if($match['fixture']['status']['short'] == 'NS')
                                            en {{ round( (strtotime( date('H:i', strtotime($match['fixture']['date'])) ) - strtotime($hora) ) / 3600, 0) }}h
                                            @else
                                            Finalizado
                                            @endif
                                        </td>
                                        <td style="width: 250px;" class="text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img id="logo" src="{{ $match['teams']['home']['logo'] }}" alt="">
                                            </a>
                                        </td>
                                        <td style="width: 125px;" class="text-center">
                                            {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                        </td>
                                        <td style="width: 250px;">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img id="logo" src="{{ $match['teams']['away']['logo'] }}" alt="">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
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
                                        <td style="width: 125px;" class="text-center">{{ $periodo[ $match['fixture']['status']['short'] ] }}</td>
                                        <td style="width: 125px;" class="parpadeo text-center">{{ $match['fixture']['status']['elapsed'] }}'</td>
                                        <td style="width: 250px;" class="text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img id="logo" src="{{ $match['teams']['home']['logo'] }}" alt="">
                                            </a>
                                        </td>
                                        <td style="width: 125px;" class="text-center">
                                            <div class="livescore">
                                                {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                            </div>
                                        </td>
                                        <td style="width: 250px;">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img id="logo" src="{{ $match['teams']['away']['logo'] }}" alt="">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td style="width: 125px;" class="text-center">{{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
                                        <td style="width: 125px;" class="text-center">
                                            @if($match['fixture']['status']['short'] == 'NS')
                                            en {{ round( (strtotime( date('H:i', strtotime($match['fixture']['date'])) ) - strtotime($hora) ) / 3600, 0) }}h
                                            @else
                                            Finalizado
                                            @endif
                                        </td>
                                        <td style="width: 250px;" class="text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img id="logo" src="{{ $match['teams']['home']['logo'] }}" alt="">
                                            </a>
                                        </td>
                                        <td style="width: 125px;" class="text-center">
                                            {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                        </td>
                                        <td style="width: 250px;">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img id="logo" src="{{ $match['teams']['away']['logo'] }}" alt="">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
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
                                        <td style="width: 125px;" class="text-center">{{ $periodo[ $match['fixture']['status']['short'] ] }}</td>
                                        <td style="width: 125px;" class="parpadeo text-center">{{ $match['fixture']['status']['elapsed'] }}'</td>
                                        <td style="width: 250px;" class="text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img id="logo" src="{{ $match['teams']['home']['logo'] }}" alt="">
                                            </a>
                                        </td>
                                        <td style="width: 125px;" class="text-center">
                                            <div class="livescore">
                                                {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                            </div>
                                        </td>
                                        <td style="width: 250px;">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img id="logo" src="{{ $match['teams']['away']['logo'] }}" alt="">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td style="width: 125px;" class="text-center">{{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
                                        <td style="width: 125px;" class="text-center">
                                            @if($match['fixture']['status']['short'] == 'NS')
                                            en {{ round( (strtotime( date('H:i', strtotime($match['fixture']['date'])) ) - strtotime($hora) ) / 3600, 0) }}h
                                            @else
                                            Finalizado
                                            @endif
                                        </td>
                                        <td style="width: 250px;" class="text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img id="logo" src="{{ $match['teams']['home']['logo'] }}" alt="">
                                            </a>
                                        </td>
                                        <td style="width: 125px;" class="text-center">
                                            {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                        </td>
                                        <td style="width: 250px;">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img id="logo" src="{{ $match['teams']['away']['logo'] }}" alt="">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
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
                                        <td style="width: 125px;" class="text-center">{{ $periodo[ $match['fixture']['status']['short'] ] }}</td>
                                        <td style="width: 125px;" class="parpadeo text-center">{{ $match['fixture']['status']['elapsed'] }}'</td>
                                        <td style="width: 250px;" class="text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img id="logo" src="{{ $match['teams']['home']['logo'] }}" alt="">
                                            </a>
                                        </td>
                                        <td style="width: 125px;" class="text-center">
                                            <div class="livescore">
                                                {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                            </div>
                                        </td>
                                        <td style="width: 250px;">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img id="logo" src="{{ $match['teams']['away']['logo'] }}" alt="">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td style="width: 125px;" class="text-center">{{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
                                        <td style="width: 125px;" class="text-center">
                                            @if($match['fixture']['status']['short'] == 'NS')
                                            en {{ round( (strtotime( date('H:i', strtotime($match['fixture']['date'])) ) - strtotime($hora) ) / 3600, 0) }}h
                                            @else
                                            Finalizado
                                            @endif
                                        </td>
                                        <td style="width: 250px;" class="text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img id="logo" src="{{ $match['teams']['home']['logo'] }}" alt="">
                                            </a>
                                        </td>
                                        <td style="width: 100px;" class="text-center">
                                            {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                        </td>
                                        <td style="width: 250px;">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img id="logo" src="{{ $match['teams']['away']['logo'] }}" alt="">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
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
@endsection