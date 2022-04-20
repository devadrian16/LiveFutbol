<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use GuzzleHttp\Client;

class LigaController extends Controller
{
    private $api;

	public function __construct(Client $client) 
    {	
		$this->api = new ApiController($client);
	}

    public function verLiga($id) {
		//League
		$league = $this->api->getLeague($id);

		//Jornadas
		$rounds = $this->api->getMatchesLeague($id);

		//Clasificacion
		$ranking = $this->api->getRanking($id);

		//Destacados
		$goals = $this->api->getTopScorerLeague($id);
		$assists = $this->api->getTopAssistsLeague($id);
		$yellowcards = $this->api->getTopYellowCardsLeague($id);
		$redcards = $this->api->getTopRedCardsLeague($id);

		return view('liga', ['league' => $league['league'], 'ranking' => $ranking['league']['standings'], 'rounds' => $rounds, 
		'goals' => $goals, 'assists' => $assists, 'yellowcards' => $yellowcards, 'redcards' => $redcards]);
	}
}
