<?php

namespace App\Http\Controllers;
use App\Repositories\CorridasRepository;
use App\Repositories\ReservacionesRepository;
use Illuminate\Http\Request;

class CorridasController extends ApiController
{
    private $corridasRepository, $reservacionesRepository;

    public function __construct(
        CorridasRepository $corridasRepository,
        ReservacionesRepository $reservacionesRepository)
    {
        $this->corridasRepository = $corridasRepository;
        $this->reservacionesRepository = $reservacionesRepository;
    }

    public function getCorridas(Request $request) {
        $fecha = $request->fecha;
        $corridas =  $this->corridasRepository->getCorridas($fecha);
        $corridasData = array();
        foreach ($corridas as $corrida) {
            $data = [];
            $data['corrida'] = $corrida['clave'];
            $data["nombre_tour"] = $corrida['tour']['nombretour'];
            $data['reservaciones'] = $this->reservacionesRepository->findByCorrida($corrida['clave']);
            $totalPax = 0;
            foreach ($data['reservaciones'] as $reservacion) {
                $totalPax += $reservacion['paxa'] + $reservacion['paxb'];
                $reservacion['pax'] = $reservacion['paxa'].'.'.$reservacion['paxb'];
            }
            $data['totalPax'] = $totalPax;
            //$data['reservaciones']['totalPax'] = $data[''];
            array_push($corridasData, $data);
        }
        return $this->showAll($corridasData);
    }
}
