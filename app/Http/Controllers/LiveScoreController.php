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
        //LiveScore
        $champions = $this->api->getMatchesTodayLeague(83); //Regionalliga - Bayern
        $laliga = $this->api->getMatchesTodayLeague(140);   
        $segunda = $this->api->getMatchesTodayLeague(88); //eredivisie holanda
        $premier = $this->api->getMatchesTodayLeague(39); 

        //Status
        $status = $this->api->getStatus();

        $now = Carbon::now();

        return view('livescore', ['status' => $status, 'hora' => $now->format('H:i'), 'fecha' => $now->format('l, j F Y'), 'dia' => $now->format('j'), 'anno' => $now->format('Y'),
            'laliga' => $laliga, 'segunda' => $segunda, 'premier' => $premier, 'champions' => $champions]);
    }
}
