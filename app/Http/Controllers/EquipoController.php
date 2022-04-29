<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use GuzzleHttp\Client;
use App\Models\Favorito;
use Auth;

use function Symfony\Component\String\b;

class EquipoController extends Controller
{
    private $api;

    public function __construct(Client $client)
    {
        $this->api = new ApiController($client);
    }

    public function verEquipo($id)
    {
        //Equipo
        $team = $this->api->getTeam($id);
        $id_league = $this->api->getLeagueTeam($id);

        //Jugadores
        $porteros = [];
        $defensas = [];
        $centrocampistas = [];
        $delanteros = [];

        $players = $this->api->getPlayersTeam($id, $id_league['league']['id']);

        for ($i = 1; $i <= $players['paging']['total']; $i++) {
            $page = $this->api->getPlayersTeamPage($id, $id_league['league']['id'], $i);

            foreach ($page['response'] as $player) {

                switch ($player['statistics'][0]['games']['position']) {
                    case 'Attacker':
                        array_push($delanteros, $player);
                        break;
                    case 'Midfielder':
                        array_push($centrocampistas, $player);
                        break;
                    case 'Defender':
                        array_push($defensas, $player);
                        break;
                    case 'Goalkeeper':
                        array_push($porteros, $player);
                        break;
                    default:
                        break;
                }
            }
        }

        if (Auth::check()) {
            //Favoritos
            $favorito = Favorito::where('id_user', Auth::user()->id)->where('id_team', $id);

            return view('equipo', ['team' => $team['team'], 'favorito' => $favorito, 'delanteros' => $delanteros, 'centrocampistas' => $centrocampistas, 'defensas' => $defensas, 'porteros' => $porteros]);
        } else {
            return view('equipo', ['team' => $team['team'], 'delanteros' => $delanteros, 'centrocampistas' => $centrocampistas, 'defensas' => $defensas, 'porteros' => $porteros]);
        }
    }

    public function guardarEquipoFav($id)
    {
        $favorito = new Favorito();

        $favorito->id_user = Auth::user()->id;

        $team = $this->api->getTeam($id);
        $favorito->id_team = $team['team']['id'];
        $favorito->name_team = $team['team']['name'];

        $id_league = $this->api->getLeagueTeam($id);
        $favorito->id_league = $id_league['league']['id'];
        $favorito->name_league = $id_league['league']['name'];

        $favorito->save();

        return redirect()->route('verEquipo', ['team' => $id]);
    }

    public function eliminarEquipoFav($id)
    {
        $favorito = Favorito::where('id_user', Auth::user()->id)->where('id_team', $id);
        $favorito->delete();

        return redirect()->route('verEquipo', ['team' => $id]);
    }
}
