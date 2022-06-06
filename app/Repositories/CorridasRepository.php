<?php

namespace App\Repositories;
use App\Http\Controllers\ApiController;
use App\Corridas;
class CorridasRepository extends ApiController{

    public function getCorridas($fecha) {
        return $reservas = Corridas::where('fecha', '=', $fecha)
        ->with('tour')
        ->with('guia')
        ->get();
        // dd($reservas);
        /*$clientes = Clientes::orderBy("nombre")->get();
        return $this->showAll($clientes);*/
    }

}
