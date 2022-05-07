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
    <div class="col-lg-10 my-4">
        @for ($i = 0; $i < count($favoritos); $i++) 
        <div class="card mb-3">
            <div class="card-header fs-5">{{ Str::upper( $favoritos[$i]->name_team ) }}</div>

            <div class="card-body">
                <div class="table-responsive">
                    <table style="width: 75%; margin: 0 auto;" class="table">
                        <tbody>
                            <tr>
                                <th colspan="6">Últimos partidos</th>
                            </tr>
                            @foreach($anteriores[$i] as $match)
                            <tr>
                                <td class="text-center">{{ date('j', strtotime($match['fixture']['date'])) }} {{ $mes[date('n', strtotime($match['fixture']['date']))] }}, {{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
                                <td class="text-center">
                                    <a style="text-decoration: none; color: black;" href="/liga/{{ $match['league']['id'] }}">
                                        {{ $match['league']['name'] }}   
                                        <img src="{{ $match['league']['logo'] }}" alt="" style="width: 35px; height: 35px;">   
                                    </a>        
                                </td>
                                <td class="text-end">
                                    <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['home']['id'] }}">
                                        {{ $match['teams']['home']['name'] }}
                                        <img src="{{ $match['teams']['home']['logo'] }}" alt="" style="width: 25px; height: 25px;">
                                    </a>
                                </td>
                                <td class="text-center">
                                    @if( $match['teams']['home']['name'] == $favoritos[$i]->name_team )
                                    <b>{{ $match['goals']['home'] }}</b> : {{ $match['goals']['away'] }}
                                    @else
                                    {{ $match['goals']['home'] }} : <b>{{ $match['goals']['away'] }}</b>
                                    @endif
                                </td>
                                <td>
                                    <a style="text-decoration: none; color: black;" href="/equipo/{{ $match['teams']['away']['id'] }}">
                                        <img src="{{ $match['teams']['away']['logo'] }}" alt="" style="width: 25px; height: 25px;">
                                        {{ $match['teams']['away']['name'] }}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <th colspan="6">Próximos partidos</th>
                            </tr>
                            @foreach($siguientes[$i] as $match)
                            <tr>
                                <td class="text-center">{{ date('j', strtotime($match['fixture']['date'])) }} {{ $mes[date('n', strtotime($match['fixture']['date']))] }}, {{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
                                <td class="text-center">
                                    <a style="text-decoration: none; color: black;" href="/liga/{{ $match['league']['id'] }}">
                                        {{ $match['league']['name'] }}   
                                        <img src="{{ $match['league']['logo'] }}" alt="" style="width: 35px; height: 35px;">   
                                    </a>        
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>

@endsection