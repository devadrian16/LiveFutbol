<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use GuzzleHttp\Client;

class EquipoController extends Controller
{
    private $api;

	public function __construct(Client $client) 
    {	
		$this->api = new ApiController($client);
	}

    public function verEquipo($id) {
        //Team
        $team = $this->api->getTeam($id);

		return view('equipo', ['team' => $team['team']]);
    }
}
