<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use GuzzleHttp\Client;
use Carbon\Carbon;

class LiveScoreController extends Controller
{
    private $api;

	public function __construct(Client $client) 
    {	
		$this->api = new ApiController($client);
	}

    public function verLiveScore() {
        //Status
        $status = $this->api->getStatus();
        $now = Carbon::now();

        if($status['response']['requests']['current'] < 100) {
            //LiveScore
            //$champions = $this->api->getMatchesTodayLeague(2); 
            //$champions = $this->api->getMatchesTodayLeague(135); // Serie A
            $champions = $this->api->getMatchesTodayLeague(78); // Bundesliga
            $laliga = $this->api->getMatchesTodayLeague(140);   
            $segunda = $this->api->getMatchesTodayLeague(141); 
            $premier = $this->api->getMatchesTodayLeague(39); 

            return view('livescore', [
                'status' => $status, 'hora' => $now->format('H:i'), 'fecha' => $now->format('l, j F Y'), 'dia' => $now->format('j'), 'anno' => $now->format('Y'),
                'laliga' => $laliga, 'segunda' => $segunda, 'premier' => $premier, 'champions' => $champions]);

        } else {

            return view('livescore', [
                'status' => $status, 'hora' => $now->format('H:i'), 'fecha' => $now->format('l, j F Y'), 'dia' => $now->format('j'), 'anno' => $now->format('Y')]);
        }
    }

    public function actualizarMarcador() {
        return json_encode(['msg' => 'marcador actualizado']);
    }
}
