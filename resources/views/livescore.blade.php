@extends('layouts.app')

@section('title', 'LiveScore')

@section('css')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>PARTIDOS {{ $fecha }}</h2>

    @if(count($laliga) != 0)
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="5">La Liga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laliga as $match)
                @if($match['fixture']['status']['short'] != '1H' || $match['fixture']['status']['short'] != 'HT' || $match['fixture']['status']['short'] != '2H' || $match['fixture']['status']['short'] != 'ET' || $match['fixture']['status']['short'] != 'P')
                <tr>
                    <td class="text-center">{{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
                    <td></td>
                    <td class="text-end">
                        {{ $match['teams']['home']['name'] }}
                        <a style="text-decoration: none; color: black;">
                            <img src="{{ $match['teams']['home']['logo'] }}" alt="{{ $match['teams']['home']['name'] }}" style="width: 25px; height: 25px;">
                        </a>
                    </td>
                    <td class="text-center"> 
                        {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }} 
                    </td>
                    <td>
                        <a style="text-decoration: none; color: black;">
                            <img src="{{ $match['teams']['away']['logo'] }}" alt="{{ $match['teams']['away']['name'] }}" style="width: 25px; height: 25px;">
                        </a>
                        {{ $match['teams']['away']['name'] }}
                    </td>
                </tr>
                @else 
                <tr>
                    <td class="text-center">{{ $match['fixture']['status']['long'] }}</td>
                    <td style="color: crimson;" class="parpadeo text-center">{{ $match['fixture']['status']['elapsed'] }}'</td>
                    <td class="text-end">
                        {{ $match['teams']['home']['name'] }}
                        <a style="text-decoration: none; color: black;">
                            <img src="{{ $match['teams']['home']['logo'] }}" alt="{{ $match['teams']['home']['name'] }}" style="width: 25px; height: 25px;">
                        </a>
                    </td>
                    <td class="text-center"> 
                        <div class="livescore">
                            {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }} 
                        </div>
                    </td>
                    <td>
                        <a style="text-decoration: none; color: black;">
                            <img src="{{ $match['teams']['away']['logo'] }}" alt="{{ $match['teams']['away']['name'] }}" style="width: 25px; height: 25px;">
                        </a>
                        {{ $match['teams']['away']['name'] }}
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @if(count($segunda) != 0)
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="5">Segunda Division</th>
                </tr>
            </thead>
            <tbody>
                @foreach($segunda as $match)
                @if($match['fixture']['status']['short'] != '1H' || $match['fixture']['status']['short'] != 'HT' || $match['fixture']['status']['short'] != '2H' || $match['fixture']['status']['short'] != 'ET' || $match['fixture']['status']['short'] != 'P')
                <tr>
                    <td class="text-center">{{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
                    <td></td>
                    <td class="text-end">
                        {{ $match['teams']['home']['name'] }}
                        <a style="text-decoration: none; color: black;">
                            <img src="{{ $match['teams']['home']['logo'] }}" alt="{{ $match['teams']['home']['name'] }}" style="width: 25px; height: 25px;">
                        </a>
                    </td>
                    <td class="text-center"> 
                        {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }} 
                    </td>
                    <td>
                        <a style="text-decoration: none; color: black;">
                            <img src="{{ $match['teams']['away']['logo'] }}" alt="{{ $match['teams']['away']['name'] }}" style="width: 25px; height: 25px;">
                        </a>
                        {{ $match['teams']['away']['name'] }}
                    </td>
                </tr>
                @else 
                <tr>
                    <td class="text-center">{{ $match['fixture']['status']['long'] }}</td>
                    <td style="color: crimson;" class="parpadeo text-center">{{ $match['fixture']['status']['elapsed'] }}'</td>
                    <td class="text-end">
                        {{ $match['teams']['home']['name'] }}
                        <a style="text-decoration: none; color: black;">
                            <img src="{{ $match['teams']['home']['logo'] }}" alt="{{ $match['teams']['home']['name'] }}" style="width: 25px; height: 25px;">
                        </a>
                    </td>
                    <td class="text-center"> 
                        <div class="livescore">
                            {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }} 
                        </div>
                    </td>
                    <td>
                        <a style="text-decoration: none; color: black;">
                            <img src="{{ $match['teams']['away']['logo'] }}" alt="{{ $match['teams']['away']['name'] }}" style="width: 25px; height: 25px;">
                        </a>
                        {{ $match['teams']['away']['name'] }}
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @if(count($premier) != 0)
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="5">Premier League</th>
                </tr>
            </thead>
            <tbody>
                @foreach($premier as $match)
                @if($match['fixture']['status']['short'] != '1H' || $match['fixture']['status']['short'] != 'HT' || $match['fixture']['status']['short'] != '2H' || $match['fixture']['status']['short'] != 'ET' || $match['fixture']['status']['short'] != 'P')
                <tr>
                    <td class="text-center">{{ date('H:i', strtotime($match['fixture']['date'])) }}</td>
                    <td></td>
                    <td class="text-end">
                        {{ $match['teams']['home']['name'] }}
                        <a style="text-decoration: none; color: black;">
                            <img src="{{ $match['teams']['home']['logo'] }}" alt="{{ $match['teams']['home']['name'] }}" style="width: 25px; height: 25px;">
                        </a>
                    </td>
                    <td class="text-center"> 
                        {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }} 
                    </td>
                    <td>
                        <a style="text-decoration: none; color: black;">
                            <img src="{{ $match['teams']['away']['logo'] }}" alt="{{ $match['teams']['away']['name'] }}" style="width: 25px; height: 25px;">
                        </a>
                        {{ $match['teams']['away']['name'] }}
                    </td>
                </tr>
                @else 
                <tr>
                    <td class="text-center">{{ $match['fixture']['status']['long'] }}</td>
                    <td style="color: crimson;" class="parpadeo text-center">{{ $match['fixture']['status']['elapsed'] }}'</td>
                    <td class="text-end">
                        {{ $match['teams']['home']['name'] }}
                        <a style="text-decoration: none; color: black;">
                            <img src="{{ $match['teams']['home']['logo'] }}" alt="{{ $match['teams']['home']['name'] }}" style="width: 25px; height: 25px;">
                        </a>
                    </td>
                    <td class="text-center"> 
                        <div class="livescore">
                            {{ $match['goals']['home'] }} : {{ $match['goals']['away'] }} 
                        </div>
                    </td>
                    <td>
                        <a style="text-decoration: none; color: black;">
                            <img src="{{ $match['teams']['away']['logo'] }}" alt="{{ $match['teams']['away']['name'] }}" style="width: 25px; height: 25px;">
                        </a>
                        {{ $match['teams']['away']['name'] }}
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

</div>
@endsection