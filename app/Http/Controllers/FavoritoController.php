<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use GuzzleHttp\Client;
use App\Models\Favorito;
use Auth;

class FavoritoController extends Controller
{
  private $api;

  public function __construct(Client $client)
  {
    $this->api = new ApiController($client);
  }

  public function verFavoritos()
  {
    //Status
    $status = $this->status();

    if ($status['response']['requests']['current'] < 100) {
      //Equipos
      $last = [];
      $next = [];
      $favoritos = Favorito::where('id_user', Auth::user()->id)->get();
      foreach ($favoritos as $favorito) {
        $lastMatches = $this->obtenerPartidosPasados($favorito->id_team, 2);
        $nextMatches = $this->obtenerPartidosProximos($favorito->id_team, 4);
        array_push($last, $lastMatches);
        array_push($next, $nextMatches);
      }

      return view('favoritos', [
        'status' => $status, 'favoritos' => $favoritos, 'anteriores' => $last, 'siguientes' => $next
      ]);
      
    } else {

      return view('favoritos', [
        'status' => $status
      ]);
    }
  }

  public function obtenerPartidosPasados($idTeam, $num) {
    return $this->api->getLastMatchesTeam($idTeam, $num);
  }

  public function obtenerPartidosProximos($idTeam, $num) {
    return $this->api->getNextMatchesTeam($idTeam, $num);
  }

  public function status() {
    return $this->api->getStatus();
  }
}
