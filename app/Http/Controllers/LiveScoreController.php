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
        $status = $this->status();
        $now = Carbon::now();

        if($status['response']['requests']['current'] < 100) {

            //$champions = $this->obtenerPartidos(2); 
            //$champions = obtenerPartidos(3); // Europa League
            $champions = $this->obtenerPartidos(135); // Serie A
            //$champions = obtenerPartidos(78); // Bundesliga
            //$champions = obtenerPartidos(88); // Eredivise
            $laliga = $this->obtenerPartidos(140);   
            $segunda = $this->obtenerPartidos(141); 
            //$premier = $this->obtenerPartidos(39); 
            $premier = $this->obtenerPartidos(61); // Ligue 1 

            return view('livescore', [
                'status' => $status, 'hora' => $now->format('H:i'), 'fecha' => $now->format('l, j F Y'), 'dia' => $now->format('j'), 'anno' => $now->format('Y'),
                'laliga' => $laliga, 'segunda' => $segunda, 'premier' => $premier, 'champions' => $champions]);

        } else {

            return view('livescore', [
                'status' => $status, 'hora' => $now->format('H:i'), 'fecha' => $now->format('l, j F Y'), 'dia' => $now->format('j'), 'anno' => $now->format('Y')]);
        }
    }

    public function obtenerPartidos($idLeague) {
        return $this->api->getMatchesTodayLeague($idLeague); 
    }

    public function status() {
        return $this->api->getStatus();
    }
}
