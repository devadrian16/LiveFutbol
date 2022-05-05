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
    <div class="col-lg-10 mt-4 mb-3">
        @for ($i = 0; $i < count($favoritos); $i++) 
        <div class="card mb-1">
            <div class="card-header">{{ Str::upper( $favoritos[$i]->name_team ) }}</div>

            <div class="card-body">
                <div class="table-responsive">
                    <table style="width: 75%; margin: 0 auto;" class="table">
                        <tbody>
                            <tr>
                                <td colspan="5">Ultimos partidos</td>
                            </tr>
                            @foreach($anteriores[$i] as $match)
                            <tr>
                                <td class="text-center">{{ date('j', strtotime($match['fixture']['date'])) }} {{ $mes[date('n', strtotime($match['fixture']['date']))] }}, {{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
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
                                <td colspan="5">Proximos partidos</td>
                            </tr>
                            @foreach($siguientes[$i] as $match)
                            <tr>
                                <td class="text-center">{{ date('j', strtotime($match['fixture']['date'])) }} {{ $mes[date('n', strtotime($match['fixture']['date']))] }}, {{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
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