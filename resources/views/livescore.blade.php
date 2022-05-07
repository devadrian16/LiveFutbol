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
?>

<div class="row justify-content-around">
    <div class="col-lg-10 my-4">
        @if($status['response']['requests']['current'] <= 100)
        <div class="card">
            <div class="card-header fs-2 pb-0" style="border-bottom: none; background-color: white;">
                Partidos {{ $semana[date('w', strtotime($fecha))] }}, {{ $dia }} {{ $mes[date('n', strtotime($fecha))] }} {{ $anno }}
            </div>

            <div class="card-body">
                @if(count($champions) != 0)
                <div class="card mb-3">
                    <div class="card-header fs-5">
                        <img src="{{ $champions[0]['league']['flag'] }}" alt="" style="width: 25px; height: 25px;">
                        <a style="text-decoration: none; color: black;" href="/liga/{{ $champions[0]['league']['id'] }}">
                            {{ $champions[0]['league']['name'] }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table style="width: 75%; margin: 0 auto;" class="table">
                                <tbody>
                                    @foreach($champions as $match)
                                    @if($match['fixture']['status']['short'] == '1H' or $match['fixture']['status']['short'] == 'HT' or $match['fixture']['status']['short'] == '2H' || $match['fixture']['status']['short'] == 'ET' || $match['fixture']['status']['short'] == 'P')
                                    <tr>
                                        <td class="text-center">{{ $match['fixture']['status']['long'] }}</td>
                                        <td style="color: crimson;" class="parpadeo text-center">{{ $match['fixture']['status']['elapsed'] }}'</td>
                                        <td class="text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img src="{{ $match['teams']['home']['logo'] }}" alt="" style="width: 25px; height: 25px;">
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <div class="livescore">
                                                {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img src="{{ $match['teams']['away']['logo'] }}" alt="" style="width: 25px; height: 25px;">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td class="text-center">{{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
                                        <td>
                                            @if($match['fixture']['status']['short'] == 'NS')
                                            en {{ round( (strtotime( date('H:i', strtotime($match['fixture']['date'])) ) - strtotime($hora) ) / 3600, 0) }} h
                                            @else
                                            Finalizado
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img src="{{ $match['teams']['home']['logo'] }}" alt="" style="width: 25px; height: 25px;">
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                        </td>
                                        <td>
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img src="{{ $match['teams']['away']['logo'] }}" alt="" style="width: 25px; height: 25px;">
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
                        <a style="text-decoration: none; color: black;" href="/liga/{{ $laliga[0]['league']['id'] }}">
                            {{ $laliga[0]['league']['name'] }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table style="width: 75%; margin: 0 auto;" class="table">
                                <tbody>
                                    @foreach($laliga as $match)
                                    @if($match['fixture']['status']['short'] == '1H' or $match['fixture']['status']['short'] == 'HT' or $match['fixture']['status']['short'] == '2H' || $match['fixture']['status']['short'] == 'ET' || $match['fixture']['status']['short'] == 'P')
                                    <tr>
                                        <td class="text-center">{{ $match['fixture']['status']['long'] }}</td>
                                        <td style="color: crimson;" class="parpadeo text-center">{{ $match['fixture']['status']['elapsed'] }}'</td>
                                        <td class="text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img src="{{ $match['teams']['home']['logo'] }}" alt="" style="width: 25px; height: 25px;">
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <div class="livescore">
                                                {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img src="{{ $match['teams']['away']['logo'] }}" alt="" style="width: 25px; height: 25px;">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td class="text-center">{{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
                                        <td>
                                            @if($match['fixture']['status']['short'] == 'NS')
                                            en {{ round( (strtotime( date('H:i', strtotime($match['fixture']['date'])) ) - strtotime($hora) ) / 3600, 0) }} h
                                            @else
                                            Finalizado
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img src="{{ $match['teams']['home']['logo'] }}" alt="" style="width: 25px; height: 25px;">
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                        </td>
                                        <td>
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img src="{{ $match['teams']['away']['logo'] }}" alt="" style="width: 25px; height: 25px;">
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
                        <a style="text-decoration: none; color: black;" href="/liga/{{ $segunda[0]['league']['id'] }}">
                            {{ $segunda[0]['league']['name'] }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table style="width: 75%; margin: 0 auto;" class="table">
                                <tbody>
                                    @foreach($segunda as $match)
                                    @if($match['fixture']['status']['short'] == '1H' || $match['fixture']['status']['short'] == 'HT' || $match['fixture']['status']['short'] == '2H' || $match['fixture']['status']['short'] == 'ET' || $match['fixture']['status']['short'] == 'P')
                                    <tr>
                                        <td class="text-center">{{ $match['fixture']['status']['long'] }}</td>
                                        <td style="color: crimson;" class="parpadeo text-center">{{ $match['fixture']['status']['elapsed'] }}'</td>
                                        <td class="text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img src="{{ $match['teams']['home']['logo'] }}" alt="" style="width: 25px; height: 25px;">
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <div class="livescore">
                                                {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img src="{{ $match['teams']['away']['logo'] }}" alt="" style="width: 25px; height: 25px;">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td class="text-center">{{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
                                        <td>
                                            @if($match['fixture']['status']['short'] == 'NS')
                                            en {{ round( (strtotime( date('H:i', strtotime($match['fixture']['date'])) ) - strtotime($hora) ) / 3600, 0) }} h
                                            @else
                                            Finalizado
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img src="{{ $match['teams']['home']['logo'] }}" alt="" style="width: 25px; height: 25px;">
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                        </td>
                                        <td>
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img src="{{ $match['teams']['away']['logo'] }}" alt="" style="width: 25px; height: 25px;">
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
                        <a style="text-decoration: none; color: black;" href="/liga/{{ $premier[0]['league']['id'] }}">
                            {{ $premier[0]['league']['name'] }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table style="width: 75%; margin: 0 auto;" class="table">
                                <tbody>
                                    @foreach($premier as $match)
                                    @if($match['fixture']['status']['short'] == '1H' || $match['fixture']['status']['short'] == 'HT' || $match['fixture']['status']['short'] == '2H' || $match['fixture']['status']['short'] == 'ET' || $match['fixture']['status']['short'] == 'P')
                                    <tr>
                                        <td class="text-center">{{ $match['fixture']['status']['long'] }}</td>
                                        <td style="color: crimson;" class="parpadeo text-center">{{ $match['fixture']['status']['elapsed'] }}'</td>
                                        <td class="text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img src="{{ $match['teams']['home']['logo'] }}" alt="" style="width: 25px; height: 25px;">
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <div class="livescore">
                                                {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                            </div>
                                        </td>
                                        <td>
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img src="{{ $match['teams']['away']['logo'] }}" alt="" style="width: 25px; height: 25px;">
                                                {{ $match['teams']['away']['name'] }}
                                            </a>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td class="text-center">{{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
                                        <td>
                                            @if($match['fixture']['status']['short'] == 'NS')
                                            en {{ round( (strtotime( date('H:i', strtotime($match['fixture']['date'])) ) - strtotime($hora) ) / 3600, 0) }} h
                                            @else
                                            Finalizado
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                                {{ $match['teams']['home']['name'] }}
                                                <img src="{{ $match['teams']['home']['logo'] }}" alt="" style="width: 25px; height: 25px;">
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }}
                                        </td>
                                        <td>
                                            <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                                <img src="{{ $match['teams']['away']['logo'] }}" alt="" style="width: 25px; height: 25px;">
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
            </div>
        </div>
        @else
        <div class="text-center fs-5">
            <em>Ha consumido el 100% de la API para poder utilizar esta aplicacion. Porfavor vuelva mañana.</em>
        </div>
        @endif
    </div>
</div>

@endsection