<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ReservacionesRepository;
use App\Repositories\ToursRepository;
use App\Repositories\ClientsToursRepository;
use App\Http\Controllers\ApiController;

class ReservacionesController extends ApiController
{
    private $repository;
    private $clientTourRepository;

    public function __construct(ReservacionesRepository $repository,
        ToursRepository $toursRepository,
        ClientsToursRepository $clientTourRepository)
    {
        $this->repository = $repository;
        $this->toursRepository = $toursRepository;
        $this->clientTourRepository = $clientTourRepository;
    }

    public function store(Request $request) {
        //dd($request->all());
        $totalTourCliente = $this->clientTourRepository->findIdTourIdClient($request->tour, $request->agencia);
        $toursData = $this->toursRepository->getId($request->tour);
        $pax = explode(".", $request->pax);
        $fecha_hora_alta = explode(" ", $request->fecha_alta);
        $fecha_alta = explode("/", $fecha_hora_alta[0]);

        if(strlen($fecha_alta[1]) === 1) {
            $fecha_alta[1] = '0'.$fecha_alta[1]; 
        }
        if(strlen($fecha_alta[0]) === 1) {
            $fecha_alta[0] = '0'.$fecha_alta[0]; 
        }
        $fecha_alta = $fecha_alta[2].'-'.$fecha_alta[0].'-'.$fecha_alta[1].' '.$fecha_hora_alta[1].'.000';
        $fecha_tour = str_replace("T", " ", $request->fecha_tour);
        $fecha_tour = substr($fecha_tour, 0, 23);
        $fecha_tour = explode("-", $fecha_tour);
        $fecha_tour = $fecha_tour[0].'-'.substr($fecha_tour[2], 0, 2).'-'.$fecha_tour[1];
       /*echo $fecha_alta;
        dd($fecha_tour);*/
        $reserva = [];
        $reserva["emp_reserv"] = $this->validateEmpReserv($toursData);
        $reserva["loc_reserv"] = $toursData[0]['locacion'];
        $reserva["subclave"] = 0;
        $reserva["fechalta"] = $fecha_alta;
        $reserva["tour"] = $request->tour;
        $reserva["nombre"] = $request->nombre;
        $reserva["paxa"] = $pax[0];
        $reserva["paxb"] = $pax[1];
        $reserva["fechatour"] = $fecha_tour;
        $reserva["hotel"] = $request->hotel;
        $reserva["cuarto"] = $request->cuarto;
        $reserva["agencia"] = $request->agencia;
        $reserva["vendedor"] = $request->vendedor ? $request->vendedor : '' ;
        $reserva["clavere"] = $request->usuario;
        $reserva["cupon"] = $request->cupon;
        $reserva["observacion"] = $request->observacion;
        $reserva["precioa"] = $request->precio_adulto;
        $reserva["preciob"] = $request->precio_nino;
        $reserva["asignada"] = 0;
        $reserva["cancelada"] = 0;
        $reserva["facturada"] = 0;
        $reserva["usuario"] = $request->usuario;
        $reserva["cortesia"] = $request->cortesia;
        $reserva["noshow"] = 0;
        $reserva["usr_modi"] = $request->usuario;
        $reserva["fecha_mod"] = $fecha_alta;
        $reserva["convertidor"] = $request->convertidor;
        $reserva["nacionalidad_reserva"] = $request->nacionalidad_reserva;
        $reserva["horaalta"] = "1900-01-01 09:44:21.000";
        $reserva["horamod"] = "1900-01-01 09:44:21.000";
        $reservas["precio_tour"] = $totalTourCliente[0]['precio'];
        $response =  $this->repository->store($reserva);
        return $this->showAll($response);
    }

    public function update(Request $request, $clave) {
        //dd($request->all());
        
        $toursData = $this->toursRepository->getId($request->tour);
        $pax = explode(".", $request->pax);
        $fecha_hora_alta = explode(" ", $request->fecha_alta);
        $fecha_alta = explode("/", $fecha_hora_alta[0]);
        if(strlen($fecha_alta[1]) === 1) {
            $fecha_alta[1] = '0'.$fecha_alta[1]; 
        }
        if(strlen($fecha_alta[0]) === 1) {
            $fecha_alta[0] = '0'.$fecha_alta[0]; 
        }
        $fecha_alta = $fecha_alta[2].'-'.$fecha_alta[0].'-'.$fecha_alta[1].' '.$fecha_hora_alta[1].'.000';
        $fecha_tour = str_replace("T", " ", $request->fecha_tour);
        $fecha_tour = substr($fecha_tour, 0, 23);
        $fecha_tour = explode("-", $fecha_tour);
        $fecha_tour = $fecha_tour[0].'-'.substr($fecha_tour[2], 0, 2).'-'.$fecha_tour[1];
       /*echo $fecha_alta;
        dd($fecha_tour);*/
        $reserva = [];
        $reserva["emp_reserv"] = $this->validateEmpReserv($toursData);
        $reserva["loc_reserv"] = $toursData[0]['locacion'];
        $reserva["subclave"] = 0;
        $reserva["fechalta"] = $fecha_alta;
        $reserva["tour"] = $request->tour;
        $reserva["nombre"] = $request->nombre;
        $reserva["paxa"] = $pax[0];
        $reserva["paxb"] = $pax[1];
        $reserva["fechatour"] = $fecha_tour;
        $reserva["hotel"] = $request->hotel;
        $reserva["cuarto"] = $request->cuarto;
        $reserva["agencia"] = $request->agencia;
        $reserva["vendedor"] = $request->vendedor ? $request->vendedor : '' ;
        $reserva["clavere"] = $request->usuario;
        $reserva["cupon"] = $request->cupon;
        $reserva["observacion"] = $request->observacion;
        $reserva["precioa"] = $request->precio_adulto;
        $reserva["preciob"] = $request->precio_nino;
        $reserva["asignada"] = 0;
        $reserva["cancelada"] = 0;
        $reserva["facturada"] = 0;
        $reserva["usuario"] = $request->usuario;
        $reserva["cortesia"] = $request->cortesia;
        $reserva["noshow"] = 0;
        $reserva["usr_modi"] = $request->usuario;
        $reserva["fecha_mod"] = $fecha_alta;
        $reserva["convertidor"] = $request->convertidor;
        $reserva["nacionalidad_reserva"] = $request->nacionalidad_reserva;
        $reserva["horaalta"] = "1900-01-01 09:44:21.000";
        $reserva["horamod"] = "1900-01-01 09:44:21.000";
        $response =  $this->repository->update($reserva, $clave);
        return $this->showAll($response);
    }

    private function validateEmpReserv($tourInfo) {
        if($tourInfo[0]['locacion'] === 'CSIG') {
            return 1;
        }
        return 9;
    }
    public function find($fecha) {
        
        $response = $this->repository->find($fecha);
        return $this->showAll($response);
    }

    public function findReserva($id) {
        
        $response = $this->repository->findReserva($id);
        return $this->showAll($response);
    }
}
