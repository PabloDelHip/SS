<?php

namespace App\Repositories;
use App\Http\Controllers\ApiController;
use App\Reservas;
use App\Hotels;

class ReservacionesRepository extends ApiController{
    
    //public $fillable = []

    public function store(array $reservacion) {

        return Reservas::create($reservacion);
    }

    public function update(array $reservacion, $clave) {
        return Reservas::where('clave', $clave)
            ->update($reservacion);
    }

    public function find($fecha) {
        $fecha = explode("-", $fecha);
        $fecha = $fecha[0].'-'.$fecha[2].'-'.$fecha[1];
        $reservas = Reservas::where('fechatour', '=', $fecha.' 00:00:00.000')
            ->with('hotel')
            ->with('agencia')->get();
        return $this->showAll($reservas);
    }

    public function findReserva($clave) {
        $reservas = Reservas::where('clave', '=', $clave)->get();
        return $this->showAll($reservas);
    }

    public function findByCorrida($numCorrida, $nacionalidad){
        if($nacionalidad !== 'todos') {
            return Reservas::where('corrida', $numCorrida)
            ->where('nacionalidad_reserva', $nacionalidad)
            ->with('hotel')
            ->with('agencia')
            ->get();
        }
        return Reservas::where('corrida', $numCorrida)
        ->with('hotel')
        ->with('agencia')
        ->get();
    }
}