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
		$status = $this->status();

		if ($status['response']['requests']['current'] < 100) {
			//Jornadas
			$jornadas = [];
			$rounds = [];
			$allRounds = $this->obtenerRondas($id);
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
			$ranking = $this->obtenerRanking($id);

			//Destacados
			$goals = $this->topGoles($id);
			$assists = $this->topAsistencias($id);
			$yellowcards = $this->topAmarillas($id);
			$redcards = $this->topRojas($id);

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

	public function obtenerRondas($idLeague) {
        return $this->api->getRounds($idLeague);
    }

	public function obtenerRanking($idLeague) {
        return $this->api->getRanking($idLeague);
    }

	public function topGoles($idLeague) {
        return $this->api->getTopScorerLeague($idLeague);
    }

	public function topAsistencias($idLeague) {
        return $this->api->getTopAssistsLeague($idLeague);
    }

	public function topAmarillas($idLeague) {
        return $this->api->getTopYellowCardsLeague($idLeague);
    }

	public function topRojas($idLeague) {
        return $this->api->getTopRedCardsLeague($idLeague);
    }

	public function status() {
        return $this->api->getStatus();
    }

}
