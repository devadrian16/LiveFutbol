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

	public function verLiga($id)
	{
		//Status
		$status = $this->api->getStatus();

		if ($status['response']['requests']['current'] < 100) {
			//Jornadas
			$jornadas = [];
			$rounds = [];
			$allRounds = $this->api->getRounds($id);
			/*Todas las jornadas
			for($i = 0; $i < count($allRounds); $i++) {
				$jornada = $this->api->getMatchesLeague($id, $allRounds[$i]);
				array_push($jornadas, $jornada);
				array_push($rounds, $i+1);
			}*/

			//Las ultimas 3 jornadas
			for ($i = count($allRounds) - 3; $i < count($allRounds); $i++) {
				$jornada = $this->api->getMatchesLeague($id, $allRounds[$i]);
				array_push($jornadas, $jornada);
				array_push($rounds, $i + 1);
			}

			//Clasificacion
			$ranking = $this->api->getRanking($id);

			//Destacados
			$goals = $this->api->getTopScorerLeague($id);
			$assists = $this->api->getTopAssistsLeague($id);
			$yellowcards = $this->api->getTopYellowCardsLeague($id);
			$redcards = $this->api->getTopRedCardsLeague($id);

			return view('liga', [
				'status' => $status, 'jornadas' => $jornadas, 'rounds' => $rounds, 'ranking' => $ranking['league']['standings'],
				'goals' => $goals, 'assists' => $assists, 'yellowcards' => $yellowcards, 'redcards' => $redcards
			]);

		} else {

			return view('liga', [
				'status' => $status
			]);
		}
	}
}
