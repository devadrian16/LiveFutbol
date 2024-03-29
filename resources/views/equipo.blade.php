@extends('layouts.api')

@section('title', 'Equipos')

@section('css')
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')

<div class="row justify-content-around">
    @if($status['response']['requests']['current'] < 100)
    <div class="col-lg-10 my-4">
        <div class="card">
            <div class="card-header fs-2 rounded">
                <img src="{{ $team['logo'] }}" alt="" style="width: 75px; height: 75px;">
                {{ $team['name'] }}
                @auth
                @if($favorito->count() == 0)
                <div id="nofavorito" style="font-size: 1em; display: inline-block;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#c8cdcd" class="bi bi-star" viewBox="0 0 16 16">
                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                    </svg>
                </div>

                <div id="favorito" class="d-none" style="font-size: 1em; display: inline-block;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffcd00" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                    </svg>
                </div>
                @else
                <div id="nofavorito" class="d-none" style="font-size: 1em; display: inline-block;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#c8cdcd" class="bi bi-star" viewBox="0 0 16 16">
                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                    </svg>
                </div>

                <div id="favorito" style="font-size: 1em; display: inline-block;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffcd00" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                    </svg>
                </div>
                @endif
                @endauth
            </div>
        </div>
    </div>

    <div class="col-lg-10 mb-4">
        <div class="card">
            <div class="card-header fs-5" style="border-bottom: none;">Plantilla</div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td colspan="9" class="fs-3" style="background-color: #255e50; border-radius: 5px; color: white;">Porteros</td>
                            </tr>
                            <tr class="text-center" style="font-size: 14px;">
                                <td></td>
                                <td>NOMBRE</td>
                                <td>EDAD</td>
                                <td>ALTURA</td>
                                <td>PESO</td>
                                <td>
                                    PAR. JUGADOS
                                </td>
                                <td>
                                    <i class="fa fa-soccer-ball-o" title="Goles"></i>
                                </td>
                                <td>
                                    <svg aria-labelledby="yellowcard" role="img" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffcd00" class="bi bi-file-fill" viewBox="0 0 16 16">
                                        <title id="yellowcard">Tarjetas amarillas</title>    
                                        <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                    </svg>
                                </td>
                                <td>
                                    <svg aria-labelledby="redcard" role="img" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#dc0000" class="bi bi-file-fill" viewBox="0 0 16 16">
                                        <title id="redcard">Tarjetas rojas</title>    
                                        <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                    </svg>
                                </td>
                            </tr>
                            @foreach($porteros as $player)
                            <tr class="text-center">
                                <td>
                                    <img src="{{ $player['player']['photo'] }}" alt="" style="width: 35px; height: 35px;">
                                </td>
                                <td>
                                    {{ $player['player']['name'] }}
                                </td>
                                <td>{{ $player['player']['age'] }}</td>
                                <td>{{ $player['player']['height'] }}</td>
                                <td>{{ $player['player']['weight'] }}</td>
                                <td>{{ $player['statistics'][0]['games']['appearences'] }}</td>
                                <th>{{ $player['statistics'][0]['goals']['total'] }}</th>
                                <td>{{ $player['statistics'][0]['cards']['yellow'] }}</td>
                                <td>{{ $player['statistics'][0]['cards']['red'] }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="9" class="fs-3" style="background-color: #255e50; border-radius: 5px; color: white;">Defensas</td>
                            </tr>
                            <tr class="text-center" style="font-size: 14px;">
                                <td></td>
                                <td>NOMBRE</td>
                                <td>EDAD</td>
                                <td>ALTURA</td>
                                <td>PESO</td>
                                <td>
                                    PAR. JUGADOS
                                </td>
                                <td>
                                    <i class="fa fa-soccer-ball-o" title="Goles"></i>
                                </td>
                                <td>
                                    <svg aria-labelledby="yellowcard" role="img" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffcd00" class="bi bi-file-fill" viewBox="0 0 16 16">
                                        <title id="yellowcard">Tarjetas amarillas</title>    
                                        <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                    </svg>
                                </td>
                                <td>
                                    <svg aria-labelledby="redcard" role="img" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#dc0000" class="bi bi-file-fill" viewBox="0 0 16 16">
                                        <title id="redcard">Tarjetas rojas</title>    
                                        <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                    </svg>
                                </td>
                            </tr>
                            @foreach($defensas as $player)
                            <tr class="text-center">
                                <td>
                                    <img src="{{ $player['player']['photo'] }}" alt="" style="width: 35px; height: 35px;">
                                </td>
                                <td>
                                    {{ $player['player']['name'] }}
                                </td>
                                <td>{{ $player['player']['age'] }}</td>
                                <td>{{ $player['player']['height'] }}</td>
                                <td>{{ $player['player']['weight'] }}</td>
                                <td>{{ $player['statistics'][0]['games']['appearences'] }}</td>
                                <th>{{ $player['statistics'][0]['goals']['total'] }}</th>
                                <td>{{ $player['statistics'][0]['cards']['yellow'] }}</td>
                                <td>{{ $player['statistics'][0]['cards']['red'] }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="9" class="fs-3" style="background-color: #255e50; border-radius: 5px; color: white;">Centrocampistas</td>
                            </tr>
                            <tr class="text-center" style="font-size: 14px;">
                                <td></td>
                                <td>NOMBRE</td>
                                <td>EDAD</td>
                                <td>ALTURA</td>
                                <td>PESO</td>
                                <td>
                                    PAR. JUGADOS
                                </td>
                                <td>
                                    <i class="fa fa-soccer-ball-o" title="Goles"></i>
                                </td>
                                <td>
                                    <svg aria-labelledby="yellowcard" role="img" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffcd00" class="bi bi-file-fill" viewBox="0 0 16 16">
                                        <title id="yellowcard">Tarjetas amarillas</title>    
                                        <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                    </svg>
                                </td>
                                <td>
                                    <svg aria-labelledby="redcard" role="img" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#dc0000" class="bi bi-file-fill" viewBox="0 0 16 16">
                                        <title id="redcard">Tarjetas rojas</title>    
                                        <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                    </svg>
                                </td>
                            </tr>
                            @foreach($centrocampistas as $player)
                            <tr class="text-center">
                                <td>
                                    <img src="{{ $player['player']['photo'] }}" alt="" style="width: 35px; height: 35px;">
                                </td>
                                <td>
                                    {{ $player['player']['name'] }}
                                </td>
                                <td>{{ $player['player']['age'] }}</td>
                                <td>{{ $player['player']['height'] }}</td>
                                <td>{{ $player['player']['weight'] }}</td>
                                <td>{{ $player['statistics'][0]['games']['appearences'] }}</td>
                                <th>{{ $player['statistics'][0]['goals']['total'] }}</th>
                                <td>{{ $player['statistics'][0]['cards']['yellow'] }}</td>
                                <td>{{ $player['statistics'][0]['cards']['red'] }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="9" class="fs-3" style="background-color: #255e50; border-radius: 5px; color: white;">Delanteros</td>
                            </tr>
                            <tr class="text-center" style="font-size: 14px;">
                                <td></td>
                                <td>NOMBRE</td>
                                <td>EDAD</td>
                                <td>ALTURA</td>
                                <td>PESO</td>
                                <td>
                                    PAR. JUGADOS
                                </td>
                                <td>
                                    <i class="fa fa-soccer-ball-o" title="Goles"></i>
                                </td>
                                <td>
                                    <svg aria-labelledby="yellowcard" role="img" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffcd00" class="bi bi-file-fill" viewBox="0 0 16 16">
                                        <title id="yellowcard">Tarjetas amarillas</title>    
                                        <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                    </svg>
                                </td>
                                <td>
                                    <svg aria-labelledby="redcard" role="img" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#dc0000" class="bi bi-file-fill" viewBox="0 0 16 16">
                                        <title id="redcard">Tarjetas rojas</title>    
                                        <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                    </svg>
                                </td>
                            </tr>
                            @foreach($delanteros as $player)
                            <tr class="text-center">
                                <td>
                                    <img src="{{ $player['player']['photo'] }}" alt="" style="width: 35px; height: 35px;">
                                </td>
                                <td>
                                    {{ $player['player']['name'] }}
                                </td>
                                <td>{{ $player['player']['age'] }}</td>
                                <td>{{ $player['player']['height'] }}</td>
                                <td>{{ $player['player']['weight'] }}</td>
                                <td>{{ $player['statistics'][0]['games']['appearences'] }}</td>
                                <th>{{ $player['statistics'][0]['goals']['total'] }}</th>
                                <td>{{ $player['statistics'][0]['cards']['yellow'] }}</td>
                                <td>{{ $player['statistics'][0]['cards']['red'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
<script src="{{ asset('js/scriptsEquipos.js') }}"></script>
@endsection