<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use GuzzleHttp\Client;
use App\Models\Favorito;
use Auth;

class EquipoController extends Controller
{
    private $api;

	public function __construct(Client $client) 
    {	
		$this->api = new ApiController($client);
	}

    public function verEquipo($id) {
        //Equipo
        $team = $this->api->getTeam($id);
        
        if(Auth::check()) {
            //Favoritos
            $favoritos = Favorito::where('id_user', Auth::user()->id);

		    return view('equipo', ['team' => $team['team'], 'favoritos' => $favoritos]);
        } else {
            return view('equipo', ['team' => $team['team']]);
        }
    }

    public function guardarEquipo($id) {
        $favorito = new Favorito();

        $favorito->id_user = Auth::user()->id;
        $id_league = $this->api->getLeagueTeam($id);
        $favorito->id_league = $id_league['league']['id'];
        $favorito->id_team = $id;

        $favorito->save();

        return redirect()->route('verEquipo', ['team' => $id]);
    }

}
