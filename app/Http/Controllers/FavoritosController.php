<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use GuzzleHttp\Client;
use App\Models\Favorito;
use Auth;

class FavoritosController extends Controller
{
    private $api;

	public function __construct(Client $client) 
  {	
		$this->api = new ApiController($client);
	}

  public function verFavoritos() {
    //Equipos
    $last = [];
    $next = [];
    $favoritos = Favorito::where('id_user', Auth::user()->id)->get();
    foreach($favoritos as $favorito) {
      $lastMatches = $this->api->getLastMatchesTeam($favorito->id_team, 2);
      $nextMatches = $this->api->getNextMatchesTeam($favorito->id_team, 4);
      array_push($last, $lastMatches);
      array_push($next, $nextMatches);
    }

	  return view('favoritos', ['favoritos' => $favoritos, 'anteriores' => $last, 'siguientes' => $next]);
  }
}
