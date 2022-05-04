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

    public function verEquipo($id)
    {
        if (Auth::check()) {
            //Favoritos
            $favorito = Favorito::where('id_user', Auth::user()->id)->where('id_team', $id);

            return view('equipo', ['favorito' => $favorito]);
        } else {
            return view('equipo');
        }
    }

    public function guardarEquipoFav($id)
    {
        //return redirect()->route('verEquipo', ['team' => $id]);
        return json_encode(['msg' => 'equipo agregado a favoritos']);
    }

    public function eliminarEquipoFav($id)
    {
        //return redirect()->route('verEquipo', ['team' => $id]);
        return json_encode(['msg' => 'equipo eliminado de favoritos']);
    }
}
